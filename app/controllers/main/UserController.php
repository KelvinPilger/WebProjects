<?php

namespace App\Controllers\main;

use App\Models\User;
use Core\Controller;
use Exception;

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Origin: *");

class UserController extends Controller
{
    public function login($request): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if ($method === 'GET') {
            $this->renderView('login/userLogin', [
                'style' => [BASE_URL . '/assets/css/userLogin.css']
            ]);
            return;
        }

        if ($method === 'POST') {

            header('Content-Type: application/json; charset=utf-8');

            $data = json_decode(file_get_contents('php://input'), true) ?? [];
            $username = $data['user'] ?? null;
            $password = $data['password'] ?? null;

            if (!$username || !$password) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Usuário e senha são obrigatórios.']);
                return;
            }

            try {
                $userModel = new User();
                $user = $userModel->findUser($username);

                if (!$user) {
                    http_response_code(401);
                    echo json_encode(['status' => 'error', 'message' => 'Credenciais inválidas.']);
                    return;
                }

                if (!password_verify($password, $user['password_hash'])) {
                    http_response_code(401);
                    echo json_encode(['status' => 'error', 'message' => 'Credenciais inválidas.']);
                    return;
                }

                $token = bin2hex(random_bytes(16));
                $userModel->saveToken($user['id'], $token);

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login efetuado com sucesso.',
                    'token' => $token,
                    'user'  => [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'] ?? null
                    ]
                ]);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Erro interno.']);
            }
        }
    }
}