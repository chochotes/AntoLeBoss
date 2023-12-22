<?php

$_SESSION['title'] = "Client admin - ".NOMSITE;
$_SESSION['name_page'] = "Client";

$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="add"){
    if(isset($_POST['email']) && $_POST['email']!=""){
        $values = [];        
        if(isset($_POST['email'])) $values += ['email' => $Tools->data_secure($_POST['email'])];
        if(isset($_POST['last_name'])) $values += ['last_name' => $Tools->data_secure($_POST['last_name'])];
        if(isset($_POST['first_name'])) $values += ['first_name' => $Tools->data_secure($_POST['first_name'])];
        if(isset($_POST['phone'])) $values += ['phone' => $Tools->data_secure($_POST['phone'])];
        if(isset($_POST['cgu'])) $values += ['cgu' => $Tools->data_secure($_POST['cgu'])];
        if(isset($_POST['rgpd'])) $values += ['rgpd' => $Tools->data_secure($_POST['rgpd'])];
        if(isset($_POST['choice_email'])) $values += ['choice_email' => $Tools->data_secure($_POST['choice_email'])];
        if(isset($_POST['choice_phone'])) $values += ['choice_phone' => $Tools->data_secure($_POST['choice_phone'])];
        if(isset($_POST['statut'])) $values += ['statut' => $Tools->data_secure($_POST['statut'])];
        if(isset($_POST['date_registered'])) $values += ['date_registered' => $Tools->data_secure($_POST['date_registered'])];
        if(isset($_POST['last_log'])) $values += ['last_log' => $Tools->data_secure($_POST['last_log'])];
        if(isset($_POST['droit'])) $values += ['droit' => $Tools->data_secure($_POST['droit'])];


        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != ""){
            $id = $_GET['id'];
            if(set_update("client", $values, "id='".$id."'", 1)){
                $Admin->addEditionHistoric("client", $id, "modification", 1);
                $_SESSION['error_message'] = "Le client vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("client", $id, "modification", 0);
                $_SESSION['error_message'] = "Le client n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("client", $values, 1, 1)){
                $Admin->addEditionHistoric("client", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "Le client vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("client", "", "ajout", 0);
                $_SESSION['error_message'] = "Le client n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("client", "id='".$_GET["id"]."'", 1)){
        $_SESSION['error_message'] = "Le client vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $_SESSION['error_message'] = "Le client n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstUser = $Client->getLstClient();
?>

<div class="card-body">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste</h6>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Nom & Prénom</th>
                                <th>Téléphone</th>
                                <th>Profil</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstUser as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'boutique', 'client-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['email']?></th>
                                <th><?=$data['last_name'].' '.$data['first_name']?></th>
                                <th><?=$data['phone']?></th>
                                <th><?=$data['droit']?></th>
                                <th><?=$data['statut']?></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>