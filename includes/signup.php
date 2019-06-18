<?php
    if (isset($_POST['submit'])) {
        include_once 'connectUser.php';

        $first = $_POST['first'];
        $last = $_POST['last'];
        $eamil = $_POST['email'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        if (empty($first) || empty($last) || empty($eamil) || empty($uid) || empty($pwd)) {
            header("Location: ../user/index.php?signup=empty");
        } else {
            if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../user/index.php?signup=char");
            } elseif (!filter_var($eamil, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../user/index.php?signup=invalidemail&first=$first&last=$last&uid=$uid");
            } else {
                header("Location: ../user/index.php?signup=success");
            }
        }
    } else {
        header("Location: ../user/index.php?signup=error");
    }