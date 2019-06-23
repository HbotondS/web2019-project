<?php
    include_once '../includes/autoload.php';
    include_once '../moduls/userModel.php';
    require 'header.php';
?>

<?php if (isset($_GET['error'])): ?>
    <p class="error">
    <?php if ($_GET['error'] == UserUpdateErrorCode::existingUser): ?>
        <?= $_SESSION['exception']->getMessage() ?>
    <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingEmail): ?>
        <?= $_SESSION['exception']->getMessage() ?>
    <?php elseif ($_GET['error'] == 'upload'): ?>
        <?= 'Hiba törtönt a feltöltés közben, probálkozz később'?>
    <?php elseif ($_GET['error'] == 'delDoc'): ?>
        <?= 'Hiba törtönt a dokumentum törlése közben, probálkozz később'?>
    <?php endif; ?>
    </p>
<?php endif; ?>
<form action="../moduls/editUser.php" method="post">
    <table>
        <tbody>
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
</form>

<label>Doksi hozzáadása</label>
<form action="../moduls/editUser.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button name="upload">Feltölt</button>
</form>