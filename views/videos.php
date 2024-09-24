<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos Subidos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php">
            <img src="img/LOGO LONG HANG VERTICAL.png" alt="Logo" class="logo">
        </a>
    </header>
    
    <h1>Subir Video</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="title">Título del Video:</label>
        <input type="text" name="title" id="title" required>
        
        <label for="video">Selecciona un video (hasta 500 MB):</label>
        <input type="file" name="video" id="video" accept="video/*" required>
        
        <input type="submit" value="Subir Video">
    </form>
    
    <h2>Videos Subidos</h2>
    <div id="video-list">
        <?php
        // Mostrar videos subidos
        $files = scandir('uploads_videos');
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'mp4') {
                $titleFile = 'uploads_videos/' . pathinfo($file, PATHINFO_FILENAME) . '.txt';
                $title = file_exists($titleFile) ? file_get_contents($titleFile) : 'Sin Título';
                
                echo '<div class="video-item">
                        <h3>' . htmlspecialchars($title) . '</h3>
                        <video width="400" controls>
                            <source src="uploads_videos/' . $file . '" type="video/mp4">
                            Tu navegador no soporta la reproducción de videos.
                        </video>
                      </div>';
            }
        }
        ?>
    </div>
</body>
</html>
