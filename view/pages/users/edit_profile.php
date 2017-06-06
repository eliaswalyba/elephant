<?php
include(ROOT.DS.'view/elements/login_header.php');
echo $this->Session->flash();
?>

<div class="container" id="container">
    <h1 class="welcome-text">Bienvenue <?= $this->Session->getObject('user')->first_name; ?></h1>
    <p>
        Le premier réseau social de partage de documents en ligne
    </p>
    <hr />
    <div class="left-side">
        <h3>Personnalisez votre profile</h3>
        <p>
            Votre profile permet aux gens de mieux vous connaitre
        </p>
        <form>
            <input type="text" placeholder="Elias Waly BA" />
        </form>
    </div>
    <div class="right-side">
        <img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'kids-reading.png'; ?>" class="logo" id="logo">
    </div>
</div>