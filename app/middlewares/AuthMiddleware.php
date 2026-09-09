<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        echo "<pre>";
        echo "AUTH MIDDLEWARE REACHED\n";
        echo "Session logged_in: ";
        var_dump($_SESSION['logged_in'] ?? null);
        echo "</pre>";

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