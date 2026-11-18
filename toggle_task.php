<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $filter = $_POST['filter'] ?? 'all';

    $tarefa = R::findOne('tarefas', 'id = ? AND usuario_id = ?', [$id, $_SESSION['usuario_id']]);

    if ($tarefa) {
        $tarefa->concluida = $tarefa->concluida ? 0 : 1;
        R::store($tarefa);
    }

    header("Location: index.php?filter=" . urlencode($filter));
    exit;
}