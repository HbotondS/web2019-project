<?php
    include_once '../includes/autoload.php';
    include_once '../moduls/userModel.php';
    require 'header.php';
?>

<?php if (isset($_GET['error'])): ?>
    <?php if ($_GET['error'] == UserUpdateErrorCode::existingUser): ?>
        <p><?= $_SESSION['exception']->getMessage() ?></p>
    <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingEmail): ?>
        <p><?= $_SESSION['exception']->getMessage() ?></p>
    <?php endif; ?>
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