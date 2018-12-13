<?php session_start(); ?>
<header class="container header">
    <div class="row">
        <img class="col-sm-4" id="logo-mycinema" src="../../css/image/logo_mycinema.png" alt="logo">
        <nav class="col-sm-8">
            <ul>
                <li><a href="./acceuil.php">Acceuil</a></li>
                <?php
                if (isset($_SESSION['grade']) && $_SESSION['grade'] == 1)
                {
                    ?><li><a href="./profil.php">Profil</a></li><?php
                }
                if (isset($_SESSION['grade']) && $_SESSION['grade'] == 1)
                {
                    ?><li><a href="./admin.php">Panel Admin</a></li><?php
                }
                ?>
                <?php 
                if (isset($_SESSION['id']) && isset($_SESSION['email']))
                {
                    ?>
                    <li>
                        <a href="../script/disconnect.php" class="btn" >Deconnexion</a>
                    </li>
                    <?php
                }
                else
                {
                    ?>
                    <li><button class="btn" id="connexion-drop">Se connecter</button>
                        <div class="drop-menu" id="drop-menu">
                            <form action="../script/connexion.php" method="post">
                                <div>
                                    <label for="email">Email : </label>
                                    <input required type="email" name="email" id="email">
                                </div>
                                <div>
                                    <label for="password">Mot de passe : </label>
                                    <input required type="password" name="password" id="password">
                                </div>
                                <input class="submit-btn btn" type="submit" value="connexion">
                            </form>
                            <a href="./inscription.php" id="inscription">inscription</a>
                        </div>
                    </li>
                    <?php
                }

                ?>
            </ul>
        </nav>
    </div>
</header>