<?php
namespace Controllers;

use \Core\Controller;
use \Helpers\RequestHelpers;
use \Models\Sales;


class HomeController extends Controller{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$data = array();

		$sales = new Sales();
		
		$data["getListOfSales"] = $sales->getListOfSales();

		$this->loadTemplate('home', $data);
	}

	public function addSaller() {
		$data = array();

		$resquestHelpers = new RequestHelpers();

		if(!$resquestHelpers->verifyRequestWasPost()) {
			$resquestHelpers->redirectToPage();
		}

		$this->loadView('addNewSeller',  $data);
	}

	public function addSales() {
		$data = array();

		$resquestHelpers = new RequestHelpers();

		if(!$resquestHelpers->verifyRequestWasPost()) {
			$resquestHelpers->redirectToPage();
		}

		$this->loadView('addSales',  $data);
	}

	public function deleteSales($id = NULL) {
		$data = array();

		$resquestHelpers = new RequestHelpers();

		if(!$resquestHelpers->verifyRequestWasPost()) {
			$resquestHelpers->redirectToPage();
			exit;
		}

		if(!isset($id) && empty($id)) {
			$resquestHelpers->redirectToPage();
			exit;
		}

		$data['id'] = $id;

		$this->loadView('deleteSales',  $data);

	}

	public function editSales($id = NULL) {
		$data = array();

		$resquestHelpers = new RequestHelpers();
		$sales = new Sales();

		if(!$resquestHelpers->verifyRequestWasPost()) {
			$resquestHelpers->redirectToPage();
			exit;
		}

		if(!isset($id) && empty($id)) {
			$resquestHelpers->redirectToPage();
			exit;
		}

		$data['infoAboutSale'] = $sales->getInfoAboutSale($id);


		$this->loadView('editSales', $data);
	}

}