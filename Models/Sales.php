<?php
namespace Models;

use \Core\Model;

class Sales extends Model {

    public function __construct() {
        parent::__construct();
    }



    public function getListOfSales() {
        $array = array();

        $sql = "SELECT 
                sales.id,
                sales.id_seller, 
                sellers.name, 
                sellers.email, 
                sales.commission, 
                sales.sale_price,
                sales.date_sale
                FROM sellers
                INNER JOIN sales ON sellers.id = sales.id_seller
                WHERE sales.disableStatus = 0 
                ORDER BY date_sale DESC, id DESC";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }

    public function existIdSales($id) {
        $sql = "SELECT id FROM sales WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0)  {
            return false;
        }

        return true;
    }

    public function getInfoAboutSale($id) {
        $array = array();
        $newArray = array();

        $sql = "SELECT 
                sales.id,
                sales.id_seller, 
                sellers.name, 
                sellers.email, 
                sales.commission, 
                sales.sale_price,
                sales.date_sale
                FROM sellers
                INNER JOIN sales ON sellers.id = sales.id_seller
                WHERE sales.disableStatus = 0 AND sales.id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        
        return $array;
    }


    public function addSale($id, $NewDateInverted, $price, $commission) {

        $sql = "INSERT INTO sales (id_seller, sale_price, date_sale, commission) VALUES
                (:id_seller, :sale_price, :date_sale, :commission)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_seller", $id);
        $sql->bindValue(":sale_price", $price);
        $sql->bindValue(":date_sale", $NewDateInverted);
        $sql->bindValue(":commission", $commission);
        $sql->execute();

        return true;
    }

    public function deleteSale($id) {

        $sql = "UPDATE sales SET disableStatus = 1 WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();


        return true;
    }

    public function editSale($id, $NewDateInverted, $price, $commission) {
        
        $sql = "UPDATE sales 
                SET sale_price = :sale_price, 
                commission = :commision, 
                date_sale = :date_sale
                WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":sale_price", $price);
        $sql->bindValue(":commision", $commission);
        $sql->bindValue(":date_sale", $NewDateInverted);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;

    }


}
