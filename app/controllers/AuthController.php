
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('UserModel');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login()
    {
        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $users = $this->UserModel->all();

        $user = null;

        foreach ($users as $row) {
            if ($row['username'] === $username) {
                $user = $row;
                break;
            }
        }

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            redirect('/products');
            exit;

        } else {

            $data['error'] = 'Invalid username or password.';
            $this->call->view('auth/login', $data);
        }
    }

    public function logout()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        redirect('/login');
        exit;
    }
}
