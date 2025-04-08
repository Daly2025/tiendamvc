<?php 
include '../views/shared/header.php'; ?>

<h1>Dashboard del Colaborador</h1>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <strong><?= htmlspecialchars($task['title']) ?></strong>
            <p><?= htmlspecialchars($task['description']) ?></p>
            <p>Fecha de vencimiento: <?= htmlspecialchars($task['due_date']) ?></p>
            <p>Estado: <?= htmlspecialchars($task['status']) ?></p>

            <?php if ($task['status'] !== 'Completada'): ?>
                <form action="/colaborador/complete-task" method="POST">
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <button type="submit">Marcar como Completada</button>
                </form>
            <?php endif; ?>

            <a href="/colaborador/task/<?= $task['id'] ?>">Ver detalles</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../views/shared/footer.php'; ?>
