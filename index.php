<?


define('ROOT', dirname(__FILE__));

require ROOT.'/components/DB.php';

$obj = new DB();
$obj->mysql_connect();


require ROOT.'/components/Router.php';

$route = new Router();
$route->get();

?>