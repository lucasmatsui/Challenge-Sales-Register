<?php
namespace Models;

use \Core\Model;

class Sellers extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function emailExists($email) {
        $sql = "SELECT email FROM sellers WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } 
        
        return false;
    }
    

    public function existIdSaller($id) {
        $sql = "SELECT id FROM sellers WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0)  {
            return false;
        }

        return true;
    }

    
    public function getQuantitySellersRegistred() {
        $array = array();

        $sql = "SELECT COUNT(*) as quantitySellersRegistred FROM sellers";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $array = intval($sql['quantitySellersRegistred']);
        }

        return $array;
    }


    public function addNewSaller($name, $email) {

        $sql = "INSERT INTO sellers (name, email) VALUES (:name, :email)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->execute();

        return true;
    }

    public function getExpecificSeller($id) {
        $array = array();

        $sql = "SELECT * FROM sellers WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0 ) {
            $array = $sql->fetch();
        }


        return $array;
    }

}
