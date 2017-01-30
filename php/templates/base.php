<?php

function generatePage($activeCategory,$meta = "", $content = "") {
    echo "
<!DOCTYPE html>
<html>
<head>";
    include $_SERVER['DOCUMENT_ROOT'] . '/php/templates/meta.php'; echo "
    
    $meta
    <title>Продукти | Giga Net ООД</title>
</head>
<body>";
    include $_SERVER['DOCUMENT_ROOT'] . '/php/templates/header.php';
    generateHeader($activeCategory);

    echo $content;

    include $_SERVER['DOCUMENT_ROOT'] . '/php/templates/footer.php'; echo "
</body>
</html>";
}