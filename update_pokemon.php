<?php
require 'DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $number = $_POST['number'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $idType1 = $_POST['idType1'];
    $idType2 = $_POST['idType2'] ?? null;

    // SQL query para modificar fila (parametrizada)
    $sql = "UPDATE pokemon SET number = ?, name = ?, image = ?, description = ?, idType1 = ?, idType2 = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("issiiii", $number, $name, $image, $description, $idType1, $idType2, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: index.php");
    } else {
        echo "Error al intentar modificar fila: " . $connection->error;
    }
}
?>
