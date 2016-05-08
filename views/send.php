<?php
?>

<div class="callout large primary">
    <div class="row column text-center">
        <h1>Here is your Mother's Day Card</h1>
        <a class="button" target="_blank" id="ce-card-link"
        href="http://<?php echo $GLOBALS['BASE_URL']; ?>/from/<?php echo $data['link']; ?>">
            Click here to See the Card
        </a>
        <h2 class="subheader">Send this link to your Mother,</h2>
        <code class="subheader">
            <?php echo $GLOBALS['BASE_URL']; ?>/from/<?php echo $data['link']; ?>
        </code>
        <h3 class="subheader">Or use one of these social media buttons</h3>

        <!-- Your share button code -->
        <div class="fb-share-button"
        data-href="<?php echo $GLOBALS['BASE_URL']; ?>/from/<?php echo $data['link']; ?>" data-layout="button" 
        data-mobile-iframe="true">
    </div>
    </div>
</div>
