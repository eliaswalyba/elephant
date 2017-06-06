<header>
    <ul>
        <?php foreach($posts as $post): ?>
            <li><a href=""><?= $post->title; ?></a></li>
        <?php endforeach; ?>
    </ul>
</header>
<?php foreach($posts as $post): ?>
    <div style="width: 60%; margin: auto; border: 1px solid #949494;padding: 0px 20px">
        <h2 style="font-family: 'Century Gothic'; color: #15af08; text-align: center"><?= $post->title; ?></h2>
        <hr />
        <p style="font-family: 'Century Gothic'; text-align: justify"><?= $post->content; ?></p>
    </div>
<?php endforeach; ?>
