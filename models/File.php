<?php
class File {
    public static function getAllFiles() {
        $files = scandir('uploads_files');
        $uploads = [];
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) !== 'txt') {
                $titleFile = 'uploads_files/' . pathinfo($file, PATHINFO_FILENAME) . '.txt';
                $title = file_exists($titleFile) ? file_get_contents($titleFile) : 'Sin Título';
                $uploads[] = ['file' => $file, 'title' => htmlspecialchars($title)];
            }
        }
        return $uploads;
    }
}
?>
