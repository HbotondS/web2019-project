<?php
    include_once '../includes/autoload.php';
    include_once '../moduls/userModel.php';
    require 'header.php';
?>

<h3>Adataim</h3>
<table>
    <tbody>
    <tr>
        <td>Név:</td>
        <td><?= $user->getName() ?></td>
    </tr>
    <tr>
        <td>E-mail:</td>
        <td><?= $user->getEmail() ?></td>
    </tr>
    <tr>
        <td>Felhasználónév:</td>
        <td><?= $user->getUsername() ?></td>
    </tr>
    </tbody>
</table>

<a href="editUser.php"><button>Szerk.</button></a>

<form action="../moduls/deleteUser.php" method="post">
    <button type="submit" name="delete">Visszalépes</button>
</form>

<h3>Fájljaim</h3>
<table>
<?php foreach ($user->getAllDoc() as $doc): ?>
    <tr>
        <td><a target="_blank" href="view.php?id=<?=$doc['id']?>"><?=$doc['name']?></a></td>
        <td>
            <a target="_self" href="../moduls/delDec.php?id=<?=$doc['id']?>"><button>Töröl</button></a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
