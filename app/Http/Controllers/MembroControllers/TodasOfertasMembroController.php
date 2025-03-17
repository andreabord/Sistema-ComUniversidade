<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfessorControllers\OfertaAcaoProfessorController;
use App\Models\AreaConhecimento;
use App\Models\Contato;
use App\Models\ContatosDiretosExcluidos;
use App\Models\ContatoMensagem;
use App\Models\ContatosDiretosVisualizados;
use App\Models\MatchingsExcluidos;
use App\Models\Oferta;
use App\Models\PublicoAlvo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodasOfertasMembroController extends Controller
{
    private $ofertaAcaoProfessorController;

    public function __construct(
        OfertaAcaoProfessorController $ofertaAcaoProfessorController
    )
    {
        $this->ofertaAcaoProfessorController = $ofertaAcaoProfessorController;
    }

    public function listaOfertas(Request $request) {

        $usuarioId = Auth::id();

        $listPublicoAlvo = PublicoAlvo::all();
        $listAreaConhecimento = AreaConhecimento::all();
        $tipoOfertaSelecionada = $request->input('tipo_oferta');
        $pesquisaTitulo = $request->input('pesquisa_titulo');
        $regimeSelecionado = $request->input('regime');
        $statusRegistroSelecionado = $request->input('status_registro');
        $publicoAlvoSelecionado = $request->input('publico_alvo');
        $areaConhecimentoSelecionadaAcao = $request->input('area_conhecimento_acao');
        $areaConhecimentoSelecionadaConhecimento = $request->input('area_conhecimento_conhecimento');
        $tempoAtuacaoSelecionado = $request->input('tempo_atuacao');


        /* DEVOLVER APENAS OS CONTATOS QUE NAO FORAM REALIZADOS AINDA */
        $ofertasNaoMostrar = $this->list_ofertas_excluidas($usuarioId);

        $query = Oferta::with('usuarioProfessor', 'ofertaConhecimento', 'ofertaAcao', 'areaConhecimento', 'contato')
            ->whereNotIn('Oferta.id_oferta', $ofertasNaoMostrar);


        /* FILTRAGEM TITULO*/
        if ($request->input('pesquisa_titulo') && !$tipoOfertaSelecionada) {
            $query->when($pesquisaTitulo, function ($query, $pesquisaTitulo) {
                return $query->where('titulo', 'LIKE', '%' . $pesquisaTitulo . '%');
            });
            $listaOfertas = $query->paginate(12);

        } else {
            $listaOfertas = $query->paginate(12);
        }

        /* FILTRAGEM TIPO */
        if ($tipoOfertaSelecionada === 'ACAO') {
            if (!empty($request->all())){
                $listaOfertas = $this->filtragemOfertasAcao($request, $query);
            } 
        } elseif ($tipoOfertaSelecionada === 'CONHECIMENTO') {
            if (!empty($request->all())){
                $listaOfertas = $this->filtragemOfertasConhecimento($request, $query);
            } 
        } else {
            $listaOfertas = $query->paginate(12);
        }

        $ofertasDisponiveis = [];

        /* LOGICA PARA CONTROLAR AS OFERTAS VISUALIZADAS E NÃO VISUALIZADAS */
        foreach ($listaOfertas as $oferta) {
            /* LOGICA PARA CONTROLE DAS OFERTAS ACAO DE ACORDO COM A DATA LIMITE */
            if ($oferta->tipo == 'ACAO' && $oferta->ofertaAcao && $oferta->ofertaAcao->data_limite !== null) {
                if ($oferta->ofertaAcao->data_limite <= now()) {
                    $this->ofertaAcaoProfessorController->deleteStoreAcaoDataLimite($oferta->id_oferta);
                    continue; 
                }
            }
            /* FIM */

            $ofertaVisualizada = ContatosDiretosVisualizados::where('id_oferta', $oferta->id_oferta)
                ->where('id_usuario', $usuarioId)
                ->exists(); 

            if ($ofertaVisualizada) {
                $ofertasDisponiveis[] = ['status' => 'visualizado', 'oferta' => $oferta];
            } else {
                $ofertasDisponiveis[] = ['status' => 'nao_visualizado', 'oferta' => $oferta];
            }
        }
        return view('usuarioMembro.todas_ofertas.todas_ofertas_membro', 
            [
                'usuarioMembro' => $usuarioId,
                'ofertas' => $ofertasDisponiveis,
                'paginate' => $listaOfertas,
                'tipoOfertaSelecionada' => $tipoOfertaSelecionada,
                'pesquisaTitulo' => $pesquisaTitulo,
                'areaConhecimentoSelecionadaAcao' => $areaConhecimentoSelecionadaAcao,
                'areaConhecimentoSelecionadaConhecimento' => $areaConhecimentoSelecionadaConhecimento,
                'publicoAlvoSelecionado' => $publicoAlvoSelecionado,
                'statusRegistroSelecionado' => $statusRegistroSelecionado,
                'regimeSelecionado' => $regimeSelecionado,
                'listAreaConhecimento' => $listAreaConhecimento,
                'listPublicoAlvo' => $listPublicoAlvo,
                'tempoAtuacaoSelecionado' => $tempoAtuacaoSelecionado
            ]
        );
    }

    public function filtragemOfertasAcao(Request $request, $query) {

        $pesquisaTitulo = $request->input('pesquisa_titulo');
        $inputTipoOferta = $request->input('tipo_oferta');
        $inputAreaConhecimento = $request->input('area_conhecimento_acao');
        $inputRegime = $request->input('regime');
        $inputStatusRegistro = $request->input('status_registro');
        $inputPublicoAlvo = $request->input('publico_alvo');
    
        $query->join('OfertaAcao', 'OfertaAcao.id_oferta', '=', 'Oferta.id_oferta');
    
        $query->when($inputAreaConhecimento, function ($query, $inputAreaConhecimento) {
            return $query->where('Oferta.id_area_conhecimento', $inputAreaConhecimento);
        });

        $query->when($inputRegime, function ($query, $inputRegime) {
            return $query->where('OfertaAcao.regime', $inputRegime);
        }); 
    
        $query->when($inputStatusRegistro, function ($query, $inputStatusRegistro) {
            return $query->where('OfertaAcao.status_registro', $inputStatusRegistro);
        });
    
        $query->when($inputPublicoAlvo, function ($query, $inputPublicoAlvo) {
            return $query->where('OfertaAcao.id_publico_alvo', $inputPublicoAlvo);
        });

        $query->when($inputTipoOferta, function ($query, $inputTipoOferta) {
            return $query->where('Oferta.tipo', $inputTipoOferta);
        });

        $query->when($pesquisaTitulo, function ($query, $pesquisaTitulo) {
            return $query->where('titulo', 'LIKE', '%' . $pesquisaTitulo . '%');
        });
    
        // Execute a consulta e obtenha os resultados
        $ofertasAcaoFiltradas = $query->paginate(12);
    
        // Retorne os resultados
        return $ofertasAcaoFiltradas;
    }

    public function filtragemOfertasConhecimento(Request $request, $query) {

        $pesquisaTitulo = $request->input('pesquisa_titulo');
        $inputAreaConhecimento = $request->input('area_conhecimento_conhecimento');
        $inputTempoAtuacao = $request->input('tempo_atuacao');
        $inputTipoOferta = $request->input('tipo_oferta');
    
        $query->join('OfertaConhecimento', 'OfertaConhecimento.id_oferta', '=', 'Oferta.id_oferta');
    
        $query->when($inputAreaConhecimento, function ($query, $inputAreaConhecimento) {
            return $query->where('Oferta.id_area_conhecimento', $inputAreaConhecimento);
        }); 
    
        $query->when($inputTempoAtuacao, function ($query, $inputTempoAtuacao) {
            return $query->where('OfertaConhecimento.tempo_atuacao', $inputTempoAtuacao);
        });
    
        $query->when($inputTipoOferta, function ($query, $inputTipoOferta) {
            return $query->where('Oferta.tipo', $inputTipoOferta);
        });
    
        $query->when($pesquisaTitulo, function ($query, $pesquisaTitulo) {
            return $query->where('titulo', 'LIKE', '%' . $pesquisaTitulo . '%');
        });

        // Execute a consulta e obtenha os resultados
        $ofertasConhecimentoFiltradas = $query->paginate(12);
    
        // Retorne os resultados
        return $ofertasConhecimentoFiltradas;
    }

    public function create($ofertaId, Request $request) {
        
        $usuarioId = Auth::id();
        $oferta = Oferta::findOrFail($ofertaId);

        $mensagem = $request->input('mensagem-contato');
        
        /* CRIAR O NOVO CONTATO */
        // Criação do contato
        $contato = new Contato();
        $contato->id_usuario_origem = $usuarioId;
        $contato->id_usuario_destino = $oferta->usuarioProfessor->id_usuario;
        $contato->id_oferta = $oferta->id_oferta;
        $contato->id_demanda = null;
        $contato->tipo_contato = 'DIRETO';
        $contato->created_at = now();
        $contato->updated_at = null;
        $contato->saveOrFail();

        // Criação do ContatoMensagem
        $contatoMensagem = new ContatoMensagem();
        $contatoMensagem->id_contato = $contato->id_contato;
        $contatoMensagem->id_usuario_origem = $usuarioId;
        $contatoMensagem->id_usuario_destino = $oferta->usuarioProfessor->id_usuario; 
        if (preg_match('/<[^>]*>/', $mensagem)) {
        } else {
            $contatoMensagem->mensagem = $mensagem;
        }
        $contatoMensagem->tipo_mensagem = 'ENVIADA';
        $contatoMensagem->created_at = now();
        $contatoMensagem->updated_at = null;
        $contatoMensagem->saveOrFail();

        /* CRIAR TABELA DE EXCLUSOES PARA CONTATOS DIRETOS E COLOCAR AS OFERTAS LA */
        ContatosDiretosExcluidos::create([
            'id_usuario' => $usuarioId,
            'id_demanda' => null,
            'id_oferta' => $oferta->id_oferta,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->to(route('list_todas_ofertas'));
        
    }

    public function list_ofertas_excluidas($usuarioId)
    {
        // Consulta as ofertas excluídas de Matchings
        $ofertasExcluidasMatchings = MatchingsExcluidos::where('id_usuario', $usuarioId)
            ->pluck('id_oferta')
            ->toArray();

        // Consulta as ofertas excluídas de Contatos Diretos
        $ofertasExcluidasContatos = ContatosDiretosExcluidos::where('id_usuario', $usuarioId)
            ->pluck('id_oferta')
            ->toArray();

        // Mescla as listas de ofertas excluídas
        $ofertasExcluidas = array_merge($ofertasExcluidasMatchings, $ofertasExcluidasContatos);

        /* Remove as duplicatas */
        $ofertasExcluidas = array_unique($ofertasExcluidas);

        return $ofertasExcluidas;
    }

    public function contatos_diretos_remover($ofertaId) {

        $userId = Auth::id();
        $oferta = Oferta::findOrFail($ofertaId);

        ContatosDiretosExcluidos::create([
            'id_usuario' => $userId,
            'id_demanda' => null,
            'id_oferta' => $oferta->id_oferta,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->route('list_todas_ofertas')->with('msg-deletar', 'Oferta removida com Sucesso!');
    }

    public function contato_direto_status_visualizar($ofertaId) {
        $userId = Auth::id();
        $oferta = Oferta::findOrFail($ofertaId);
    
        $contatoDiretoExistente = ContatosDiretosVisualizados::where('id_usuario', $userId)
            ->where('id_oferta', $oferta->id_oferta)
            ->exists();
        
        if ($contatoDiretoExistente) {
            return back();/* redirect()->route('demanda_matching_index', $demandaId) */;
        }
    
        ContatosDiretosVisualizados::create([
            'id_usuario' => $userId,
            'id_demanda' => null,
            'id_oferta' => $oferta->id_oferta,
            'created_at' => now(),
            'updated_at' => null,
        ]);
    
        return back();
    }
}
