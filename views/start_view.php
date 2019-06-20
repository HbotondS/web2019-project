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
    <?php if (!isset($_SESSION['uid'])): ?>
        <div><a href="signup.php">Regisztralas</a></div>
        <div><a href="login.php">Belepes</a></div>
    <?php else: ?>
        <div><a href="../moduls/logout.php">Kilepes</a></div>
        <?php
        require 'loggedin.php';
        ?>
    <?php endif; ?>
</div>
</body>
</html>