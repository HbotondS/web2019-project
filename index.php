<!DOCTYPE HTML>
<html>
<head>
    <title>Testing</title>
</head>
<body>
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
        echo 'Hello ' . $pwd;
    }

    // egy session-t hoz letre, melynek neve session
    // felhasznalo neveket es jelszavakat tudunk tarolni benne,
    // annak erdekeben hogy tudjuk azonositani a usert
    $_SESSION['session'] = "12";
?>
</body>
</html>
