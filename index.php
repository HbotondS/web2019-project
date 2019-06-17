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
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="contact.php">Contact</a></li>
</ul>

<!-- lehet hasznalni post vagy get method-t -->
<!-- nekem a post jobban tetszik mert az ertekek nem jelennek meg az urlben -->
<form method="post">
    <label>
        User:
        <input type="text" name="user" placeholder="username">
    </label>
    <label>
        Password:
        <input type="password" name="pwd" placeholder="password">
    </label>
    <button type="submit" name="submit">Login</button>
</form>
<?php
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $pwd = $_POST['pwd'];
        echo 'Hello ' . $user;

        // egy session-t hoz letre, melynek neve session
        // felhasznalo neveket es jelszavakat tudunk tarolni benne,
        // annak erdekeben hogy tudjuk azonositani a usert
        $_SESSION['user'] = $user;
    }
?>
</body>
</html>
