<?php
    // elkezdi a sessiont, es igy a sessiob valtozok mas php fajlokba us elerhetoek lesznek
    session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Testing</title>
</head>
<body>
<?php
    include 'projectsList.php';
?>
<?php
    if (isset($_SESSION['user'])) {
        echo 'Hello ' . $_SESSION['user'];
    } else {
        echo 'You are not logged in!';
    }
?>
</body>
</html>

