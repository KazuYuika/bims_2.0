<?php

namespace App\Http\Middleware;

class AuthMiddleware
{
    public function handle($next)
    {
        // Check if the user is not logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page
            header('Location: /login');
            exit;
        }

        // If the user is logged in, continue with the request
        return $next();
    }
}
