<?php
    include_once 'connect.php';

    // sql injection megelozese
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "INSERT INTO posts (subject, content) VALUES
('$subject', '$content');";
    mysqli_query($conn, $sql);

    header("Location: ../index.php?insert=success");