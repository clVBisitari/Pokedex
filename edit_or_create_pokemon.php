<?php
require 'DB.php';

$pokemon = null; // null es para crear un nuevo Pokémon
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $connection->prepare("SELECT * FROM pokemon WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pokemon = $result->fetch_assoc();

    if (!$pokemon) {
        echo "No se encontró el Pokémon.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Editar Pokémon' : 'Crear Pokémon'; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4"><?= $id ? 'Editar Pokémon' : 'Crear Pokémon'; ?></h1>

    <form action="<?= $id ? 'update_pokemon.php' : 'create_pokemon.php'; ?>" method="post" novalidate>
        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="number">Número:</label>
            <input type="number" class="form-control" name="number" id="number" value="<?php echo $pokemon['number'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $pokemon['name'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="image">URL de imagen:</label>
            <input type="url" class="form-control" name="image" id="image" value="<?php echo $pokemon['image'] ?? ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" name="description" id="description" required><?php echo $pokemon['description'] ?? ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="idType1">Tipo 1:</label>
            <select class="form-control" name="idType1" id="idType1" required>
                <?php
                $types = [
                    1 => 'ACERO', 2 => 'AGUA', 3 => 'BICHO', 4 => 'DRAGÓN', 5 => 'ELÉCTRICO',
                    6 => 'FANTASMA', 7 => 'FUEGO', 8 => 'HADA', 9 => 'HIELO', 10 => 'LUCHA',
                    11 => 'NORMAL', 12 => 'PLANTA', 13 => 'PSÍQUICO', 14 => 'ROCA', 15 => 'TIERRA',
                    16 => 'VENENO', 17 => 'VOLADOR'
                ];
                foreach ($types as $id => $type) {
                    $selected = ($id == ($pokemon['idType1'] ?? '')) ? 'selected' : '';
                    echo "<option value='$id' $selected>$type</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="idType2">Tipo 2:</label>
            <select class="form-control" name="idType2" id="idType2">
                <option value="">Ninguno</option>
                <?php
                foreach ($types as $id => $type) {
                    $selected = ($id == ($pokemon['idType2'] ?? '')) ? 'selected' : '';
                    echo "<option value='$id' $selected>$type</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $id ? 'Guardar Cambios' : 'Crear Pokémon'; ?></button>
    </form>
</div>
</body>
</html>
