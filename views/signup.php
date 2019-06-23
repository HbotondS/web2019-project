<?php
    include_once 'backtohome.php';
    include_once '../includes/autoload.php';

    session_start();
?>

<div class="my-container">
    <?php if (isset($_GET['signup'])): ?>
        <p class="success">Regisztráció sikeres</p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error">
            <?php if ($_GET['error'] == 'notmatchingpassword'): ?>
                A két jelszó nem egyezik meg
            <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingUser): ?>
                <?= $_SESSION['exception']->getMessage() ?>
            <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingEmail): ?>
                <?= $_SESSION['exception']->getMessage() ?>
            <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingUsername): ?>
                <?= $_SESSION['exception']->getMessage() ?>
            <?php endif; ?>
        </p>
    <?php endif; ?>
    <h3 class="formc">Regisztráció</h3>
    <form id="myform" action="../moduls/signup.php" method="post">

        <div class="row">
            <label for="name">Név:</label>
            <input id="name" type="text" name="name" maxlength="100" size="40"
                   required pattern=".{8,100}"
                   placeholder="Legalább 8 karakter - betű, szám, szóköz">
        </div>

        <div class="row">
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email" maxlength="100" size="40" required
                   placeholder="a@b.ro">
        </div>

        <div class="row">
            <label for="uid">Felhasználónév:</label>
            <input id="uid" type="text" name="uid" maxlength="30" size="30" required>
        </div>

        <div class="row">
            <label for="pwd1">Jelszó:</label>
            <input id="pwd1" type="password" name="pwd1" minlength="8" maxlength="16" value="" size="30" required>
        </div>

        <div class="row">
            <label for="pwd2">Jelszó mégegyszer:</label>
            <input id="pwd2" type="password" name="pwd2" minlength="8" maxlength="16" value="" size="30">
        </div>

        <button type="submit" name="go">Regisztrálás</button>

    </form>
</div>
