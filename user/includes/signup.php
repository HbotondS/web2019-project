<?php
    if (isset($_POST['submit'])) {
        include_once 'connectUsers.php';

        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
            header("Location: ../user/index.php?signup=empty");
        } else {
            if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../user/index.php?signup=char");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../user/index.php?signup=invalidemail&first=$first&last=$last&uid=$uid");
            } else {
                $first = mysqli_real_escape_string($conn, $first);
                $last = mysqli_real_escape_string($conn, $last);
                $email = mysqli_real_escape_string($conn, $email);
                $uid = mysqli_real_escape_string($conn, $uid);
                $pwd = mysqli_real_escape_string($conn, $pwd);
                $pwdHashed = md5($pwd);

                $sql = "insert into users (firstname, lastname, email, username, password) 
                        values ('$first', '$last', '$email', '$uid', '$pwdHashed');";
                mysqli_query($conn, $sql);

                header("Location: ../user/index.php?signup=success");
            }
        }
    } else {
        header("Location: ../user/index.php?signup=error");
    }