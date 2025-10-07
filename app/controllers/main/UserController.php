<?php 

namespace App\Controllers\main;

use app\Models\User;
use core\Controller;
use Error;
use Throwable;

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST');

class UserController extends Controller {
    public function login($request): void {
        $username = isset($_GET['username']) ? $_GET['username'] : null;
        $password = isset($_GET['password']) ? $_GET['password'] : null;
    }
}

?>