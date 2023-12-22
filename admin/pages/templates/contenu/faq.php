<?php

$_SESSION['title'] = "Faq admin - ".NOMSITE;
$_SESSION['name_page'] = "Faq";

$Tools->log_account_admin();

$page = "faq";
$module = "contenu";
$table = "faq";
$classe = "Faq"; 

$tableau = array(
    ["type" => 'text', "titre" => 'Question', "name" => 'question', "required" => 'true'],
    ["type" => 'textarea', "titre" => 'Réponse', "name" => 'reponse', "required" => 'true'],
    ["type" => 'text', "titre" => 'Position', "name" => 'position', "required" => 'true'],
    ["type" => 'select', "titre" => 'Statut', "name" => 'statut', "required" => 'true', "option" => 
        ["1" => ["value" => '1', "nom" => 'Active'],
        "2" => ["value" => '0', "nom" => 'Inactive'],],
    ],
);

if(isset($_GET['action']) && $_GET['action']=="add"){
    if((isset($_POST['position']) && $_POST['position'])){
        
        $values = [];
        if(isset($_POST['question'])) $values += ['question' => $Tools->data_secure($_POST['question'])];
        if(isset($_POST['reponse'])) $values += ['reponse' => $_POST['reponse']];
        if(isset($_POST['position'])) $values += ['position' => $Tools->data_secure($_POST['position'])];
        if(isset($_POST['statut'])) $values += ['statut' => $Tools->data_secure($_POST['statut'])];

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != ""){
            $id = $Tools->data_secure($_GET['id']);
            $values += ['date_modification' => date('Y-m-d H:i:s')];
            if(set_update($table, $values, 'id="'.$id.'"', 1)){
                $Admin->addEditionHistorique($table, $id, "modification", 1);
                $_SESSION['error_message'] = "La FAQ vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistorique($table, $id, "modification", 0);
                $_SESSION['error_message'] = "La FAQ n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            $values += ['date_creation' => date('Y-m-d H:i:s')];
            if(set_insert($table, $values, 1, 1)){
                $Admin->addEditionHistorique($table, $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "La FAQ vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistorique($table, "", "ajout", 0);
                $_SESSION['error_message'] = "La FAQ n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    $id = $Tools->data_secure($_GET['id']);
    if(set_delete($table, 'id="'.$id.'"', 1)){
        $Admin->addEditionHistorique($table, $id, "suppression", 1);
        $_SESSION['error_message'] = "La FAQ vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistorique($table, $id, "suppression", 1);
        $_SESSION['error_message'] = "La FAQ n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();
$lstFaq = $$classe->getLstFaq();
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
                                <th>Question</th>
                                <th>Réponse</th>                               
                                <th>Position</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstFaq as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', '<?=$module?>', '<?=$page.'-edit'?>', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['question']?></th>
                                <th><?=$data['reponse']?></th>
                                <th><?=$data['position']?></th>
                                <th class="text-center">
                                    <?php 
                                        if($data['statut'] == 1) echo '<div class="bg-success text-white">Active</div>';
                                        else echo '<div class="bg-danger text-white">Inactive</div>';
                                    ?>
                                </th>
                                <th><i class="fas fa-times" onclick="showDeleteModal(<?=$module.'/'.$page.'-delete-'.$data['id'].'/'?>)"></th>
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
