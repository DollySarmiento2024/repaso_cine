<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar pelicula</title>
</head>


<body>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="campo_borrado">Selecciona cómo quieres buscar la película para borrar:</label>
        <select name="campo_borrado" id="campo_borrado">
            <option value="id">Por id película</option>
            <option value="titulo">Por Título película</option>
        </select>

        <label for="valor">Valor a borrar:</label>
        <input type="text" name="valor" id="valor" required><br>

        <input type="submit" value="Borrar">


    </form>
    <a href="index.php">Volver a home</a>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //guardar.php se encarga de recibir los datos del formulario y guardarlos en la base de datos
        require_once('conexion.php');

        //Establecer el conjunto de caracteres a utf8mb4 para soportar completamente Unicode
        $conn->set_charset("utf8mb4");

        //Recoger los datos del formulario
        $campo_borrado = $_POST['campo_borrado'];
        $valor = $_POST['valor'];


        //preparar consulta a la base de datos
        $sql = "DELETE FROM peliculas WHERE $campo_borrado = '$valor'";

        //Ejecutar la sentencia
        try {
            $conn->query($sql);
            echo "Se ha realizado correctamente el borrado <br>";
        } catch (mysqli_sql_exception $e) {
            die("Se ha producido el siguiente error:<br>" . $e->getMessage() . "<br>");
        }

        //cerrar la conexión para evitar consumir recursos
        $conn->close();
    }
    ?>
</body>

</html>