<?php 
include '../views/shared/header.php'; ?>

<h1>Asignar Tarea</h1>
<form action="/gestor/assign-task" method="POST">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description"></textarea>

    <label for="due_date">Fecha de vencimiento:</label>
    <input type="date" id="due_date" name="due_date" required>

    <label for="assigned_user_id">Colaborador:</label>
    <select id="assigned_user_id" name="assigned_user_id" required>
        <?php foreach ($collaborators as $collaborator): ?>
            <option value="<?= $collaborator['id'] ?>">
                <?= htmlspecialchars($collaborator['name']) ?> <?= htmlspecialchars($collaborator['surname']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Asignar Tarea</button>
</form>

<?php include '../views/shared/footer.php'; ?>