<?php
    include "../includes/autoload.php";

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Felveteli</title>
</head>
<body>
<div>
    <?php
        require 'header.php';
    ?>

    <?php
        if (isset($_SESSION['uid'])) {
            require 'userView.php';
        }
    ?>
</div>
</body>
</html>