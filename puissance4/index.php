<?php

require_once(__DIR__ . '/controller/User.php');
require_once(__DIR__ . '/controller/Toolbox.php');
require_once(__DIR__ . '/controller/Security.php');

session_start();

if (isset($_POST['connection'])) {
    if (!empty($_POST['loginC']) && !empty($_POST['passwordC'])) {
        $user = new User();
        $user->connection($_POST['loginC'], $_POST['passwordC']);
    } else {
        Toolbox::addMessageAlert("Remplir tous les champs.", Toolbox::RED_COLOR);
    }
}

if (isset($_POST['register'])) {
    if (!empty($_POST['loginR']) && !empty($_POST['passwordR']) && !empty($_POST['conf-password'])) {
        if ($_POST['passwordR'] == $_POST['conf-password']) {
            $user = new User();
            $user->register($_POST['loginR'], $_POST['passwordR']);
        } else {
            Toolbox::addMessageAlert("Mots de passe non identiques", Toolbox::RED_COLOR);
        }
    } else {
        Toolbox::addMessageAlert("Remplir tous les champs.", Toolbox::RED_COLOR);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/root.css" />
    <title>Accueil</title>
</head>

<body>
    <main>
        <?php require('view/errors.php'); ?>
        <div class="container">
            <?php if (!Security::isConnect()) { ?>

                <body>
                    <div class="main">
                        <input type="checkbox" id="chk" aria-hidden="true">

                        <div class="signup">
                            <form method="POST">
                                <label for="chk" aria-hidden="true">Sign up</label>
                                <input type="text" name="loginR" placeholder="User name" required="">
                                <input type="password" name="passwordR" placeholder="Password" required="">
                                <input type="password" name="conf-password" placeholder="Conf-Password" required="">
                                <button name="register">Sign up</button>
                            </form>
                        </div>

                        <div class="login">
                            <form method="POST">
                                <label for="chk" aria-hidden="true">Login</label>
                                <input type="text" name="loginC" placeholder="User name" required="">
                                <input type="password" name="passwordC" placeholder="Password" required="">
                                <button name="connection">Login</button>
                            </form>
                        </div>
                    </div>
                </body>
            <?php } else { ?>
                <h1>

                </h1>
            <?php } ?>
        </div>
    </main>
</body>

</html>