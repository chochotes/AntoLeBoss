<?php

/**
 *
 */
class Tools
{
  
    
    function convert_date_to_print($date, $time = null){

        $post_date_to_print = $date['8'].$date['9']." ";

        switch ($date['5'].$date['6']) {
            case "01":
            $post_date_to_print = $post_date_to_print."janvier ";
            break;
            case "02":
            $post_date_to_print = $post_date_to_print."février ";
            break;
            case "03":
            $post_date_to_print = $post_date_to_print."mars ";
            break;
            case "04":
            $post_date_to_print = $post_date_to_print."avril ";
            break;
            case "05":
            $post_date_to_print = $post_date_to_print."mai ";
            break;
            case "06":
            $post_date_to_print = $post_date_to_print."juin ";
            break;
            case "07":
            $post_date_to_print = $post_date_to_print."juillet ";
            break;
            case "08":
            $post_date_to_print = $post_date_to_print."août ";
            break;
            case "09":
            $post_date_to_print = $post_date_to_print."septembre ";
            break;
            case "10":
            $post_date_to_print = $post_date_to_print."octobre ";
            break;
            case "11":
            $post_date_to_print = $post_date_to_print."novembre ";
            break;
            case "12":
            $post_date_to_print = $post_date_to_print."décembre ";
            break;
        }

        $post_date_to_print = $post_date_to_print.$date['0'].$date['1'].$date['2'].$date['3'];

        if($time)
            return $post_date_to_print." ".$date[11].$date[12].':'.$date[14].$date[15].':'.$date[17].$date[18];
        else
            return $post_date_to_print;
    }

    
    function text_cut($text, $size, $susp = true){
        if (strlen($text) > $size) {
            $text = substr($text, 0, $size);
            $last_space = strrpos($text, " ");
            $text = substr($text, 0, $last_space);
            if($susp) $text .= "...";
        }
        return $text;
    }


    function log_account_admin($droit = null){
        if(!isset($_SESSION['adminId']) || $_SESSION['adminId'] == "" || !isset($_SESSION['droit']) || $_SESSION['droit'] == "")
            $this->redirection(URLADMIN);
        elseif($_SESSION['droit'] != $droit && $droit != null)
            $this->redirection(URLADMIN."home");
    }

    function redirection($page){
        Header("Location: ".$page);
        exit();
    }

    function data_secure($data){
        $data = trim($data);

        if (ctype_digit($data)) {
            $data = intval($data);
        } else {
            $data = htmlspecialchars(stripslashes($data));
        }

        return $data;
    }

    function printLinkModelisationImpression(){
        ?>
        <div class="banner-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="sur-mesure/modelisation/"><img src="media/banner/modelisation-3daccess.jpg" alt=""></a>
                            <div class="banner-content banner-position-3">
                                <h3>Modélisation</h3>
                                <h2>Création de votre projet, réparation, ...</h2>
                                <a href="sur-mesure/modelisation/">Découvrir</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="sur-mesure/impression/"><img src="media/banner/3d-printer-3daccess.jpg" alt=""></a>
                            <div class="banner-content banner-position-3">
                                <h3>Impression sur mesure</h3>
                                <h2>Un objet à votre image</h2>
                                <a href="sur-mesure/impression/">Découvrir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    function crypt($value, $key){
        return $value;
    }
    
    function decrypt($value, $key){
        return $value;
    }
}


 ?>