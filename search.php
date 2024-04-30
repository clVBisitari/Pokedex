<div class="container-fluid">
    <div class="w3-container w3-margin w3-center">
        <form class="w3-row search-form" method="post">
            <div class="w3-col-md-9 search-input">
                <input type="text" name="search_value" id="search_value" placeholder="" class="w3-input">
            </div>
            <div class="w3-col-md-3">
                <input type="submit" name="search_button" value="Buscar" class="btn btn-sm btn-primary">
            </div>
        </form>
    </div>

    <?php
    include("DB.php");

    if (isset($_POST["search_button"])) {
        $pokemon = $_POST["search_value"];

        if (!empty($pokemon) || $pokemon == "") {
            $sql = "SELECT * FROM pokemon WHERE `name` LIKE '%" . $pokemon . "%'";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='w3-container'>";
                echo "<div class='row'>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-4 col-sm-6 mb-4'>";
                    echo "<div class='w3-card-4 w3-center w3-blue w3-round-xxlarge'>";
                    echo "<img src='" . $row['image'] . "' style='width:90%' class='w3-image w3-round-xlarge w3-margin-top'>";
                    echo "<h2 class='w3-wide'> #" .$row['number'] . "</h2>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo '<a href="detail.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary m-1 mb-3">Detalles</a>';

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
        $query = "SELECT * FROM pokemon";
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
                echo '<a href="detail.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary m-1 mb-3">Detalles</a>';

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
            echo "Error en la query: " . mysqli_error($connection);
        }
    }

    mysqli_close($connection);
    ?>
</div>