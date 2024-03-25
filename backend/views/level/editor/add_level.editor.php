<div id="editor">
    <div id="info">
        <h1>Add Level</h1>
        <p>Fill the form to add new Level</p>
    </div>
    <section id="add_level">
        <form action="/memoryGame/backend/add_level" id="form" method="POST" enctype="multipart/form-data">

            <div class="form-together">
                <div class="form-together-child">
                    <p>Type number of columns</p>
                    <input type="number" name="columns" placeholder="Number of columns" required>
                </div>

                <div class="form-together-child">
                    <p>Type number of rows</p>
                    <input type="number" name="rows" placeholder="Number of rows" required>
                </div>
            </div>

            <div class="form-together">
                <div class="form-together-child">
                    <p>Type time to solve level in secondes</p>
                    <input type="number" name="time_to_solve" placeholder="Time to solve the level" required>
                </div>

                <div class="form-together-child">
                    <p>Choose unit for value that you enter up</p>
                    <div class="radio-btns">
                        <div>
                            <p>Secondes</p>
                            <input type="radio" name ="unit" value = "seconds">
                        </div>
                        <p>or</p>
                        <div>
                            <p>Minutes</p>
                            <input type="radio" name ="unit" value = "minutes">
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-upload">
                <div class="form-upload-part">
                    <p>Choose images for level</p>
                    <input type="file" name="pictures[]" multiple="multiple"  required>
                    <p class="add-text">Number of pictures should be = (number of rows * number of columns)</p>
                </div>
                
                <div class="uploaded">
                    <div class="uploaded-file">
                        <img src="" alt="">
                        <p></p>
                        <img src="" alt="">
                    </div>
                </div>
            </div>

            <div id = "mistakes"><?php require_once "admin_dashboard/controllers/mistake.php"; ?></div>

            <div>
                <button type = "submit">Add level</button>
            </div>
        </form>
    </section>
</div>