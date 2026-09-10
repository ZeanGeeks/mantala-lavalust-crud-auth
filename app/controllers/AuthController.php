
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
        // Already logged in
        if (
            isset($_SESSION['logged_in']) &&
            $_SESSION['logged_in'] === true
        ) {
            redirect('/products');
            exit;
        }

        // Show login page for GET request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->call->view('auth/login');
            return;
        }

        // Login authentication
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $data['error'] = 'Please enter username and password.';
            $this->call->view('auth/login', $data);
            return;
        }

        try {
            $users = $this->UserModel->all();
        } catch (Throwable $exception) {
            $data['error'] = 'Unable to connect to the database. Please try again later.';
            $this->call->view('auth/login', $data);
            return;
        }

        $user = null;

        foreach ($users as $row) {
            if ($row['username'] === $username) {
                $user = $row;
                break;
            }
        }

        // Check username
        if (!$user) {
            $data['error'] = 'Invalid username or password.';
            $this->call->view('auth/login', $data);
            return;
        }

        // Check password
        if (!password_verify($password, $user['password'])) {
            $data['error'] = 'Invalid username or password.';
            $this->call->view('auth/login', $data);
            return;
        }

        // Create session
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Go directly to products
        redirect('/products');
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }

        redirect('/login');
        exit;
    }
}
