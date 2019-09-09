<?php
namespace Helpers;

class FiltersHelper {

    public function filter_post_money($p) {
        $price = filter_input(INPUT_POST, $p);
        $price = str_replace('.', '', $price);
        $price = str_replace(',', '.', $price);
        $price = filter_var($price, FILTER_VALIDATE_FLOAT);

        return $price;
    }

    public function invert_date($d){
        $regex ='/([0-9]{2})\/([0-9]{2})\/([0-9]{4})\s([0-9]{2}):([0-9]{2}):([0-9]{2})/';
        preg_match($regex, $d, $matches);
        $dateInv = $matches[3].'-'.$matches[2].'-'.$matches[1].' '.$matches[4].':'.$matches[5].':'.$matches[6];

        return $dateInv;
    }

}