<?php
function my_autoloader($class) {
    include 'classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reading rss feeds using PHP</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="content">
    <?php

    $feed = new BlogFeed("https://dev98.de/feed/");

    foreach ($feed->posts as $item) {
        ?>
        <div class="post">
        <div class="post-head">
            <h2><a class="feed_title" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h2>
            <span><?php echo $item->date; ?></span>
        </div>
        <div class="post-content">
            <?php echo $item->summary; ?><a href="<?php echo $item->link; ?>" target="_blank">Read more</a>
        </div>
        </div>
        <?php } ?>
</div>
</body>
</html>