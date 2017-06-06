<?php include(ROOT.DS.'view/elements/home_header.php');
echo $this->Session->flash(); ?>

<div class="sharing-board">
    <form action="<?= \Kernel\Router::url('users/share'); ?>" method="post" enctype="multipart/form-data">
        <h1>Que voulez-vous partager aujourd'hui?</h1>
        <hr color="#12a35f" size="2"/>
        <p>
            <input name="title" type="text" class="post-title" id="post-title" placeholder="Donnez un titre à votre publication">
            </br>
            <textarea name="content" placeholder="Exprimez-vous"></textarea>
            </br>
            <input name="file" type="file" class="post-file"/>
            </br></br>
            <input type="submit" value="Publier" class="post-btn" id="post-btn"/>
        </p>
    </form>
</div>

<div class="post-feed">
    <div class="post">
        <span class="poster"><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'avatar.png'; ?>" class="poster-avatar" id="avatar">Elias W.</span>
        <span class="posted-in">19/12/2015 à 10:56</span></br>
        <h1>Apprenez à créer votre site web avec HTML5 et CSS3</h1>
        <p>
            bdgja ezbcuaiujkeci aezaianiuaezibn dbuiazi vbauije j euehauieik ervçean
            bdgja ezbcuaiujkeci aezaianiuaezibn dbuiazi vbauije j euehauieik ervçean
            bdgja ezbcuaiujkeci aezaianiuaezibn dbuiazi vbauije j euehauieik ervçean
            bdgja ezbcuaiujkeci aezaianiuaezibn dbuiazi vbauije j euehauieik ervçean
            bdgja ezbcuaiujkeci aezaianiuaezibn dbuiazi vbauije j euehauieik ervçean
            bdgja ezbcuaiujkeci aezaianiuaezibn dbuiazi vbauije j euehauieik ervçean
        </p>
        <hr />
        <span class="downloads"><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'png'.DS.'down51.png'; ?>" class="downloads-img" id="avatar">1200</span>
        <span class="comments"><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'png'.DS.'chat44.png'; ?>" class="downloads-img" id="avatar">34</span>
        </br></br>
    </div>
</div>