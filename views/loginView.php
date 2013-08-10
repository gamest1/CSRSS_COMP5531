<?php
include("viewheader.php");
?>

    <div class="container">

      <form class="form-signin" action="../controllers/loginController.php" method="post">
        <h2 class="form-signin-heading">Log in to Esteban's Computer Store System</h2>
        <? if(isset($message)) echo '<div name="message" class="alert">' . $message . '</div>'?>
        <input type="text" class="input-block-level" name="username" placeholder="Username">
        <input type="password" class="input-block-level" name="password" placeholder="Password">

        <button class="btn btn-large btn-primary" type="submit">Log in</button>
      </form>

    </div> <!-- /container -->

<?
include("viewfooter.php");
?>