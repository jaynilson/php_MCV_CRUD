<?php

session_start();

class DataController
{

    private $userDataModel;

    public function __construct()
    {
        $this->userDataModel = new UserData();
    }

    public function store()
    {
        if (!isset($_SESSION['userId'])) {

            echo "please login firstly";
            include __DIR__ . "/../views/auth/login.php";
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = $_POST['data'];
                $public = isset($_POST['public']) ? $_POST['public'] : "off";
                if ($this->userDataModel->store($_SESSION['userId'], $data, $public)) {
                    echo 'store successfully';
                } else {
                    echo 'store failed';
                }
            } else {
                include __DIR__ . "/../views/data/store.php";

            }
        }
    }

    public function display()
    {
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $result = $this->userDataModel->getData($userId);
        include __DIR__ . '/../views/data/display.php';
    }


}

