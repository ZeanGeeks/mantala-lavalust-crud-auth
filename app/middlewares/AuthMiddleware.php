
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (
            !isset($_SESSION['logged_in']) ||
            $_SESSION['logged_in'] !== true
        ) {
            redirect('/login');
            exit;
        }

        return $next();
    }
}
