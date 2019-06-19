<?php
    include 'includes/autoload.php'
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign up</title>
</head>
<body>
<h2>Sign up</h2>
<form action="includes/signup.php" method="post">
    <?php
        $user = new User('Dani', 'fsa', 'fsa', 'fsa', 'fsa');
        echo $user->getFirstname() . '<br>';

        if (isset($_GET['first'])) {
            $first = $_GET['first'];
            echo '<input type="text" name="first" placeholder="Firstname" value="' . $first . '">';
        } else {
            echo '<input type="text" name="first" placeholder="Firstname">';
        }

        if (isset($_GET['last'])) {
            $last = $_GET['last'];
            echo '<input type="text" name="last" placeholder="Lastname" value="' . $last . '">';
        } else {
            echo '<input type="text" name="last" placeholder="Lastname">';
        }
    ?>
    <input type="text" name="email" placeholder="E-mail">
    <?php
        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];
            echo '<input type="text" name="uid" placeholder="Username" value="' . $uid . '">';
        } else {
            echo '<input type="text" name="uid" placeholder="Username">';
        }
    ?>
    <input type="password" name="pwd" placeholder="Password">
    <button type="submit" name="submit">Sign up</button>
    <?php
        if (!isset($_GET['signup'])) {
            exit();
        } else {
            $signupCheck = $_GET['signup'];

            if ($signupCheck == 'empty') {
                echo "You didn't fill all the fields";
            } elseif ($signupCheck == "har") {
                echo "You used invalid characters";
            } elseif ($signupCheck == "invalidemail") {
                echo "You used an invalid e-amil";
            } elseif ($signupCheck == "succes") {
                echo "You have benn signed up";
            }
        }

    ?>
</form>
</body>
</html>