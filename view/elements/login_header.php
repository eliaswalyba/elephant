<header class="header" id="header">
    <a href="<?= Kernel\Router::url('/'); ?>" class="logo-link" id="logo-link">
        <img src="<?= BASE_URL.DS.'webroot'.DS.'img'.DS.'reading.png'; ?>" class="logo" id="logo">
    </a>
    <ul class="menu">
        <li>
        	<a href="<?= \Kernel\Router::url('about/presentation'); ?>" class="about-btn">
        		A propos
        	</a>
        </li>
        <li class="dotspacer">|</li>
        <li>
        	<a href="<?= \Kernel\Router::url('blog/index'); ?>" class="blog-btn">
        		Le blog
        	</a>
        </li>
    </ul>
    <form class="languages" id="languages">
        <select>
            <option>Français</option>
            <option>Anglais</option>
        </select>
    </form>
</header>