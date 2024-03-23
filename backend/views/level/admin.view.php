<?php require_once "views/partials/header.php"; ?>
<?php require_once "views/partials/body.php"; ?>
<link rel="stylesheet" href="Public/css/variables.css">
<link rel="stylesheet" href="Public/css/admin-dashboard.css">
<link rel="stylesheet" href="Public/css/reset.css">
<link rel="stylesheet" href="Public/css/alert.css">
<?php require_once "views/partials/navbar.php"; ?>
<div id ="main">
    <?php require_once "views/partials/aside.php"; ?>    
    <div id="editor">
        <h1>On left side choose what to edit</h1>
        <?php render_view($possible_views ?? null)?>
    </div>
</div>
<?php require_once "views/partials/footer.php"; ?>