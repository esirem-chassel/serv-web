<?php
    require_once 'inc/includer.php';

    if(!Installer::getInstance()->isInstalled()) {
        echo 'INSTALL IT FIRST';
        exit;
    }

    if(!empty($_REQUEST['login']) && !empty($_REQUEST['pwd'])) {
        Session::getInstance()->auth($_REQUEST['login'], $_REQUEST['pwd']);
    }

    $isAuth = Session::getInstance()->isAuth();
    $authed = Session::getInstance()->getAuthedUser();

    $results = 'Lancez le dé !';
    $error = '';
    if($isAuth) {
        $coins = $authed['coins'];
        if(!empty($_REQUEST['bet'])) {
            $bet = intval($_REQUEST['bet']);
            if(0 < $bet) {
                if($coins >= $bet) {
                    $coins -= $bet;
                    $dice = ceil(mt_rand(1, 6));
                    if($dice <= 1) {
                        $results = 'Echec Critique ('.$dice.') ! La mise est perdue !';
                    } elseif($dice >= 6) {
                        $results = 'Réussite Critique ('.$dice.') ! La mise est triplée !';
                        $coins += ($bet * 3);
                    } elseif($dice <= 3) {
                        $results = 'Echec ('.$dice.') ! La mise est remboursée à moitié !';
                        $coins += floor($bet / 2);
                    } else {
                        $results = 'Réussite simple ('.$dice.') ! La mise est remboursée avec un ajout de 50% !';
                        $coins += floor($bet * 1.5);
                    }

                    if(0 >= $coins) {
                        $results .= ' Vous êtes à sec ! Et du coup, le casino vous éjecte.';
                        DB::getInstance()->deleteUser($authed['login']);
                        // log off
                    } else {
                        DB::getInstance()->saveUser($authed['login'], $coins);
                    }
                }
            }
        }
    }

?><!doctype html>
<html>

<head>
    <title>COINS</title>
    <meta charset="utf-8" />
</head>

<body>
    <h1>CASINO SIMPLE</h1>
    <?php if($isAuth && ($coins > 0)) { ?>
        <h2>Vous avez <?php echo $coins; ?> 🪙</h2>
        <?php if(!empty($error)) { ?><strong><?php echo $error; ?></strong><?php } ?>
        <p><?php echo $results; ?></p>
        <form method="post" action="index.php">
            <fieldset>
                <legend>Parier</legend>
                <input type="number"
                name="bet" size="10" min="10" max="<?php echo $coins; ?>" step="1"
                placeholder="Montant du pari" />
                <input type="submit" value="PARIER !" />
            </fieldset>
        </form>
    <?php } else { ?>
        <form method="post" action="index.php">
            <fieldset>
                <legend>Connexion</legend>
                <input type="text" name="login" placeholder="Login" />
                <input type="password" name="pwd" placeholder="Password" />
                <input type="submit" value="Se connecter !" />
            </fieldset>
        </form>
        <p>
            <a href="register.php">Créer un nouveau compte</a>
        </p>
    <?php } ?>
</body>

</html>