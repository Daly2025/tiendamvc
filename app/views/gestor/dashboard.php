
<?php 
include '../views/shared/header.php'; ?>

<h1>Dashboard del Gestor</h1>
<a href="/gestor/create-project">Crear nuevo proyecto</a>
<ul>
    <?php foreach ($projects as $project): ?>
        <li>
            <strong><?= htmlspecialchars($project['title']) ?></strong>
            <p><?= htmlspecialchars($project['description']) ?></p>
            <p>Estado: <?= $project['is_closed'] ? 'Cerrado' : 'Activo' ?></p>
            <a href="/gestor/project/<?= $project['id'] ?>">Ver detalles</a>
            <a href="/gestor/close-project/<?= $project['id'] ?>">Cerrar proyecto</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../views/shared/footer.php'; ?>
