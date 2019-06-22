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
    <?php endif; ?>
    </p>
<?php endif; ?>
<form action="../moduls/editUser.php" method="post">
    <table>
        <tbody>
        <tr>
            <td>Nev:</td>
            <td>
                <input id="name" type="text" name="name" maxlength="100" size="20" required
                       value="<?= $user->getName() ?>">
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input id="email" type="email" name="email" maxlength="100" size="20" required value="
                <?= $user->getEmail() ?>">
            </td>
        </tr>
        </tbody>
    </table>
    <button type="submit" name="update">Mentes</button>
    <button type="submit" name="cancel">Megse</button>
</form>

<label>Doksi hozzadasa</label>
<form action="../moduls/editUser.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button name="upload">Feltolt</button>
</form>