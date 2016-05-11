<?php
?>
 
<div class="callout large primary">
    <div class="row column text-center">
        <h1>Send a Personalized Mother's Day Message</h1>
        <h2 class="subheader"></h2>

        <form action="<?php echo $GLOBALS['SUB_DOM']; ?>/send/" method="post" enctype="multipart/form-data">
            <input class="input" style="width:50%; margin:0 auto;" 
            type="text" name="name" placeholder="your name ...">
            <textarea class="input" style="width:50%; margin:0 auto;" 
            name="text" placeholder="your message ..."></textarea>
            <br>
            <p class="radius secondary label">
                Would you like to make your message public on our wall?
            </p>
            <br>
            <div class="container">
                <input type="radio" id="f-option" name='privacy' checked="checked" value="public">
                <label for="f-option">Public</label>
                <input type="radio" id="s-option" name="privacy" value="private">
                <label for="s-option">Private</label>
            </div>
            <input class="button" style="width:50%; margin:0 auto;" type="submit" 
            value="Make Card">
        </form>
    </div>
    <div style="text-align:center; margin-top:20px;">
        <a href="<?php echo $GLOBALS['SUB_DOM']; ?>/wall" class="button" 
        target="_blank" style="color:white;">
           See the wall of messages
        </a>
        <br>
        <a href="<?php echo $GLOBALS['SUB_DOM']; ?>/wall" target="_blank">
            <img src="<?php echo $GLOBALS['SUB_DOM']; ?>/images/flower2.jpg" style="width: 50%; margin:10px auto;">
        </a>
    </div>
</div>
    