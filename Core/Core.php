<?php
namespace Core;

class Core {

	public function run() {

		$url = '/';
		if(isset($_GET['url'])){
			$url .= $_GET['url'];
		}

		$params = array();
		if(!empty($url) && $url != '/'){

			$url = explode('/',$url);
			array_shift($url);
			
			$currentController = $url[0].'Controller';
			array_shift($url);

			if(isset($url[0]) && !empty($url[0])){
				$currentAction = $url[0];
				array_shift($url);
			}else{
				$currentAction = 'index';
			}

			if(count($url) > 0){
				$params = $url;
			}

		}else{
			$currentController = 'HomeController';
			$currentAction = 'index';
		}

		$currentController = ucfirst($currentController); //Pega a primeira letra e transforma para maiuscula

		$prefix = "\Controllers\\";

		if(!file_exists('Controllers/'.$currentController.'.php')) {
			$currentController = 'NotfoundController';
			$currentAction = 'index';
		}

		$newController = $prefix.$currentController;

		$c = new $newController;

		if(!method_exists($c, $currentAction)) {
			$currentAction = 'index';
		}
		
		call_user_func_array(array($c, $currentAction), $params);
	}
}