<header class="header" id="header">
    <a href="<?= Kernel\Router::url('users/home'); ?>" class="logo-link" id="logo-link">
        <img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'reading.png'; ?>" class="logo" id="logo">
    </a>
    <ul class="menu">
        <li>
            <a href="<?= \Kernel\Router::url('users/home'); ?>" class="about-btn">
                Accueil
            </a>
        </li>
        <li class="dotspacer">.</li>
        <li>
            <a href="<?= \Kernel\Router::url('users/profile'); ?>" class="blog-btn">
                Profil
            </a>
        </li>
        <li class="dotspacer">.</li>
        <li>
            <a href="<?= \Kernel\Router::url('users/libraries'); ?>" class="blog-btn">
                Bibliotheque
            </a>
        </li>
        <li class="dotspacer">.</li>
        <li>
            <a href="<?= \Kernel\Router::url('users/favorites'); ?>" class="blog-btn">
                Favoris
            </a>
        </li>
    </ul>
    <ul class="settings" id="settings">
        <li>
            <a href=""><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'avatar.png'; ?>" class="avatar" id="avatar"></a>
            <ul class="dropDown">
                <li><a href="<?= \Kernel\Router::url('blog/index'); ?>"><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'png'.DS.'hot-drink55.png'; ?>" class="pendingImg" id="logo">Acceder au blog</a></li>
                <li><a href="#"><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'png'.DS.'tool782.png'; ?>" class="pendingImg" id="logo">Paramètres</a></li>
                <li><a href="#"><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'png'.DS.'tool805.png'; ?>" class="pendingImg" id="logo">Aide et support</a></li>
                <li><a href=""><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'png'.DS.'light231.png'; ?>" class="pendingImg" id="logo">A propos</a></li>
                <li><a href="<?= \Kernel\Router::url('auth/logout'); ?>"><img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'png'.DS.'close33.png'; ?>" class="pendingImg" id="logo">Se deconnecter</a></li>
            </ul>
        </li>
    </ul>
</header>