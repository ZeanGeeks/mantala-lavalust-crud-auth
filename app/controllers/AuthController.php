
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Start session only if it has not started
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }

        // Load database and model
        $this->call->database();
        $this->call->model('UserModel');
    }

    public function login()
    {
        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        echo "<pre>";
        echo "STEP 1: Login request received\n";
        echo "Username: " . htmlspecialchars($username) . "\n";

        $users = $this->UserModel->all();

        echo "STEP 2: Users loaded\n";
        echo "Number of users: " . count($users) . "\n";

        $user = null;

        foreach ($users as $row) {
            if ($row['username'] === $username) {
                $user = $row;
                break;
            }
        }

        echo "STEP 3: User search completed\n";

        if ($user) {
            echo "User found: YES\n";
            echo "Password verification: ";

            if (password_verify($password, $user['password'])) {
                echo "SUCCESS\n";

                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo "STEP 4: Session created\n";
                echo "STEP 5: Redirecting to /products...\n";

                redirect('/products');
                exit;
            } else {
                echo "FAILED\n";
                echo "Password does not match.\n";
            }
        } else {
            echo "User found: NO\n";
            echo "Username does not exist.\n";
        }

        echo "</pre>";
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
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

        session_destroy();

        redirect('/login');
        exit;
    }
}
