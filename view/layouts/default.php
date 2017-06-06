<!DOCTYPE html>

<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">

    <title><?= isset($title_for_layout) ? $title_for_layout : 'Bienvenue: Connectez vous - Inscrivez vous'; ?> | E-Bang.com</title>

    <link href="<?= BASE_URL.DS.'webroot/css/layout.css'; ?>" rel="stylesheet" type="text/css" />
    <?php if(isset($view_style)): ?>
        <?php if(is_array($view_style)): ?>
            <?php foreach($view_style as $style): ?>
                <link href="<?=BASE_URL.DS.'webroot/css/'.$style; ?>.css" rel="stylesheet" type="text/css" />
            <?php endforeach; ?>
        <?php else: ?>
            <link href="<?= BASE_URL.DS.'webroot/css/'.$view_style; ?>.css" rel="stylesheet" type="text/css" />
        <?php endif; ?>
    <?php endif; ?>

    <script type="text/javascript" src="<?= BASE_URL.DS.'webroot/js/jquery.js'; ?>"></script>
</head>

<body>
    <?= $content_for_layout; ?>
</body>

<?php if(isset($view_script)): ?>
    <?php if(is_array($view_script)): ?>
        <?php foreach($view_script as $script): ?>
            <script src="<?= BASE_URL.DS.'webroot/js/'.$script; ?>.js" type="text/javascript"></script>
        <?php endforeach; ?>
    <?php else: ?>
        <script src="<?= BASE_URL.DS.'webroot/js/'.$view_script; ?>.js" type="text/javascript"></script>
    <?php endif; ?>
<?php endif; ?>

</html>