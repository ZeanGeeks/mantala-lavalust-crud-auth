
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Load database and UserModel
        $this->call->database();
        $this->call->model('UserModel');
    }

    // Show login page
    public function login()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('/products');
            exit;
        }

        $this->call->view('auth/login');
    }

    // Process login
    public function authenticate()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $data['error'] = 'Please enter username and password.';
            $this->call->view('auth/login', $data);
            return;
        }

        // Get users
        $users = $this->UserModel->all();

        $user = null;

        foreach ($users as $row) {
            if ($row['username'] === $username) {
                $user = $row;
                break;
            }
        }

        // Username not found
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

        // Create new session ID
        session_regenerate_id(true);

        // Save login information
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Go to products
        redirect('/products');
        exit;
    }

    // Logout
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        redirect('/login');
        exit;
    }
}
