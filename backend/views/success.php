<div class="alert">
    <div class="alert-timer"></div>
    <p>
    <?php
        is_set_session()? false : session_start();
        echo($_SESSION["msg"] ?? "");
    ?>    
    </p>
    
</div>
<script src="Public/js/alert.js"></script>
