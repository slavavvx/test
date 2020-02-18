<?php

		class Loader
		{
				private $controllerName;
				private $actionName;
				private $errorPage;

				function __construct(Route $route)
				{
						$this->controllerName = $route->getControllerName();
						$this->actionName = $route->getActionName();
						$this->errorPage = $route->ErrorPage404();
				}

				function startAction()
				{
						// создаем контроллер
						$controller = new $this->controllerName . '()';
						$action = $this->actionName;
						
						if (method_exists($controller, $action)) {
								return $controller->$action();
						}
						else {
								return $this->errorPage;
						}
				}
		}




		// echo "<pre>";
		// var_dump($_SERVER);
		// $routes = explode('/', $_SERVER['REQUEST_URI']);
		// echo "<pre>";
		// var_dump($routes);
?>

