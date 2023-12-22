<?php
/*** VERSION 1.1 ***/

$monModule = $Module->getModule('module = "'.$_SESSION['module'].'" AND page = "'.$_SESSION['page'].'"');

/***** INFORMATIONS POUR LE HEADER *****/
$_SESSION['title'] = str_replace("[[NOMSITE]]", NOMSITE, $monModule['title']);
$_SESSION['name_page'] = $monModule['name_page'];
$_SESSION['monModule'] = $monModule;

$Tools->log_account_admin();

$page = $monModule['page'];
$module = $monModule['module'];
$table = $monModule['table_bdd'];
$classe = $monModule['classe'];

$lstPages = $Pages->getLstPages();

$select = array();
for($i=0; $i<count($lstPages); $i++){
    $select[$i]['value'] = $lstPages[$i]['id'];
    $select[$i]['nom'] = $lstPages[$i]['identifiant'];
}

$tableau = array(
    ["type" => 'text', "titre" => 'Nom', "name" => 'nom', "required" => 'true', "print" => true, "position" => 1],
    ["type" => 'text', "titre" => 'Identifiant', "name" => 'identifiant', "required" => 'true', "print" => true, "position" => 2],
    ["type" => 'select', "titre" => 'Page', "name" => 'id_page', "required" => 'true', "option" => $select, "print" => true, "position" => 3],
    ["type" => 'select', "titre" => 'Statut', "name" => 'statut', "required" => 'true', "option" =>
        ["1" => ["value" => '1', "nom" => 'Activé'],
        "2" => ["value" => '0', "nom" => 'Désactivé'],], "print" => true, "position" => 4
    ],
    ["type" => 'ckeditor', "titre" => 'Contenu', "name" => 'contenu', "required" => 'true', "print" => false, "position" => 5],
);

if(isset($_GET['action']) && $_GET['action']=="add"){
    if((isset($_POST['identifiant']) && $_POST['identifiant'])){
        
        $values = [];
        foreach($tableau as $form){
            if(isset($_POST[$form['name']])){
                if($form['type'] != "ckeditor") $content = $Tools->data_secure($_POST[$form['name']]);
                else $content = $_POST[$form['name']];
                
                $values += array($form['name'] => $content);
            }
        }

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != ""){
            $id = $Tools->data_secure($_GET['id']);
            $values += ['date_modification' => date('Y-m-d H:i:s')];
            if(set_update($table, $values, 'id="'.$id.'"', 1)){
                $Admin->addEditionHistoric($table, $id, "modification", 1);
                $_SESSION['error_message'] = "Le contenu vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric($table, $id, "modification", 0);
                $_SESSION['error_message'] = "Le contenu n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            $values += ['date_creation' => date('Y-m-d H:i:s')];
            if(set_insert($table, $values, 1, 1)){
                $Admin->addEditionHistoric($table, $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "Le contenu vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric($table, "", "ajout", 0);
                $_SESSION['error_message'] = "Le contenu n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    $id = $Tools->data_secure($_GET['id']);
    if(set_delete($table, 'id="'.$id.'"', 1)){
        $Admin->addEditionHistoric($table, $id, "suppression", 1);
        $_SESSION['error_message'] = "Le contenu vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric($table, $id, "suppression", 1);
        $_SESSION['error_message'] = "Le contenu n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();
$lstContenu = $$classe->getLstContenu();
?>

<div class="card-body">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste</h6>
                </div>
                <div class="table-responsive p-2" id="table_result_search">
                    <table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Page</th>
                                <th>Identifiant</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstContenu as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', '<?=$module?>', '<?=$page.'-edit'?>', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['nom']?></th>
                                <th><?=$Pages->getPages('id="'.$data['id_page'].'"')['identifiant']?></th>
                                <th><?=$data['identifiant']?></th>
                                <th class="text-center">
                                    <?php 
                                        if($data['statut'] == 1) echo '<div class="bg-success text-white">Activé</div>';
                                        else echo '<div class="bg-danger text-white">Désactivé</div>';
                                    ?>
                                </th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('<?=$module.'/'.$page.'-delete-'.$data['id'].'/'?>')"></th>
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
                    <form action="<?=$module.'/'.$page.'-add-0/'?>" method="POST">
                        <?php
                            foreach($tableau as $form){
                                if($form['print']){
                                    if($form['type'] == "textarea"){
                                        echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                                        echo '<textarea name="'.$form['name'].'" rows = "4" class = "form-control bg-light border-1 small" ';
                                        if($form['required'] == true) echo "required";
                                        echo '></textarea>';
                                    }
                                    if($form['type'] == "text" || $form['type'] == "mail" || $form['type'] == "tel"){
                                        echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                                        echo '<input type="'.$form['type'].'" name="'.$form['name'].'" class="form-control bg-light border-1 small"';
                                        if($form['required'] == true) echo "required";
                                        echo '>';
                                    }
                                    if($form['type'] == "select"){
                                        echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                                        echo '<select name="'.$form['name'].'" class="form-control bg-light border-1 small"';
                                        if($form['required'] == true) echo "required";
                                        echo '>';
                                        foreach($form['option'] as $option){
                                            echo '<option value="'.$option['value'].'">'.$option['nom'].'</option>';
                                        }
                                        echo '</select>';
                                    }
                                }
                            }
                        ?>
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