<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nueva pelicula</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="id">ID:</label>
        <input type="number" name="id" id="id" required><br>

        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" id="titulo" required><br>

        <label for="director">Director:</label>
        <input type="text" name="director" id="director" required><br>

        <label for="nota">Nota:</label>
        <input type="number" name="nota" id="nota" required><br>

        <label for="anyo">Año:</label>
        <input type="number" name="anyo" id="anyo" required><br>

        <label for="presupuesto">Presupuesto:</label>
        <input type="number" name="presupuesto" id="presupuesto" step="0.1" min="0" required><br>

        <label for="img">Imagen:</label>
        <input type="file" name="img" id="img" required><br>

        <label for="url_trailer">URL trailer:</label>
        <input type="url" name="url_trailer" id="url_trailer" required><br>

        <input type="submit" value="Guardar">
        <input type="reset" value="Borrar">


    </form>
    <a href="index.php">Volver a home</a>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //guardar.php se encarga de recibir los datos del formulario y guardarlos en la base de datos
        require_once('conexion.php');

        //Establecer el conjunto de caracteres a utf8mb4 para soportar completamente Unicode
        $conn->set_charset("utf8mb4");

        //Recoger los datos del formulario
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $director = $_POST['director'];
        $nota = $_POST['nota'];
        $anyo = $_POST['anyo'];
        $presupuesto = $_POST['presupuesto'];
        $url_trailer = $_POST['url_trailer'];
        

        // Procesar la imagen
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $img_data = file_get_contents($_FILES['img']['tmp_name']); // Leer los datos del archivo
            $img_base64 = base64_encode($img_data); // Convertir la imagen a Base64
            $img_base64_escaped = $conn->real_escape_string($img_base64); // Escapar la cadena Base64
        } else {
            die("Error al subir la imagen.");
        }


        //preparar consulta a la base de datos
        $sql = "INSERT INTO peliculas(id, titulo, director, nota, anyo, presupuesto, img_base64, url_trailer) VALUES ('$id', '$titulo', '$director', $nota, $anyo, $presupuesto, '$img_base64_escaped', '$url_trailer')";
        //Ejecutar la sentencia
        try {
            $conn->query($sql);
            $id = $conn->insert_id;
            echo "Se ha realizado correctamente la inserción con la nueva id:" . $id . "<br>";
        } catch (mysqli_sql_exception $e) {
            die("Se ha producido el siguiente error:<br>" . $e->getMessage() . "<br>");
        }

        //cerrar la conexión para evitar consumir recursos
        $conn->close();
    }
    ?>
</body>

</html>