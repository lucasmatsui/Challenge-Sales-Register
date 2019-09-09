<?php
namespace Core;

class Controller{

	protected $db;

	public function __construct() {
		global $db;
		$this->db = $db;
	}

	public function loadView($viewName, $viewData = array()){
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()){
		require 'Views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData = array()){
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}

}