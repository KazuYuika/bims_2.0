<?php

namespace App\Controllers;



use App\Models\Accounts;

class AuthController
{
    public function showLoginForm()
    {
        // Include the login view file
        require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/auth/login.php';
    }
    public function showSignupFrom()
    {
        // Include the login view file
        require $_SERVER['DOCUMENT_ROOT'] . '/resources/views/auth/signup.php';
    }

    public function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Find the user by username or email
        $user = Accounts::where('username', $username)->orWhere('email', $username)->first();
        // $user = Accounts::where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {
            // Password is correct, log in the user
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['role'] = $user->role;
            $_SESSION['notifications'] = $user->notifications;
            $_SESSION['email_notifications'] = $user->email_notifications;
            $_SESSION['verified'] = $user->verified;
            $_SESSION['image_url'] = $user->image_url;

            $_SESSION['success_message'] = 'You are now logged in';
            header('Location: /dashboard');
            exit;
        } else {
            // Authentication failed
            $_SESSION['error_message'] = 'Invalid credentials';
            header('Location: /login?error=invalid_credentials');
            exit;
        }
    }

    public function signup()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $repassword = $_POST['repassword'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = 'defaulta';

        // check if password are thesame as repassword
        if ($password !== $repassword) {
            // Passwords are not the same, redirect back to the signup form with an error message
            $_SESSION['error_message'] = 'Passwords dont match';
            header('Location: /signup?error=passwords_dont_match');
            exit;
        }

        // Check if the username is already taken
        if (Accounts::where('username', $username)->first()) {
            // Username is already taken, redirect back to the signup form with an error message
            $_SESSION['error_message'] = 'Username taken';
            header('Location: /signup?error=username_taken');
            exit;
        }

        // Check if the email is already taken
        if (Accounts::where('email', $email)->first()) {
            // Email is already taken, redirect back to the signup form with an error message
            $_SESSION['error_message'] = 'Email taken';
            header('Location: /signup?error=email_taken');
            exit;
        }
        if (strlen($password) < 4) {
            // Password is too short, redirect back to the signup form with an error message
            $_SESSION['error_message'] = 'Password too short';
            header('Location: /signup?error=password_too_short');
            exit;
        }
        // Create a new user
        $user = new Accounts;
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->email = $email;
        $user->role = $role;
        $user->permissions = '[]';
        $user->verified = 0;
        $user->image_url = 'bot.png';
        $user->notifications = '[]';
        $user->email_notifications = '[]';
        $user->save();

        $_SESSION['success_message'] = 'You have successfully signed up!';
        // Redirect to the dashboard or home page
        header('Location: /login');
        exit;
    }

    public function logout()
    {
        // Clear the user session
        unset($_SESSION['user_id']);
        session_destroy();
        header('Location: /login');
        exit;
    }

    // Add methods for registration, password reset, etc.
}
