<?php include '../views/shared/header.php'; ?>

<h1>Crear Proyecto</h1>
<form action="/gestor/create-project" method="POST">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description"></textarea>

    <button type="submit">Crear Proyecto</button>
</form>

<?php include '../views/shared/footer.php'; ?>
