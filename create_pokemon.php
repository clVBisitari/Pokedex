<?php
require 'DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['number'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $idType1 = $_POST['idType1'];
    $idType2 = $_POST['idType2'] ?? null;

    // SQL query para insertar fila
    $sql = "INSERT INTO pokemon (number, name, image, description, idType1, idType2) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("issiis", $number, $name, $image, $description, $idType1, $idType2);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: index.php");
    } else {
        echo "Error al insertar fila: " . $connection->error;
    }
    $stmt->close();
    $connection->close();
}
?>
