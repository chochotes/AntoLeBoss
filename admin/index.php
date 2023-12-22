<?php

require('../parametres/constante.php');
require('parametres/constante.php');


$_SESSION['title'] = "Espace administrateur - ".NOMSITE;

if(isset($_POST['email_admin']) && $_POST['email_admin'])
{
    $email = $Tools->data_secure($_POST['email_admin']);
    $password = $Tools->data_secure($_POST['password_admin']);

    if($Admin->log_admin($email, $password)){
        $values = [];
        $values += ['last_log' => date('Y-m-d H:i:s')];
        $Client->updateDataClient($_SESSION['adminId'], $values);
        if($_SESSION['droit'] == "administrator")
            $Tools->redirection(URLADMIN.'tableaudebord/');
        else
            $Tools->redirection(URLADMIN.'accueil/');
    }else
        $error_message = "Identifiant ou mot de passe incorrect.";

}

if(isset($_SESSION['adminId']) && $_SESSION['adminId'] != "" && isset($_SESSION['droit']) && $_SESSION['droit'] != "")
    $Tools->redirection(URLADMIN.'accueil/');


get_head();
?>
<body id="index_login">
<div class="container">
    <div class="row justify-content-center pt-5">
        <section class="col-lg-5 col-md-8 col-sm-10 col-xs-12 text-center p-2 pb-5 border border-success rounded">
            <header>
                <img src="<?=URLSITEWEB?>media/logo/3daccess_logo_compress.png" id="logo" class="w-50">
            </header>
            <main>
                <h1>Espace administrateur</h1>
                <?php if($error_message): ?>
                    <p class="alert alert-danger"><?=$error_message?></p>
                <?php endif; ?>
                <form action="" method="post" class="row justify-content-center">
                    <div class="col-10 mt-5 text-left">
                        <h2>Email :</h2>
                    </div>
                    <div class="col-12 mt-3">
                        <input type="email" name="email_admin" class="w-75" required>
                    </div>
                    <div class="col-10 mt-5 text-left">
                        <h2>Mot de passe :</h2>
                    </div>
                    <div class="col-12 mt-3">
                        <input type="password" name="password_admin" class="w-75" required>
                    </div>
                    <input type="submit" name="" value="Valider" class="m-5">
                </form>
            </main>
            <footer>
                <p>Si vous n'avez pas de compte administrateur, veuillez vous connecter en utilisant le lien <a href="../se-connecter/">suivant</a>.</p>
            </footer>
        </section>
    </div>
</div>
</body>
</html>
