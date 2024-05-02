<div class="container-fluid">
    <div class="w3-container w3-margin w3-center">
        <form class="w3-row search-form" method="post">
            <div class="w3-col-md-9 search-input">
                <input type="text" name="search_value" id="search_value" placeholder="" class="w3-input">
            </div>
            <?php $username = $_SESSION["username"] ?? null; ?>
            <div class="w3-col-md-3">
                <input type="submit" name="search_button" value="Buscar" class="btn btn-sm btn-primary">
            </div>
        </form>
        <?php if ($username == "admin"){
            echo "<a class='btn btn-success m-1 mb-2'>Agregar Pokemon</a>";
        } ?>
    </div>

    <?php
    include("DB.php");
    $username = $_SESSION["username"] ?? null;


    if (isset($_POST["search_button"])) {
        $pokemon = $_POST["search_value"];

        if (!empty($pokemon) || $pokemon == "") {
            $sql =
        "SELECT pokemon.*,  
       tipo1.name AS type1_name, tipo1.image AS type1_image, tipo2.name AS type2_name, tipo2.image AS type2_image
        FROM pokemon
        INNER JOIN type as tipo1
        ON pokemon.idType1 = tipo1.id
        LEFT JOIN type as tipo2 ON pokemon.idType2 = tipo2.id
        WHERE pokemon.name LIKE '%" . $pokemon . "%'";

            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='w3-container'>";
                echo "<div class='row'>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-4 col-sm-6 mb-4'>";
                    echo "<div class='w3-card-4 w3-center w3-blue w3-round-xxlarge'>";
                    echo "<img src='" . $row['image'] . "' style='width:90%' class='w3-image w3-round-xlarge w3-margin-top'>";
                    echo "<h2 class='w3-wide'>#" . $row['number'] . "</h2>";
                    echo "<h3>" . $row['name'] . "</h3>";

                    echo "<img src='" . $row['type1_image'] . "' alt='" . $row['type1_name'] . "' style='width:30px; height:30px;' class='w3-round w3-margin-right'>";

                    if ($row['type2_image']) {
                        echo "<img src='" . $row['type2_image'] . "' alt='" . $row['type2_name'] . "' style='width:30px; height:30px;' class='w3-round'>";
                    }

                    echo '<a href="detail.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary m-1 mb-3">Detalles</a>';

                    if ($username == "admin") {
                        echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary m-1 mb-2">Editar Pokemon</a>';
                        echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger m-1 mb-2">Eliminar Pokemon</a>';
                    }

                    if (isset($userLogin) && $userLogin) {
                        echo '<div class="options">';
                        echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-sm btn-success m-1 mb-2">Editar</a>';
                        echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger m-1 mb-2">Eliminar</a>';
                        echo '</div>';
                    }

                    echo "</div>";
                    echo "</div>";
                }

                echo "</div>";
                echo "</div>";
            } else {
                echo "<div><p class='h3'>No se encontraron resultados</p></div>";
            }


        }
    } else {
        $query = "SELECT pokemon.*,  
        tipo1.name AS type1_name, tipo1.image AS type1_image, tipo2.name AS type2_name, tipo2.image AS type2_image
        FROM pokemon
        INNER JOIN type as tipo1
        ON pokemon.idType1 = tipo1.id
        LEFT JOIN type as tipo2 ON pokemon.idType2 = tipo2.id";

        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<div class='w3-container'>";
            echo "<div class='row'>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-3 col-sm-6 mb-4'>";
                echo "<div class='w3-card-4 w3-center w3-blue w3-round-xxlarge'>";
                echo "<img src='" . $row['image'] . "' style='width:90%' class='w3-image w3-round-xlarge w3-margin-top'>";
                echo "<h2 class='w3-wide'># " . $row['number'] . "</h2>";
                echo "<h3>" . $row['name'] . "</h3>";


                echo "<img src='" . $row['type1_image'] . "' alt='" . $row['type1_name'] . "' style='width:30px; height:30px;' class='w3-round w3-margin-right'>";

                if ($row['type2_image']) {
                    echo "<img src='" . $row['type2_image'] . "' alt='" . $row['type2_name'] . "' style='width:30px; height:30px;' class='w3-round'>";
                }
                echo '<a href="detail.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary m-1 mb-3">Detalles</a>';

                if ($username == "admin") {
                    echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary m-1 mb-2">Editar Pokemon</a>';
                    echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger m-1 mb-2">Eliminar Pokemon</a>';
                }



                echo "</div>";
                echo "</div>";
            }

            echo "</div>";
            echo "</div>";
        } else {
            echo "Error en la query: " . mysqli_error($connection);
        }
    }

    mysqli_close($connection);
    ?>
</div>