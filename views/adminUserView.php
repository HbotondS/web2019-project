<link href="../styles/adminEditUser.css" rel="stylesheet">

<?php
    require_once '../includes/autoload.php';
    require_once '../moduls/adminUser.php';
?>

<a target="_self" href="adminView.php"><button type="submit" name="cancel">Vissza</button></a>
<div class="my-container">
    <label class="title">Adatok</label>
    <table>
        <tbody>
        <tr>
            <td>Id:</td>
            <td><?=$user->getId()?></td>
        </tr>
        <tr>
            <td>Felhasználónév</td>
            <td><?= $user->getUsername() ?></td>
        </tr>
        <tr>
            <td>Név:</td>
            <td><?= $user->getName() ?></td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><?= $user->getEmail() ?></td>
        </tr>
        </tbody>
    </table>

    <div class="my-container">
        <label class="title">Fájljok</label>
        <table>
            <?php foreach ($user->getAllDoc() as $doc): ?>
                <ul>
                    <li><a target="_blank" href="view.php?id=<?= $doc['id'] ?>"><?= $doc['name'] ?></a></li>
                </ul>
            <?php endforeach; ?>
        </table>
    </div>
</div>