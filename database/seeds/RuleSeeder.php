<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            // USER
            ['police_name' => 'list-users', 'display_name' => 'Listar usuários'],
            ['police_name' => 'create-users', 'display_name' => 'Criar usuários'],
            ['police_name' => 'update-users', 'display_name' => 'Atualizar usuários'],
            ['police_name' => 'delete-users', 'display_name' => 'Deletar usuários'],
            // ROLES
            ['police_name' => 'list-roles', 'display_name' => 'Listar funções'],
            ['police_name' => 'create-roles', 'display_name' => 'Criar funções'],
            ['police_name' => 'update-roles', 'display_name' => 'Atualizar funções'],
            ['police_name' => 'delete-roles', 'display_name' => 'Deletar funções'],
            // STATES
            ['police_name' => 'list-states', 'display_name' => 'Listar estados'],
            ['police_name' => 'create-states', 'display_name' => 'Criar estados'],
            ['police_name' => 'update-states', 'display_name' => 'Atualizar estados'],
            ['police_name' => 'delete-states', 'display_name' => 'Deletar estados'],
            // CITIES
            ['police_name' => 'list-cities', 'display_name' => 'Listar cidades'],
            ['police_name' => 'create-cities', 'display_name' => 'Criar cidades'],
            ['police_name' => 'update-cities', 'display_name' => 'Atualizar cidades'],
            ['police_name' => 'delete-cities', 'display_name' => 'Deletar cidades'],
            // NOTICES
            ['police_name' => 'list-notices', 'display_name' => 'Listar notícias'],
            ['police_name' => 'create-notices', 'display_name' => 'Criar notícias'],
            ['police_name' => 'update-notices', 'display_name' => 'Atualizar notícias'],
            ['police_name' => 'delete-notices', 'display_name' => 'Deletar notícias'],
            // CUSTOMERS
            ['police_name' => 'list-customers', 'display_name' => 'Listar clientes'],
            ['police_name' => 'show-customers', 'display_name' => 'Mostrar clientes'],
            // CABLES
            ['police_name' => 'list-cables', 'display_name' => 'Listar cabos'],
            ['police_name' => 'create-cables', 'display_name' => 'Criar cabos'],
            ['police_name' => 'update-cables', 'display_name' => 'Atualizar cabos'],
            ['police_name' => 'delete-cables', 'display_name' => 'Deletar cabos'],
            // BOXES
            ['police_name' => 'list-service_boxes', 'display_name' => 'Listar caixas de atendimento'],
            ['police_name' => 'create-service_boxes', 'display_name' => 'Criar caixas de atendimento'],
            ['police_name' => 'update-service_boxes', 'display_name' => 'Atualizar caixas de atendimento'],
            ['police_name' => 'delete-service_boxes', 'display_name' => 'Deletar caixas de atendimento'],
            // PROCESS STAGE ONE
            ['police_name' => 'list-process-stage-one', 'display_name' => 'Listar processos estágio um'],
            ['police_name' => 'create-process-stage-one', 'display_name' => 'Criar processos estágio um'],
            ['police_name' => 'update-process-stage-one', 'display_name' => 'Atualizar processos estágio um'],
            // PROCESS STAGE TWO
            ['police_name' => 'list-process-stage-two', 'display_name' => 'Listar processos estágio dois'],
            ['police_name' => 'update-process-stage-two', 'display_name' => 'Atualizar processos estágio dois'],
            // PROCESS STAGE THREE
            ['police_name' => 'list-process-stage-three', 'display_name' => 'Listar processos estágio três'],
            ['police_name' => 'update-process-stage-three', 'display_name' => 'Atualizar processos estágio três'],
            // PROCESS STAGE FOUR
            ['police_name' => 'list-process-stage-four', 'display_name' => 'Listar processos estágio quatro'],
            ['police_name' => 'update-process-stage-four', 'display_name' => 'Atualizar processos estágio quatro'],
            // PROCESS STAGE FIVE
            ['police_name' => 'list-process-stage-five', 'display_name' => 'Listar processos estágio cinco'],
            ['police_name' => 'update-process-stage-five', 'display_name' => 'Atualizar processos estágio cinco'],
            ['police_name' => 'delete-process-stage-five', 'display_name' => 'Deletar processos estágio cinco'],
            // PROCESS HISTORY AND LIST
            ['police_name' => 'list-general-process', 'display_name' => 'Listar processos geral'],
            ['police_name' => 'list-process-history', 'display_name' => 'Listar histórico de processos'],
            // NEXT STAGE
            ['police_name' => 'next-process-stage-one', 'display_name' => 'Avança processos no estágio um'],
            ['police_name' => 'next-process-stage-two', 'display_name' => 'Avança processos no estágio dois'],
            ['police_name' => 'next-process-stage-three', 'display_name' => 'Avança processos no estágio três'],
            ['police_name' => 'next-process-stage-four', 'display_name' => 'Avança processos no estágio quatro'],
            // PREVIOUS STAGE
            ['police_name' => 'previous-process-stage-two', 'display_name' => 'Volta processos no estágio dois'],
            ['police_name' => 'previous-process-stage-three', 'display_name' => 'Volta processos no estágio três'],
            ['police_name' => 'previous-process-stage-four', 'display_name' => 'Volta processos no estágio quatro'],
            ['police_name' => 'previous-process-stage-five', 'display_name' => 'Volta processos no estágio cinco'],
            // REPORTS
            ['police_name' => 'free-access-for-reports', 'display_name' => 'Acesso livre para relatórios'],
            // HOME TIMELINE
            ['police_name' => 'home-timeline', 'display_name' => 'Ver timeline de processos na página home'],
        ]);
    }
}
