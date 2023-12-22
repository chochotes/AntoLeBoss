<?php

$_SESSION['title'] = "Produit admin - ".NOMSITE;
$_SESSION['name_page'] = "Produit";

$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="add"){
    if(isset($_POST['nom']) && $_POST['nom']!=""){
        $values = [];
        
        if(isset($_POST['nom'])) $values += ['nom' => $Tools->data_secure($_POST['nom'])];
        if(isset($_POST['identifiant'])) $values += ['identifiant' => $Tools->data_secure($_POST['identifiant'])];
        if(isset($_POST['prix'])) $values += ['prix' => $Tools->data_secure($_POST['prix'])];
        if(isset($_POST['id_tva'])) $values += ['id_tva' => $Tools->data_secure($_POST['id_tva'])];
        if(isset($_POST['description'])) $values += ['description' => $_POST['description']];
        if(isset($_POST['poids'])) $values += ['poids' => $Tools->data_secure($_POST['poids'])];
        if(isset($_POST['dimensions'])) $values += ['dimensions' => $Tools->data_secure($_POST['dimensions'])];
        if(isset($_POST['stock'])) $values += ['stock' => $Tools->data_secure($_POST['stock'])];
        if(isset($_POST['personnalisation'])) $values += ['personnalisation' => $Tools->data_secure($_POST['personnalisation'])];
        if(isset($_POST['seo_nom'])) $values += ['seo_nom' => $Tools->data_secure($_POST['seo_nom'])];
        if(isset($_POST['seo_description'])) $values += ['seo_description' => $Tools->data_secure($_POST['seo_description'])];
        if(isset($_POST['seo_meta'])) $values += ['seo_meta' => $Tools->data_secure($_POST['seo_meta'])];
        if(isset($_POST['reference'])) $values += ['reference' => $Tools->data_secure($_POST['reference'])];
        if(isset($_POST['date_visibilite'])) $values += ['date_visibilite' => $Tools->data_secure($_POST['date_visibilite'])];
        if(isset($_POST['date_nouveaute'])) $values += ['date_nouveaute' => $Tools->data_secure($_POST['date_nouveaute'])];
        if(isset($_POST['createur'])) $values += ['createur' => $Tools->data_secure($_POST['createur'])];
        if(isset($_POST['createur_url'])) $values += ['createur_url' => $Tools->data_secure($_POST['createur_url'])];
        if(isset($_POST['statut'])) $values += ['statut' => $Tools->data_secure($_POST['statut'])];
        
        
        if(isset($_POST['categorie'])){
            $values_categorie = "";
            foreach($_POST['categorie'] as $id_produit_categorie){
                $values_categorie .= ";".$Tools->data_secure($id_produit_categorie).";";
            }
            $values += ['categorie' => $values_categorie];
            unset($values_categorie);
        }
        
        if(isset($_POST['couleur'])){
            $values_categorie = "";
            foreach($_POST['couleur'] as $id_produit_categorie){
                $values_categorie .= ";".$Tools->data_secure($id_produit_categorie).";";
            }
            $values += ['couleur' => $values_categorie];
            unset($values_categorie);
        }
        else
            $values += ['couleur' => ""];
        
        if(isset($_POST['id_produit_panier'])){
            $values_produit_panier = "";
            foreach($_POST['id_produit_panier'] as $id_produit_panier){
                $values_produit_panier .= ";".$Tools->data_secure($id_produit_panier).";";
            }
            $values += ['id_produit_panier' => $values_produit_panier];
            unset($values_produit_panier);
        }
        
        if(isset($_POST['id_produit_associe'])){
            $values_produit_associe = "";
            foreach($_POST['id_produit_associe'] as $id_produit_associe){
                $values_produit_associe .= ";".$Tools->data_secure($id_produit_associe).";";
            }
            $values += ['id_produit_associe' => $values_produit_associe];
            unset($values_produit_associe);
        }
        
        if(isset($_FILES['image_principale']) && $_FILES['image_principale']['name']){
            $url = 'media/product/';
            $name_picture = $_FILES['image_principale']['name'];
            if(move_uploaded_file($_FILES['image_principale']['tmp_name'], URLSITEABS.$url.$name_picture))
                $values += ['image_principale' => $url.$name_picture];
        }
        
        $i=1;
        $lstImage = "";
        while(isset($_FILES['image_'.$i])){
            $url = 'media/product/';
            $name_picture = $_FILES['image_'.$i]['name'];
            if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'], URLSITEABS.$url.$name_picture))
                $lstImage .= $url.$name_picture.";";
            $i++;
        }
        if($lstImage) $values += ['image' => $lstImage];
        

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != ""){
            $id = $_GET['id'];
            $values += ['date_modification' => date('Y-m-d H:i:s')];
            if(set_update("produit", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("produit", $id, "modification", 1);
                $_SESSION['error_message'] = "Le produit vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit", $id, "modification", 0);
                $_SESSION['error_message'] = "Le produit n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            $values += ['date_ajout' => date('Y-m-d H:i:s')];
            if(set_insert("produit", $values, 1, 1)){
                $Admin->addEditionHistoric("produit", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "Le produit vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit", "", "ajout", 0);
                $_SESSION['error_message'] = "Le produit n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    $id = $Tools->data_secure($_GET["id"]);
    if(set_delete("produit", "id='".$id."'", 1)){
        $Admin->addEditionHistoric("produit", $id, "delete", 1);
        $_SESSION['error_message'] = "Le produit vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric("produit", $id, "delete", 0);
        $_SESSION['error_message'] = "Le produit n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstProduit = $Produit->getLstProduit();
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
                                <th>Référence</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Poids</th>
                                <th>Stock</th>
                                <th>Statut</th>
                                <th>SEO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstProduit as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'produit', 'configuration-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['reference']?></th>
                                <th><?=$data['nom']?></th>
                                <th><?=$Produit->getPriceWithTva($data['prix'], $data['id_tva'])?></th>
                                <th><?=$data['poids']?></th>
                                <th>
                                    <div class="<?php if($data['stock'] == 0) echo "bg-danger text-white" ?>">
                                        <?=$data['stock']?>
                                    </div>
                                </th>
                                <th>
                                    <div class="<?php if($data['statut'] == 3) echo "bg-danger text-white" ?>">
                                        <?php
                                        switch($data['statut']){
                                            case '0': echo 'Masqué'; break;
                                            case '1': echo 'Visible'; break;
                                            case '2': echo 'Gestion de la quantité'; break;
                                            case '3': echo 'À modifier'; break;
                                        }
                                        ?>
                                    </div>
                                </th>
                                <td class="text-center">
                                    <?php
                                    if (strlen($data['seo_nom'])>30 && strlen($data['seo_description'])>70 && strlen($data['seo_description'])<150)
                                        echo '<i class="fas fa-check bg-success text-white text-center p-2 rounded"></i>';
                                    else
                                        echo '</i><i class="fas fa-exclamation-triangle bg-danger text-white text-center p-2 rounded"></i>';
                                    ?>
                                </td>
                                <th><i class="fas fa-times" onclick="showDeleteModal('produit/configuration-delete-<?=$data['id']?>/')"></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
                <div class="text-center">
                    <a href="produit/configuration-edit-0/" class="m-5 btn btn-primary">Ajouter</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>