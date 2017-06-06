<header class="header" id="header">
    <a href="<?= Kernel\Router::url('/'); ?>" class="logo-link" id="logo-link">
        <img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'reading.png'; ?>" class="logo" id="logo">
    </a>
    <form>
        <input type="search" placeholder="Recherchez un article dans Ebang" name="search" id="search-bar" class="search-bar" />
        <input type="submit" value="GO" id="search-btn" class="search-btn" name="search_btn" hidden/>
    </form>
    <ul class="menu">
        <li>
            <a href="<?= \Kernel\Router::url('about/presentation'); ?>" class="about-btn">
                A propos
            </a>
        </li>
        <li class="dotspacer">|</li>
        <li>
            <a href="<?= \Kernel\Router::url('blog/index'); ?>" class="blog-btn">
                Se connecter
            </a>
        </li>
    </ul>
</header>