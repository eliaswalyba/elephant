<?php include(ROOT.DS.'view/elements/blog_header.php');?>

<div class="blog-banner" id="blog-banner">
    <div class="wrapper">
    </div>
</div>

<div class="latest">
    <h1>Les derniers articles</h1>
    <?php foreach($articles as $article): ?>
        <div class="article">
            <h1><?= $article->title; ?></h1><hr />
            <p><?= substr($article->content, 0, 500); ?></p>
        </div>
    <?php endforeach; ?>
</div>
