<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["foto"]["name"]);
    
    // Validasi file
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validExtensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $validExtensions)) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
            echo "File telah diunggah: " . basename($_FILES["foto"]["name"]);
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
    }
}
?>
