<?php
require_once 'conexao.php';

$filter = $_POST['filter'] ?? 'all';
$titulo = trim($_POST['task_title'] ?? '');

if ($titulo !== '') {
    $tarefa = R::dispense('tarefas');
    $tarefa->descricao = $titulo;
    $tarefa->concluida = 0;
    R::store($tarefa);
}

header('Location: index.php?filter=' . urlencode($filter));
exit;