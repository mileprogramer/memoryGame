<?php 

    
    $images = $level->images;

    foreach ($images as $image) {
        echo '<div class="uploaded-file">';
        echo '<input class="image-checkbox" type="checkbox" value= '.$image["id_image"].' name="checkboxes[]">';
        echo '<img class="level-image" src="'. path_for_pictures . $image["image_path"] . '" alt="">';
        echo '<a class="open-image" target="_blank" href="' . path_for_pictures . $image["image_path"] . '">Open image</a>';
        echo '<span class="change-image"><img src ="Public/img_dashboard/delete-img.svg" alt="change image" ></span>';
        echo '</div>';
    }
                    
                    
?>