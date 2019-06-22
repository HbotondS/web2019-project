<?php
    include_once '../includes/autoload.php';

    $user = new User();

    if (isset($_POST['login-submit'])) {
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];
        if (isset($uid) && isset($pwd)) {
            try {
                $user->getDataByUsername($uid);
            } catch (Exception $e) {
                header("Location: ../views/login.php?error=loginfailed");

            }
            if ($user->checkPwd($pwd)) {
                session_start();
                $_SESSION['uid'] = $uid;
                if ($user->getRole() === 'user') {
                    header("Location: ../views/userView.php");
                    exit();
                } elseif ($user->getRole() === 'admin') {
                    header("Location: ../views/adminView.php");
                    exit();
                }

            } else {
                header("Location: ../views/login.php?error=loginfailed");
                exit();
            }

        }

    }