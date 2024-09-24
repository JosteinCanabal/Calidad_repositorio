<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $target_dir = "uploads_videos/";
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        
        // Verificar tamaño del archivo (máximo 500MB)
        if ($_FILES["video"]["size"] > 500 * 1024 * 1024) {
            echo "El archivo es demasiado grande.";
            exit;
        }

        // Mover el archivo subido a la carpeta "uploads"
        if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
            // Guardar el título en un archivo de texto
            $title = htmlspecialchars($_POST['title']);
            $titleFile = fopen($target_dir . pathinfo($target_file, PATHINFO_FILENAME) . ".txt", "w");
            fwrite($titleFile, $title);
            fclose($titleFile);
        } else {
            echo "Lo siento, ocurrió un error al subir tu archivo.";
        }
    } else {
        echo "No se ha subido ningún archivo.";
    }
    
    // Redirigir de vuelta a la página principal
    header("Location: index.php");
    exit();
}
?>

