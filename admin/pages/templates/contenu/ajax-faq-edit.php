<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include URLADMIN.'/parametres/constante.php';

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


$id = $Tools->data_secure($_POST['id']);
$data = $$classe->getFaq('id="'.$id.'"');

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="<?=$module.'/'.$page.'-add-'.$id.'/'?>" method="POST">
        <?php
            foreach($tableau as $form){
                if($form['type'] == "textarea"){
                    echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                    echo '<textarea name="'.$form['name'].'" rows = "4" class = "form-control bg-light border-1 small" ';
                    if($form['required'] == true) echo "required";
                    echo '>';
                    echo $data[$form['name']];
                    echo '</textarea>';
                }
                if($form['type'] == "text" || $form['type'] == "mail" || $form['type'] == "tel"){
                    echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                    echo '<input type="'.$form['type'].'" name="'.$form['name'].'" class="form-control bg-light border-1 small" ';
                    echo 'value="'.$data[$form['name']].'"';
                    if($form['required'] == true) echo " required";
                    echo '>'; 
                }
                if($form['type'] == "select"){
                    echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                    echo '<select name="'.$form['name'].'" class="form-control bg-light border-1 small"';
                    if($form['required'] == true) echo "required";
                    echo '>';
                    foreach($form['option'] as $option){
                        echo '<option value="'.$option['value'].'"';
                        if($option['value'] == $data[$form['name']]) echo 'selected';
                        echo '>'.$option['nom'].'</option>';
                    }
                    echo '</select>';
                }
            }
        ?>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
            <a href="<?=URLADMIN.$module.'/'.$page.'-edit-'.$id.'/'?>" class="mt-3 btn btn-primary">Modifier en détail</a>
        </div>
    </form>
</div>