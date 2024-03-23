<?php 
    ob_start();
    include "admin_dashboard/controllers/mistake.php";
    $mistake = ob_get_clean();
?>

<div id="editor">
    <?php  (isset($_GET["success"]))? require_once "views/success.php" : false  ?>
    <div id="info">
        <h1>Edit Level</h1>
        <p>Fill the form to edit Level</p>
    </div>
    <section id="edit_level">
        <form action= "/memoryGame/backend/edit_level" id="form" method="post" enctype="multipart/form-data">
            <input type="hidden" value = "<?php echo($level->id_level)?>" name = 'id_level'>
            <div class="form-together">
                <div class="form-together-child">
                    <p>Type time to solve level in secondes</p>
                    <input type="number" name="time_to_solve" placeholder="Time to solve the level" required value= "<?php echo($level->time_to_solve)?>">
                </div>

                <div class="form-together-child">
                    <p>Choose unit for value that you enter up</p>
                    <div class="radio-btns">
                        <div>
                            <p>Secondes</p>
                            <input type="radio" name ="unit" value = "seconds" <?php echo ($level->unit === 'seconds') ? 'checked' : ''; ?>>
                        </div>
                        <p>or</p>
                        <div>
                            <p>Minutes</p>
                            <input type="radio" name ="unit" value = "minutes" <?php echo ($level->unit === 'minutes') ? 'checked' : ''; ?>>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-upload">
                <h2 class="form-upload-text">Images for level</h2>
                <div class="uploaded"> <?php require_once "views/level/partials/edit_level.view.images.php"; ?> </div>
            </div>
            
            <div id = "mistakes"><?php echo $mistake ?></div>

            <div>
                <button id="btn_edit_level" type = "submit">Edit level</button>
            </div>

            <div id="modal-image-change">
                <div class="form-upload-part">
                    <p>To change image you have to replace it with new Image</p>
                    <div class = "parent-images">
                        <div>
                            <h3>Current image</h3>
                            <img class="image-replace" src="" alt="image to change">
                        </div>
                        <div class="new-image-div">
                            <h3>New image</h3>
                            <img class="new-image" src="" alt="image to change">
                        </div>
                    </div>
                    
                    <input type="file" name="images[]" class ="insertNewPhoto">
                    <button id="changePhoto" class="change-image-btn">Change Image</button>
                </div>
            </div>
        </form>
        <div id="overlay"></div>
    </section>
</div>
<script src="Public/js/level/editImage.js"></script>