<?php 



foreach ($all_levels as $level) {
    echo '<div class="level">';
    echo '<div class="cell"><p>' . $level->num_rows . '</p></div>';
    echo '<div class="cell"><p>' . $level->num_columns . '</p></div>';
    echo '<div class="cell"><p>' . $level->time_to_solve . '</p></div>';
    echo '<div class="cell"><p>' . $level->unit . '</p></div>';
    
    echo '<div class="images-container">';
    for($i = 0; $i<count($level->images); $i++) {
        echo '<div>';
        echo '<img src="'. path_for_pictures . $level->images[$i]["image_path"] . '" alt="">';
        echo '<a target="_blank" href="' . path_for_pictures . $level->images[$i]["image_path"] . '">Open image</a>';
        echo '</div>';
    }
    echo '</div>';
    
    echo '<div class="actions">';
    echo "<div class='actions-btn'><a href='edit_level?id_level=$level->id_level' class='edit-btn'>Edit</a></div>";
    echo "<div class='actions-btn'><a href='edit_level?id_level=$level->id_level' class='remove-btn'>Delete</a></div>";
    echo '</div>';
    
    echo '</div>';
}

?>