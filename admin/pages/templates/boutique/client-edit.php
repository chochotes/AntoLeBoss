<?php

$_SESSION['title'] = "Client admin - ".NOMSITE;
$_SESSION['name_page'] = "Client";

$Tools->log_account_admin();

if(isset($_GET['id']) && $_GET['id']){
    $id = $_GET['id'];
    $dataUser = $Client->getClient('id="'.$id.'"');
    $email = $dataUser['email'];
    $last_name = $dataUser['last_name'];
    $first_name = $dataUser['first_name'];
    $phone = $dataUser['phone'];
    $id_adresse = $dataUser['id_adresse'];
    $cgu = $dataUser['cgu'];
    $rgpd = $dataUser['rgpd'];
    $choice_email = $dataUser['choice_email'];
    $choice_phone = $dataUser['choice_phone'];
    $statut = $dataUser['statut'];
    $date_registered = $dataUser['date_registered'];
    $last_log = $dataUser['last_log'];
    $droit = $dataUser['droit'];
}else{
    $id = 0;
    $email = "";
    $last_name = "";
    $first_name = "";
    $phone = "";
    $id_adresse = "";
    $cgu = "";
    $rgpd = "";
    $choice_email = "";
    $choice_phone = "";
    $statut = "";
    $date_registered = "";
    $last_log = "";
    $droit = "";
}

get_head();
get_header();

?>

<form action="boutique/client-add-<?=$id?>/" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Produit</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="email" name="email" class="form-control bg-light border-1 small" value="<?=$email?>" required>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Nom</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="last_name" class="form-control bg-light border-1 small" value="<?=$last_name?>" required>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Prénom</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="first_name" class="form-control bg-light border-1 small" value="<?=$first_name?>" required>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Téléphone</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="phone" class="form-control bg-light border-1 small" value="<?=$phone?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Partage</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12 mt-3">
                                <label>Conditions générales de ventes</label>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <select name="cgu" class="form-control bg-light border-1 small" required>
                                    <option value="1" <?php if($cgu == 1) echo "selected"; ?>>Accepté</option>
                                    <option value="0" <?php if($cgu == 0) echo "selected"; ?>>Réfusé</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <label>RGPD</label>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <select name="rgpd" class="form-control bg-light border-1 small" required>
                                    <option value="1" <?php if($rgpd == 1) echo "selected"; ?>>Accepté</option>
                                    <option value="0" <?php if($rgpd == 0) echo "selected"; ?>>Réfusé</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <label>Newsletters</label>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <select name="choice_email" class="form-control bg-light border-1 small" required>
                                    <option value="1" <?php if($choice_email == 1) echo "selected"; ?>>Accepté</option>
                                    <option value="0" <?php if($choice_email == 0) echo "selected"; ?>>Réfusé</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <label>Contact par téléphone</label>
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <select name="choice_phone" class="form-control bg-light border-1 small" required>
                                    <option value="1" <?php if($choice_phone == 1) echo "selected"; ?>>Accepté</option>
                                    <option value="0" <?php if($choice_phone == 0) echo "selected"; ?>>Réfusé</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Visibilité</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Statut</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <select name="statut" class="form-control bg-light border-1 small" required>
                                    <option value="1" <?php if($statut == 1) echo "selected"; ?>>Activé</option>
                                    <option value="0" <?php if($statut == 0) echo "selected"; ?>>Désactivé</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Date inscription</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <p><?=$Tools->convert_date_to_print($date_registered,1)?></p>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Dernière connexion</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <p><?=$Tools->convert_date_to_print($last_log,1)?></p>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Profil</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <select name="droit" class="form-control bg-light border-1 small" required>
                                    <option value="user" <?php if($droit == "user") echo "selected"; ?>>Client</option>
                                    <option value="administrator" <?php if($droit == "administrator") echo "selected"; ?>>Administrateur</option>
                                    <option value="administrator-editor" <?php if($droit == "administrator-editor") echo "selected"; ?>>Rédacteur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-fixed" value="Enregistrer">
    </div>
</form>
<?php
get_footer();
?>