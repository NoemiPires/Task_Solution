<?php
require_once 'classes/rb.php';

// Configuração da conexão com o MySQL
R::setup('mysql:host=127.0.0.1;dbname=task_solution', 'root', 'aluno');

if (!R::testConnection()) {
    die('Falha ao conectar com o banco de dados.');
}

// Tem que criar um   banco de dados antes de tudo porque senão dá falha