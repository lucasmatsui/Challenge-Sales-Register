<?php
namespace Controllers;

use \Core\Controller;
use \Helpers\RequestHelpers;
use \Helpers\FiltersHelper;
use \Models\Sellers;
use \Models\Sales;
use \Models\Report;




class AjaxHomeController extends Controller{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$data = array();

        $resquestHelpers = new RequestHelpers();        
        $sales = new Sales();

        if(!$resquestHelpers->verifyRequestWasPost()) {
            $resquestHelpers->redirectToPage();
            exit;
        }  
        
        $data["getListOfSales"] = $sales->getListOfSales();
        
        echo json_encode($data);
    }

    
    public function addNewSeller() {
        $data = array();

        $resquestHelpers = new RequestHelpers();
        $sellers = new Sellers();

        if(!$resquestHelpers->verifyRequestWasPost()) {
            $resquestHelpers->redirectToPage();
            exit;
        }   
        
        if(isset($_POST['name']) && !empty($_POST['name']) && 
            isset($_POST['email']) && !empty($_POST['email'])) {

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

            if($sellers->emailExists($email)) {
                $data['msg'] = "emailNotExist";
                echo json_encode($data);
                exit;
            }

            if($sellers->addNewSaller($name, $email)){
                $data['msg'] = "success";
            } else {
                $data['msg'] = "somethigIsWrong";
            }  
            
            echo json_encode($data);
            
        } 
       
    }

    
    public function getQuantityOfSellers() {
        $data = 0;

        $resquestHelpers = new RequestHelpers();
        $sellers = new Sellers();


        if(!$resquestHelpers->verifyRequestWasPost()) {
            $resquestHelpers->redirectToPage();
            exit;
        }

        
        $data = $sellers->getQuantitySellersRegistred();

        echo json_encode($data);

    }

    public function getExpecificSeller($id) {
        $data = array();

        
        $resquestHelpers = new RequestHelpers();
        $sellers= new Sellers();

        if(!$resquestHelpers->verifyRequestWasPost() && empty($id)) {
            $resquestHelpers->redirectToPage();
            exit;
        }

        $data['getExpecificSeller'] = $sellers->getExpecificSeller($id);


        echo json_encode($data);

    }
    

    public function addSales() {
        $data = array();

        $resquestHelpers = new RequestHelpers();
        $filtersHelper = new FiltersHelper();
        $sales = new Sales();
        $sellers = new Sellers();

        if(!$resquestHelpers->verifyRequestWasPost()) {
            $resquestHelpers->redirectToPage();
            exit;
        }

        if(isset($_POST['id']) && !empty($_POST['id']) && 
            isset($_POST['date']) && !empty($_POST['date']) &&
            isset($_POST['price']) && !empty($_POST['price']) &&
            isset($_POST['commission']) && !empty($_POST['commission'])) {

            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
            $NewDateInverted = $filtersHelper->invert_date($date);
            $price = $filtersHelper->filter_post_money('price');
            $commission = $filtersHelper->filter_post_money('commission');

            if($sellers->existIdSaller($id)) {
                $data['msg'] = "notfound";
                echo json_encode($data);
                exit;
            }
    
            if(!$NewDateInverted) {
                $data['msg'] = "somethingIsWrongDanger";
                echo json_encode($data);
                exit;
            }
    
            if(!$price) {
                $data['msg'] = "isNotPrice";
                echo json_encode($data);
                exit;
            }
    
            if(!$commission) {
                $data['msg'] = "isNotCommission";
                echo json_encode($data);
                exit;
            }
    
            
            if($sales->addSale($id, $NewDateInverted, $price, $commission)) {
                $data['msg'] = "success";
            } else {
                $data['msg'] = "somethingIsWrongDanger";
            }
    
            echo json_encode($data);            
        }
    
    }


    function deleteSales($id) {
        $data = array();

        $resquestHelpers = new RequestHelpers();
        $sales = new Sales();

        if(!$resquestHelpers->verifyRequestWasPost()) {
            $resquestHelpers->redirectToPage();
            exit;
        }

        if(!isset($id) && empty($id)) {
            $data['msg'] = "somethingIsWrongId";
            echo json_encode($data);
            exit;
        }

        if($sales->deleteSale($id)) {
            $data['msg'] = "success";
        } else {
            $data['msg'] = "somethingIsWrongDanger";
        }

        echo json_encode($data);
    }


    public function editSale($id) {
        $data = array();

        $resquestHelpers = new RequestHelpers();
        $filtersHelper = new FiltersHelper();
        $sales = new Sales();

        if(!$resquestHelpers->verifyRequestWasPost()) {
            $resquestHelpers->redirectToPage();
            exit;
        }

        if(isset($_POST['date']) && !empty($_POST['date']) &&
            isset($_POST['price']) && !empty($_POST['price']) &&
            isset($_POST['commission']) && !empty($_POST['commission'])) {

            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
            $NewDateInverted = $filtersHelper->invert_date($date);
            $price = $filtersHelper->filter_post_money('price');
            $commission = $filtersHelper->filter_post_money('commission');

            if($sales->existIdSales($id)) {
                $data['msg'] = "notfound";
                echo json_encode($data);
                exit;
            }
    
            if(!$NewDateInverted) {
                $data['msg'] = "somethingIsWrongDanger";
                echo json_encode($data);
                exit;
            }
    
            if(!$price) {
                $data['msg'] = "isNotPrice";
                echo json_encode($data);
                exit;
            }
    
            if(!$commission) {
                $data['msg'] = "isNotCommission";
                echo json_encode($data);
                exit;
            }
    
            
            if($sales->editSale($id, $NewDateInverted, $price, $commission)) {
                $data['msg'] = "success";
            } else {
                $data['msg'] = "somethingIsWrongDanger";
            }
    
            echo json_encode($data);        
        }

    }

    


 

   

}