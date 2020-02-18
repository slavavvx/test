<?php

		class Route
		{
				const DEFAULT_CONTROLLER_NAME = 'Base';
				const DEFAULT_ACTION_NAME = 'indexAction';
				const ACTION = 'Action';
				const CONTROLLER = 'Controller';
				const CONTROLLER_PATH = '../controllers/';
				const FILE_EXTENSION = '.php';

				function getRoute()
				{
						return explode('/', $_SERVER['REQUEST_URI']);
				}

				function getControllerName()
				{
						$routes = $this->getRoute();
						$cotrollerName = (!empty($routes[1])) ? ucfirst($routes[1]) : self::DEFAULT_CONTROLLER_NAME;

						return (string) $cotrollerName . self::CONTROLLER;  
				}

				function getControllerPath()
				{
						$controllerFile = $this->getControllerName() . self::FILE_EXTENSION;
						$controllerPath = self::CONTROLLER_PATH . $controllerFile;

						if (file_exists($controllerPath)) {
								return $controllerPath;
						}
						else {
								return $this->ErrorPage404();
						}
				}

				function getActionName()
				{
						$routes = $this->getRoute();
						$actionName = (!empty($routes[2])) ? $routes[2] . self::ACTION : self::DEFAULT_ACTION_NAME;
						
						return (string) $actionName;
				}

				function startAction()
				{
						$controllerName = $this->getControllerName();
						$controller = new $controllerName;
						$action = $this->getActionName();
						
						if (method_exists($controller, $action)) {
								return $controller->$action();
						}
						else {
								return $this->ErrorPage404();
						}
				}

				function ErrorPage404()
				{
						$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		        header('HTTP/1.1 404 Not Found');
						header("Status: 404 Not Found");
						header('Location:' . $host . '404');
				}
		}
		
?>

