<?php
?>
<div class="callout large primary" id="card-page<?php echo $GLOBALS['ENV_NAME']; ?>">
    <div class="row column text-center">
        <h1>Mother's Day Messages</h1>
    </div>
    <?php foreach ($data['messages'] as $message) : ?>
         <div class="row column text-center">
            <h2 class="subheader"><?php echo $message['text'] ?></h2>
        </div>
    <?php endforeach; ?>
</div>