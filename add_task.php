<?php
// Vincular a sessão ao dono da tarefa
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = trim($_POST['task_title'] ?? '');
    $filter = $_POST['filter'] ?? 'all';

    if (!empty($descricao)) {
        $tarefa = R::dispense('tarefas');
        $tarefa->descricao = $descricao;
        $tarefa->concluida = 0;
        $tarefa->usuario_id = $_SESSION['usuario_id']; // Vincula ao utilizador logado
        R::store($tarefa);
    }
    header('Location: index.php?filter=' . urlencode($filter));
    exit;
}
