<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CepSeeder extends Seeder
{

    public function run(): void
    {
        // Caminho para o arquivo SQL
        $sqlFile = database_path('seeders/sql/ceps.sql');

        // Verifica se o arquivo existe
        if (!File::exists($sqlFile)) {
            $this->command->error('Arquivo SQL não encontrado: ' . $sqlFile);
            return;
        }

        // Abre o arquivo para leitura
        $file = fopen($sqlFile, 'r');
        $buffer = '';
        $instructionCount = 0;

        // Lê o arquivo até o final
        while (!feof($file)) {
            $line = fgets($file);

            // Adiciona a linha ao buffer
            $buffer .= $line;

            // Se a linha contém um ;, executa a instrução
            if (strpos($line, ';') !== false) {
                // Remove espaços em branco no início e no final
                $buffer = trim($buffer);

                // Executa a instrução no banco de dados
                DB::unprepared($buffer);

                // Limpa o buffer para a próxima instrução
                $buffer = '';
                $instructionCount++;

                // Exibe o progresso
                $this->command->info("Instrução $instructionCount executada.");
            }
        }

        // Fecha o arquivo
        fclose($file);

        $this->command->info("Processamento concluído. Total de instruções executadas: $instructionCount");
    }
}