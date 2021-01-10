<?
class Router
{

    private $routes;

    public function __construct()
    {

        $path = ROOT . '/config/route.config.php';
        $this->routes = include ($path);

    }

    private function getUri()
    {
        if ($_SERVER['REQUEST_URI'] == '/')
        {
            return '/';
        }

        else if (!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }

    }

    public function get()
    {

        $uri = $this->getUri();

        foreach ($this->routes as $uPattern => $path)
        {

            if (preg_match("~$uPattern~", $uri))
            {

                $internalRoute = preg_replace("~$uPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $paramerts = $segments;

                $actionName = 'action' . ucfirst(array_shift($segments));

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile))
                {
                    include_once $controllerFile;
                }

                $controllerObj = new $controllerName;
                $result = $controllerObj->$actionName($paramerts);

                if ($result != null)
                {
                    break;
                }
            }
        }

    }
}

