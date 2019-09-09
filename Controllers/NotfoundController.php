<?php
namespace Controllers;

use \Core\Controller;

class NotfoundController extends Controller{

	public function index(){
		$data = array();
		$this->loadView('404', $data);
	}

}