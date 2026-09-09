<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('UserModel');
    }

    public function login()
    {
        if (
            isset($_SESSION['logged_in']) &&
            $_SESSION['logged_in'] === true
        ) {
            redirect('/products');
            exit;
        }

        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $data['error'] = 'Please enter username and password.';
            $this->call->view('auth/login', $data);
            return;
        }

        $users = $this->UserModel->all();
        $user = null;

        foreach ($users as $row) {
            if ($row['username'] === $username) {
                $user = $row;
                break;
            }
        }

        if (!$user) {
            $data['error'] = 'Invalid username or password.';
            $this->call->view('auth/login', $data);
            return;
        }

        if (!password_verify($password, $user['password'])) {
            $data['error'] = 'Invalid username or password.';
            $this->call->view('auth/login', $data);
            return;
        }

        // Session is automatically started by PHP
        session_regenerate_id(true);

        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        redirect('/products');
        exit;
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