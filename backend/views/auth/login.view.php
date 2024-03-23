<?php require_once "views/partials/header.php"; ?>
<?php require_once "views/partials/body.php"; ?>
<link rel="stylesheet" href="Public/css/variables.css">
<link rel="stylesheet" href="Public/css/login-view.css">
<link rel="stylesheet" href="Public/css/form.css">
<link rel="stylesheet" href="Public/css/reset.css">
<section id="form">
    <form action="/memoryGame/backend/login" method="POST">

        <div>
            <p>Type your username or email</p>
            <input type="text" name='email-username' id="email-username" value="<?php echo($login->user_data["email_or_username"] ?? "")?>">
        </div>

        <div class = "password-container">
            <p>Type your password</p>
            <input type="password" name='password' id="password">
            <p class="display-password show-password">Show</p>
            <p class="display-password hide-password unactive">Hide</p>
        </div>

        <div>
            <button id="send">Log in</button>
        </div>

        <div id="mistakes">
            <?php echo($login->output ?? "");?>
        </div>

        <div id="lost_password">
            <a href="">Did you forget your password?</a>
        </div>
    </form>
</section>
<script src="Public/js/Auth/FormValidation.js"></script>
<script src="Public/js/Auth/FormControler.js"></script>
<script src="Public/js/Auth/main.js"></script>
<?php require_once "views/partials/footer.php"; ?>