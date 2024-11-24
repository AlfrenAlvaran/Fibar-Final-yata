<?php
$imagePath = $_SERVER['DOCUMENT_ROOT'] . "/EA/shopping/admin/productimages/34/pic1.png";
if (file_exists($imagePath)) {
    echo "File exists at $imagePath";
} else {
    echo "File does not exist at $imagePath";
}
