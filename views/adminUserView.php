<link href="../styles/adminEditUser.css" rel="stylesheet">

<?php
    require_once '../includes/autoload.php';
    require_once '../moduls/adminUser.php';
?>
<?php if (isset($_GET['error'])): ?>
    <p class="error">
        <?php if ($_GET['error'] == UserUpdateErrorCode::existingUser): ?>
            <?= $_SESSION['exception']->getMessage() ?>
        <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingEmail): ?>
            <?= $_SESSION['exception']->getMessage() ?>
        <?php elseif ($_GET['error'] == 'upload'): ?>
            <?= 'Hiba törtönt a feltöltés közben, probálkozz később' ?>
        <?php elseif ($_GET['error'] == 'delDoc'): ?>
            <?= 'Hiba törtönt a dokumentum törlése közben, probálkozz később' ?>
        <?php endif; ?>
    </p>
<?php endif; ?>
<form action="../moduls/adminEditUser.php" method="post">
    <label class="title">Adatok</label>
    <table>
        <tbody>
        <tr>
            <td>Felhasználónév</td>
            <td>
                <input id="username" type="text" name="username" maxlength="100" size="20" required
                       value="<?= $user->getUsername() ?>"
            </td>
        </tr>
        <tr>
            <td>Név:</td>
            <td>
                <input id="name" type="text" name="name" maxlength="100" size="20" required
                       value="<?= $user->getName() ?>">
            </td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td>
                <input id="email" type="email" name="email" maxlength="100" size="20" required value="
                <?= $user->getEmail() ?>">
            </td>
        </tr>
        </tbody>
    </table>
    <button type="submit" name="update">Mentés</button>
    <button type="submit" name="cancel">Mégse</button>

    <div class="my-container">
        <label class="title">Doksi hozzáadása</label>
        <div>
            <input type="file" name="file">
            <button name="upload">Feltölt</button>
        </div>
    </div>

    <div class="my-container">
        <label class="title">Fájljok</label>
        <table>
            <?php foreach ($user->getAllDoc() as $doc): ?>
                <tr>
                    <td><a target="_blank" href="view.php?id=<?= $doc['id'] ?>"><?= $doc['name'] ?></a></td>
                    <td>
                        <a target="_self" href="../moduls/delDec.php?id=<?= $doc['id'] ?>">
                            <button>Töröl</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</form>