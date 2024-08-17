<?php
class AuthController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userModel->create($username, $password)) {
                echo 'Register Successfully';
            } else {
                echo 'Register Failed';
            }
        } else {
            $includeDirectoryPath = dirname(__DIR__);
            include __DIR__ . "/../../app/views/auth/register.php";
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = $this->userModel->Authentication($username, $password);
            if ($result) {
                echo 'Login Successfully';
                $_SESSION['userId'] = $result;
                setcookie('user', $username, time() + 24 * 3600 * 20, '/');
                header("Location: /data/store");
            } else {
                echo "Invalid credential";
            }
        } else {
            include __DIR__ . "/../../app/views/auth/login.php";
        }
    }

    public function logout()
    {
        session_destroy();
        setcookie("user", "", time() - 24 * 3600, "/");
        header("Location: /../../app/view/auth/login.php");
    }
}
