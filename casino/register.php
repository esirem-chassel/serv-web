<?php
require_once 'inc/includer.php';

if(!Installer::getInstance()->isInstalled()) {
    echo 'INSTALL IT FIRST';
    exit;
}

$results = null;
if (
    !empty($_REQUEST['login'])
    && !empty($_REQUEST['pwd'])
    && !empty($_REQUEST['pwd2'])
    && ($_REQUEST['pwd'] === $_REQUEST['pwd2'])
) {
    if(!DB::getInstance()->userExists($_REQUEST['login'])){
        DB::getInstance()->addUser($_REQUEST['login'], $_REQUEST['pwd']);
        $results = 'Utilisateur '.$_REQUEST['login'].' ajouté avec succès !';
    } else {
        $results = 'Impossible d\'ajouter l\'utilisateur '.$_REQUEST['login'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Enregistrer un nouvel utilisateur</h1>
    <?php if(!empty($results)) { ?><strong><?php echo $results; ?></strong> <?php } ?>
    <form method="post" action="register.php">
        <fieldset>
            <legend>Nouvel utilisateur</legend>
            <input type="text" name="login" placeholder="Login" />
            <input type="password" name="pwd" placeholder="Password" />
            <input type="password" name="pwd2" placeholder="Password" />
            <input type="submit" value="Enregistrer cet utilisateur !" />
        </fieldset>
    </form>
</body>

</html>