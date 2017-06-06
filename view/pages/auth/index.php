<?php include(ROOT.DS.'view/elements/login_header.php');
echo $this->Session->flash(); ?>

<div class="forms-container" id="forms-container">
    <form class="login-form" id="login-form" action="auth/login" method="post">
        <div class="form-elements">
            <input
                type="text" name="login"
                placeholder="Email, Pseudo ou Téléphone"
                class="login-field" id="login-field" required/></br>
            <input type="password" name="password"
                   placeholder="Mot de passe"
                   class="password-field" id="password-field" required/>
            <input type="submit" value="CONNEXION"
                   class="login-btn" id="login-btn" name="login_btn" /></br>
            <span class="under-form">
                <input type="checkbox" class="stay-tunned-checkbox"
                       id="stay-tunned-checkbox" checked name="active_connection"/>
                <label for="stay-tunned-checkbox" class="stay-tunned-checkbox-label">Connexion active</label>
                <a href="#" class="lost-password">Mot de passe oublié</a>
            </span>
        </div>
    </form>

    <form class="register-form" id="register-form" method="post" action="auth/register">
        <div class="form-title">
            <h4>Nouveau sur EBANG? <em>Inscrivez-vous ici !</em></h4>
        </div><hr />
        <div class="form-elements">
            <label for="full-name-field">Prénom et nom de famille</label></br>
            <input
                type="text" name="name"
                placeholder="Ex: Elias W. BA"
                class="full-name-field" id="full-name-field"/>
            </br>
            <label for="register-email-field">Adresse electronique</label></br>
            <input type="email" name="email"
                   placeholder="Ex: e.ba4052@zig.univ.sn"
                   class="register-email-field" id="register-email-field" />
            <br>
            <label for="register-password-field">Choisissez un mot de passe</label></br>
            <input type="password" name="password"
                   placeholder="Ex: ****************"
                   class="register-password-field" id="register-password-field" />
            </br>
            <input type="submit" value="INSCRIPTION"
                   class="register-btn" id="register-btn" name="register_btn" />
        </div>
    </form>
</div>

<div class="presentation" id="presentation">
    <h1 id="presentation-title" class="presentation-title">Bienvenue dans E-Bang</h1><hr>
    <h3>Le premier réseau social de partage de document scolaire</h3>
</div>