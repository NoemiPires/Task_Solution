<?php
require_once 'conexao.php';

$filter = $_POST['filter'] ?? 'all';
$id = (int)($_POST['id'] ?? 0);

if ($id > 0) {
    $tarefa = R::load('tarefas', $id);
    if ($tarefa->id) {
        R::trash($tarefa);
    }
}

header('Location: index.php?filter=' . urlencode($filter));
exit;