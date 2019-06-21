<?php
    include_once '../includes/autoload.php';
    include_once '../moduls/userModel.php';
    require 'header.php';

    $users = (new MyPDO())->getAllUser();
?>

<h3>Az osszes felhasznalo</h3>
<table>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getUsername() ?></td>
            <td><?= $user->getRole() ?></td>
        </tr>
    <?php endforeach; ?>
</table>