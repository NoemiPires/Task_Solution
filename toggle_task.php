<?php
require_once 'conexao.php';

$filter = $_POST['filter'] ?? 'all';
$id = (int)($_POST['id'] ?? 0);

if ($id > 0) {
    $tarefa = R::load('tarefas', $id);
    if ($tarefa->id) {
        $tarefa->concluida = $tarefa->concluida ? 0 : 1;
        R::store($tarefa);
    }
}

header('Location: index.php?filter=' . urlencode($filter));
exit;