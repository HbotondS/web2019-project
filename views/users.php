<?php
    include_once '../includes/autoload.php';
    include_once '../moduls/userModel.php';
    require 'header.php';

    $users = (new MyPDO())->getAllUser();
?>

<a target="_self" href="adminView.php"><button>Vissza</button></a>
<h3>Az összes felhasználó</h3>
<table>
    <thead>
    <tr>
        <th>Név</th>
        <th>E-mail</th>
        <th>Felhasználónév</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getUsername() ?></td>
            <td><a target="_self" href="adminUserView.php?id=<?=$user->getId()?>"><button>Megnyitás</button></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>