<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;

class ResetPasswordController extends Controller
{
    private $client;


    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->addScope(Gmail::GMAIL_SEND);
    }

    
    public function handleCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect('/')->with('error', 'Authorization code not available');
        }

        $token = $this->client->fetchAccessTokenWithAuthCode($request->query('code'));
        $this->client->setAccessToken($token);
        // Store the token in the user's session or database for making authenticated calls later

        DB::table('tokens')->updateOrInsert(
            ['provider' => 'google'],
            ['access_token' => $token['access_token'], 'refresh_token' => $token['refresh_token']],
            ['update_at' => Carbon::now()],
            ['create_at' => Carbon::now()]
        );
    }

    public function redirectToAuthUrl()
    {
        $this->client->setAccessType('offline');   // 🔑 Necessário para o refresh_token
        $this->client->setPrompt('consent');       // 🔄 Força o Google a pedir permissão de novo
        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }

    public function showResetPasswordForm()
    {
        return view('reset_password/send_email_password');
    }

    public function sendEmailPassword(Request $request)
    {
        $tokenData = DB::table('tokens')->where('provider', 'google')->first();

        $this->client->setAccessToken([
            'access_token' => $tokenData->access_token,
            'refresh_token' => $tokenData->refresh_token,
            'expires_in' => 3600,
            'created' => strtotime($tokenData->updated_at)
        ]);

        if ($this->client->isAccessTokenExpired()) {
            $newToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            DB::table('tokens')->where('provider', 'google')->update([
                'access_token' => $newToken['access_token'],
                'updated_at' => Carbon::now()
            ]);
        }

        $request->validate([
            'email' => 'required|email|exists:Usuario,email',
        ], [
            'email.email' => 'O campo exige um email valido',
            'email.exists' => 'Este email não está cadastrado no sistema'
        ]);

        if(
            DB::table('password_reset_tokens')->where('email', $request->email)->exists()
        ) {
            return redirect()->to(route('reset_index'))->with("token", "Um token já foi criado e enviado para este email.");
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $fromName = "ComUniversidade";
        $fromEmail = "sistemacomuniversidade@gmail.com";
        $to = $request->email;
        $subject = 'Redefinir Senha - ComUniversidade';
        $htmlContent = view('emails.email_forget_password', ['token' => $token])->render();

        // MIME Type message
        $boundary = uniqid(rand(), true);
        $subjectCharset = $charset = 'utf-8';

        $messageBody = "--{$boundary}\r\n";
        $messageBody .= "Content-Type: text/html; charset={$charset}\r\n";
        $messageBody .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $messageBody .= chunk_split(base64_encode($htmlContent)) . "\r\n";
        $messageBody .= "--{$boundary}--";

        $rawMessage = "From: {$fromName} <{$fromEmail}>\r\n";
        $rawMessage = "To: {$to}\r\n";
        $rawMessage .= "Subject: =?{$subjectCharset}?B?" . base64_encode($subject) . "?=\r\n";
        $rawMessage .= "MIME-Version: 1.0\r\n";
        $rawMessage .= "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n\r\n";
        $rawMessage .= $messageBody;

        $rawMessage = base64_encode($rawMessage);
        $rawMessage = str_replace(['+', '/', '='], ['-', '_', ''], $rawMessage); // URL-safe

        $gmailMessage = new Message();
        $gmailMessage->setRaw($rawMessage);

        $service = new Gmail($this->client);
        try {
            $service->users_messages->send('me', $gmailMessage);
            return redirect()->to(route('reset_index'))->with("success", "Um email foi encaminhado para redefinição de senha.");
        } catch (\Exception $e) {
            return 'An error occurred: ' . $e->getMessage();
        }
    }

    public function resetPassword( String $token )
    {
        return view('reset_password/new_password', compact('token'));
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            "password" => 'required|string|min:8|confirmed',
            "password_confirmation" => 'required',
        ],
        [
            'password.string' => 'Senha: Deve ser um texto.',
            'password.min' => 'Senha: Deve conter no mínimo 8 caracteres.',
            'password.regex' => 'Senha: Deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.',
            'password.confirmed' => 'As senhas não são iguais'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where("token", $request->token)->first();

        if (!$updatePassword) {
            return redirect()->to(route('reset_password', ['token' => $request->token]))
                                ->with('error', 'Solicitação de Redefinição Inválida');
        }
    
        Usuario::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->password)]);
    
        DB::table('password_reset_tokens')->where('email', $updatePassword->email)->delete();
    
        $usuario = Usuario::where('email', $updatePassword->email)->first(); 
    
        if ($usuario->tipo === 'ALUNO') {
            return redirect()->to(route('login_estudante_index'))->with('success', 'Senha atualizada com sucesso');
        } else if ($usuario->tipo === 'PROFESSOR') {
            return redirect()->to(route('login_professor_index'))->with('success', 'Senha atualizada com sucesso');
        } else {
            return redirect()->to(route('login_membro_index'))->with('success', 'Senha atualizada com sucesso');
        }
    }
}
