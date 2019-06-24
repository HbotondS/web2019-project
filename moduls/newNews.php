<?php
    include_once '../includes/autoload.php';
    include_once '../includes/consoleLog.php';
    session_start();

    if (isset($_POST['go'])) {
        $news = new News();
        $news->setTitle($_POST['title']);
        $news->setContent($_POST['content']);

        $user = new User();
        $user->getDataByUsername($_SESSION['uid']);
        $news->setAuthor($user->getId());

        try {
            $news->insert();
        } catch (Exception $e) {
            $_SESSION['exception'] = $e;
                header("Location: ../views/newNewsView.php?error=failed-to-insert");
            exit();
        }
        header("Location: ../views/newNewsView.php?insert=success");
        exit();
    }