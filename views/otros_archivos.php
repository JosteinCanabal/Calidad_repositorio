<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Otros Archivos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php">
            <img src="img/LOGO LONG HANG VERTICAL.png" alt="Logo" class="logo">
        </a>
    </header>
    
    <h1>Subir Otros Archivos</h1>
    <form action="upload_otros.php" method="post" enctype="multipart/form-data">
        <label for="title">Nombre del Archivo:</label>
        <input type="text" name="title" id="title" required>
        
        <label for="file">Selecciona un archivo (JPG, PDF):</label>
        <input type="file" name="file" id="file" accept=".jpg,.pdf" required>
        
        <input type="submit" value="Subir Archivo">
    </form>
    
    <h2>Archivos Subidos</h2>
    <div id="file-list">
        <?php
        // Mostrar archivos subidos
        $files = scandir('uploads_files');
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) !== 'txt') {
                $titleFile = 'uploads_files/' . pathinfo($file, PATHINFO_FILENAME) . '.txt';
                $title = file_exists($titleFile) ? file_get_contents($titleFile) : 'Sin Título';
                
                echo '<div class="file-item">
                        <h3>' . htmlspecialchars($title) . '</h3>';
                if (pathinfo($file, PATHINFO_EXTENSION) === 'jpg') {
                    echo '<img src="uploads_files/' . $file . '" width="200" alt="Imagen">';
                } elseif (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                    echo '<a href="uploads_files/' . $file . '" target="_blank">Abrir PDF: ' . htmlspecialchars(basename($file)) . '</a>';
                }
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>

