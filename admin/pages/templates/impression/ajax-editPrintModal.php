<?php

include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include URLADMIN.'parametres/constante.php';
$Tools->log_account_admin();

$idPrint = $Tools->data_secure($_POST['idPrint']);

$planning = $Imprimante->getPlanning("id = '".$idPrint."'");
$lstColor = $Imprimante->getLstFilament();

?>
<label class="my-2 font-weight-bold text-primary">Désignation</label>
<input type="text" name="addDesignation" class="form-control bg-light border-1 small" id="addDesignationModal" value="<?=$planning['designation']?>">

<label class="my-2 font-weight-bold text-primary">Poids</label>
<input type="text" name="addPoids" class="form-control bg-light border-1 small" id="addPoidsModal" value="<?=$planning['poids']?>">
<?php if (isset($planning['id_projet'])) : ?>
<label class="my-2 font-weight-bold text-primary">Nombre de pièces sur le plateau</label>
<input type="text" name="nombre_pieces_plateau" class="form-control bg-light border-1 small" id="nombre_pieces_plateau" value="<?=$planning['nombre_pieces_plateau']?>">
<?php endif; ?>
<label class="my-2 font-weight-bold text-primary">Temps impression</label>
<input type="time" name="addTemps" class="form-control bg-light border-1 small" id="addTempsModal" value="<?=$planning['temps_impression']?>">

<label class="my-2 font-weight-bold text-primary">Couleur</label>
<select name="idColor" class="form-control bg-light border-1 small" id="addIdColorModal">
    <option>Couleur</option>
    <?php foreach($lstColor as $data){
        echo '<option value="'.$data['id'].'"';
        if($data['id'] == $planning['id_couleur']) echo "selected";
        echo '>'.$data['reference'].' - '.$data['fabricant'].' - '.$data['designation'].'</option>';
    }?>
</select>

<label class="my-2 font-weight-bold text-primary">Personnalisation</label>
<input type="text" name="personnalisation" class="form-control bg-light border-1 small" id="addPersonnalisationModal" value="<?=$planning['personnalisation']?>">


<label class="my-2 font-weight-bold text-primary">Notes</label>
<input type="text" name="notes" class="form-control bg-light border-1 small" id="addNotesModal" value="<?=$planning['notes']?>">


<button class="btn btn-primary mt-3" onclick="editPrintSave(<?=$idPrint?>)">Modifier</button>