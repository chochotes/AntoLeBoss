<?php

$_SESSION['title'] = "Catégorie admin - ".NOMSITE;
$_SESSION['name_page'] = "Catégorie";
$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['nom']) && $_POST['nom']!=""){
        
        $values = [];
        if(isset($_POST['nom'])) $values += ['nom' => $Tools->data_secure($_POST['nom'])];
        if(isset($_POST['id_parent'])) $values += ['id_parent' => $Tools->data_secure($_POST['id_parent'])];
        if(isset($_POST['identifiant'])) $values += ['identifiant' => $Tools->data_secure($_POST['identifiant'])];
        if(isset($_POST['seo_nom'])) $values += ['seo_nom' => $Tools->data_secure($_POST['seo_nom'])];
        if(isset($_POST['seo_description'])) $values += ['seo_description' => $Tools->data_secure($_POST['seo_description'])];
        if(isset($_POST['seo_meta'])) $values += ['seo_meta' => $Tools->data_secure($_POST['seo_meta'])];
        if(isset($_POST['statut'])) $values += ['statut' => $Tools->data_secure($_POST['statut'])];

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $Tools->data_secure($_GET['id']);
            if(set_update("produit_categorie", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("produit_categorie", $id, "modification", 1);
                $_SESSION['error_message'] = "La catégorie vient d'être modifiée avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit_categorie", $id, "modification", 0);
                $_SESSION['error_message'] = "La catégorie n'a pas pu être modifiée.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("produit_categorie", $values, 1)){
                $Admin->addEditionHistoric("produit_categorie", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "La catégorie vient d'être ajoutée avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit_categorie", "", "ajout", 0);
                $_SESSION['error_message'] = "La catégorie n'a pas pu être ajoutée.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    $id = $Tools->data_secure($_GET["id"]);
    if(set_delete("produit_categorie", "id='".$id."'", 1)){
        $Admin->addEditionHistoric("produit_categorie", $id, "delete", 1);
        $_SESSION['error_message'] = "La catégorie vient d'être supprimée avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric("produit_categorie", $id, "delete", 0);
        $_SESSION['error_message'] = "La catégorie n'a pas pu être supprimée.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstCategorie = $Produit->getLstCategorie();
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
                                <th>Nom</th>
                                <th>Parent</th>
                                <th>Identifiant</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstCategorie as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'produit', 'categorie-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['nom']?></th>
                                <th><?=$data['id_parent']?></th>
                                <th><?=$data['identifiant']?></th>
                                <th><?php if($data['statut']) echo "Actif"; else echo "Inactif"; ?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('produit/categorie-delete-<?=$data['id']?>/')"></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter</h6>
                </div>
                <div class="card-body">
                    <form action="produit/categorie-save-0/" method="POST">
                        <h5 class="mt-3">Nom</h5>
                        <input type="text" name="nom" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Parent</h5>
                        <select name="id_parent" class="form-control bg-light border-1 small">
                            <option></option>
                            <?php foreach($lstCategorie as $dataCategorie){ ?>
                                <option value="<?=$dataCategorie['id']?>"><?=$dataCategorie['nom']?></option>
                            <?php } ?>
                        </select>
                        <h5 class="mt-3">Identifiant</h5>
                        <input type="text" name="identifiant" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Statut</h5>
                        <select name="statut" value="<?=$data['statut']?>" class="form-control bg-light border-1 small" required>
                            <option value="0">Inactif</option>
                            <option value="1">Actif</option>
                        </select>
                        <div class="text-center">
                            <input type="submit" name="add" value="Ajouter" class="mt-3 btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>