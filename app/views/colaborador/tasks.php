<?php 
include '../views/shared/header.php'; ?>

<h1>Detalles de la Tarea</h1>
<p><strong>Título:</strong> <?= htmlspecialchars($task['title']) ?></p>
<p><strong>Descripción:</strong> <?= htmlspecialchars($task['description']) ?></p>
<p><strong>Fecha de vencimiento:</strong> <?= htmlspecialchars($task['due_date']) ?></p>
<p><strong>Estado:</strong> <?= htmlspecialchars($task['status']) ?></p>

<h2>Comentarios</h2>
<ul>
    <?php foreach ($comments as $comment): ?>
        <li>
            <p><strong><?= htmlspecialchars($comment['author_name']) ?>:</strong> <?= htmlspecialchars($comment['content']) ?></p>
            <p><small>Fecha: <?= htmlspecialchars($comment['created_at']) ?></small></p>
        </li>
    <?php endforeach; ?>
</ul>

<form action="/colaborador/add-comment" method="POST">
    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
    <label for="content">Añadir comentario:</label>
    <textarea id="content" name="content" required></textarea>
    <button type="submit">Enviar</button>
</form>


