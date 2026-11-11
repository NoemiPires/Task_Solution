<?php
require_once 'conexao.php';

$filter = $_GET['filter'] ?? 'all';

// Consulta as tarefas conforme o filtro selecionado
if ($filter === 'todo') {
    $tarefas = R::find('tarefas', 'concluida = 0 ORDER BY id DESC');
} elseif ($filter === 'completed') {
    $tarefas = R::find('tarefas', 'concluida = 1 ORDER BY id DESC');
} else {
    $tarefas = R::findAll('tarefas', 'ORDER BY id DESC');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Solution</title>
    <link rel="stylesheet" href="Styles/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <header class="topbar">
        <h1><i class="fa-solid fa-list-check"></i> Task Solution</h1>
        <a href="logout.php"><button class="btn-logout">Logout</button></a>
    </header>

    <div class="main-container">
        <aside class="sidebar">
            <nav class="filter-nav">
                <a href="?filter=all" class="filter-btn <?php echo ($filter === 'all') ? 'active' : ''; ?>">All</a>
                <a href="?filter=todo" class="filter-btn <?php echo ($filter === 'todo') ? 'active' : ''; ?>">To do</a>
                <a href="?filter=completed" class="filter-btn <?php echo ($filter === 'completed') ? 'active' : ''; ?>">Completed</a>
            </nav>
        </aside>

        <main class="content">
            <form action="add_task.php" method="POST" class="add-task-form">
                <input type="hidden" name="filter" value="<?php echo htmlspecialchars($filter); ?>">
                <input type="text" name="task_title" placeholder="Enter a new task here..." required>
                <button type="submit">Add</button>
            </form>

            <?php if (empty($tarefas)): ?>
                <div class="empty-state">
                    <p>No tasks found.</p>
                </div>
            <?php else: ?>
                <ul class="task-list">
                    <?php foreach ($tarefas as $tarefa): ?>
                        <li class="task-item <?php echo $tarefa->concluida ? 'completed' : ''; ?>">
                            <div class="task-toggle">
                                <form action="toggle_task.php" method="POST" style="margin: 0;">
                                    <input type="hidden" name="id" value="<?php echo $tarefa->id; ?>">
                                    <input type="hidden" name="filter" value="<?php echo htmlspecialchars($filter); ?>">
                                    <label class="task-label">
                                        <input type="checkbox" onchange="this.form.submit()" <?php echo $tarefa->concluida ? 'checked' : ''; ?>>
                                        <span class="task-text"><?php echo htmlspecialchars($tarefa->descricao); ?></span>
                                    </label>
                                </form>
                            </div>

                            <div class="task-actions">
                                <?php if ($tarefa->concluida): ?>
                                    <span class="badge badge-completed">Completed</span>
                                <?php else: ?>
                                    <span class="badge badge-todo">To do</span>
                                <?php endif; ?>

                                <form action="delete_task.php" method="POST" style="margin: 0;">
                                    <input type="hidden" name="id" value="<?php echo $tarefa->id; ?>">
                                    <input type="hidden" name="filter" value="<?php echo htmlspecialchars($filter); ?>">
                                    <button type="submit" class="btn-delete" title="Delete Task">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </main>
    </div>

</body>

</html>