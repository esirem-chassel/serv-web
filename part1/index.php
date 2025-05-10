<?php
  $authenticated = false;
  $ids = ['login' => 'test', 'pwd' => 'test',];
  if(isset($_REQUEST['send'])) {
    if(($ids['login'] == $_REQUEST['login']) && ($ids['pwd'] == $_REQUEST['pwd'])) {
      $authenticated = true;
    }
  }
?><!doctype html>
<html>
  <head>
    <title>Test Example Please Ignore</title>
    <meta charset="utf-8" />
  </head>
  <body>
    <h1>This is a test.</h1>
    <p><?php if($authenticated)) { ?>Connecté !<?php } else { ?>Déconnecté...<?php } ?></p>
    <form method="get">
      <fieldset>
        <legend>GET</legend>
        <input type="text" name="login" placeholder="Login" />
        <input type="password" name="pwd" placeholder="Mot de passe" />
        <input type="submit" name="send" value="Tester !" />
      </fieldset>
    </form>
    <form method="post">
      <fieldset>
        <legend>POST</legend>
        <input type="text" name="login" placeholder="Login" />
        <input type="password" name="pwd" placeholder="Mot de passe" />
        <input type="submit" name="send" value="Tester !" />
      </fieldset>
    </form>
  </body>
</html>
