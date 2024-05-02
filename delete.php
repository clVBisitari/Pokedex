<?php
include ("DB.php");

if (isset($_GET["id"])){
    $pokemon_id = $_GET["id"];
    $sql = "DELETE FROM pokemon WHERE id = $pokemon_id";

    if (mysqli_query($connection, $sql)){
        echo "Borrado correctamente";
        header("Location: index.php");
    }else{
        echo "Error al eliminar pokemon " . mysqli_error($connection);
    }
}
mysqli_close($connection);