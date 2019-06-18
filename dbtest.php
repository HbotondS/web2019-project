<?php
    include_once 'includes/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Db test</title>
</head>
<body>
<!--MySQLi-vel van ez es nem PDO-val-->
<?php
    include "projectsList.php";
?>
<?php
    $sql = "select * from posts;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['subject'] . "<br>";
        }
    }
?>
</body>
</html>
