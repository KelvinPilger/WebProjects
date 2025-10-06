<?php 

namespace App\Controllers\main;

use app\models\Json;
use Core\Controller;
use Error;
use Throwable;

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Origin: *");

class JsonController extends Controller
{

    public function index($request): void
    {
        $table = isset($request->parameter)
            ? $request->parameter
            : null;

        $username = isset($_GET['username']) ? $_GET['username'] : null;
        $token    = isset($_GET['token']) ? $_GET['token'] : null;

        $jsonModel = new Json();

        $json = $jsonModel->disposeJson($table, $username, $token);
    }
}

?>