<?php
$folder = 'assets/images/productos/'; // Carpeta donde están tus imágenes
$files = scandir($folder);
$count = 1;

foreach ($files as $file) {
    if ($file !== '.' && $file !== '..' && is_file($folder . $file)) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        
        // Formato prod01b, prod02b, etc.
        $newName = 'prod' . str_pad($count, 2, '0', STR_PAD_LEFT) . 'b.' . $extension;

        // Renombrar archivo
        rename($folder . $file, $folder . $newName);
        echo "Renombrado: $file -> $newName<br>";
        
        $count++;
    }
}

echo "<br>Renombrado completo.";
?>
