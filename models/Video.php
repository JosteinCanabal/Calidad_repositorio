<?php
class Video {
    public static function getAllVideos() {
        $files = scandir('uploads_videos');
        $videos = [];
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'mp4') {
                $titleFile = 'uploads_videos/' . pathinfo($file, PATHINFO_FILENAME) . '.txt';
                $title = file_exists($titleFile) ? file_get_contents($titleFile) : 'Sin Título';
                $videos[] = ['file' => $file, 'title' => htmlspecialchars($title)];
            }
        }
        return $videos;
    }
}
?>
