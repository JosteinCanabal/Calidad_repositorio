<?php
class FileController {
    public function index() {
        include 'views/otros_archivos.php'; // Incluye la vista para mostrar otros archivos
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->handleUpload();
        } else {
            echo "Método no permitido.";
        }
    }

    private function handleUpload() {
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $target_dir = "uploads_files/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            
            // Verificar tamaño del archivo (máximo 500MB)
            if ($_FILES["file"]["size"] > 500 * 1024 * 1024) {
                echo "El archivo es demasiado grande.";
                return;
            }

            // Mover el archivo subido a la carpeta "uploads_files"
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Guardar el nombre en un archivo de texto
                $title = htmlspecialchars($_POST['title']);
                $titleFile = fopen($target_dir . pathinfo($target_file, PATHINFO_FILENAME) . ".txt", "w");
                fwrite($titleFile, $title);
                fclose($titleFile);
                header("Location: index.php?controller=File"); // Redirigir a la lista de archivos
                exit();
            } else {
                echo "Lo siento, ocurrió un error al subir tu archivo.";
            }
        } else {
            echo "No se ha subido ningún archivo.";
        }
    }
}
?>

