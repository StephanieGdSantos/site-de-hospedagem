<?php
    require_once('../model/classes/dataBase.php');

    $conn = DataBase::getConnection();
    $return = array();

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    $uriSegments = explode('/', parse_url($uri, PHP_URL_PATH));


    if ($requestMethod === 'POST')
    {
        if ($_POST['action'] === 'login')
        {
            include('../controller/userController.php');
            $UserController = new UserController();
            $UserController->Login($_POST['userType'], $_POST['email'], $_POST['password']);
        }
        else if ($_POST['action'] === 'register')
        {
            include('../controller/userController.php');
            $UserController = new UserController();
            $UserController->Register($_POST['cpf'], $_POST['name'], $_POST['cep'], $_POST['birth'],
            $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['userType']);
        }
        else if ($_POST['action' === 'edit-register'])
        {
            include('../controller/userController.php');
            $UserController = new UserController();
            $UserController->EditData($_POST['name'], $_POST['cpf'], $_POST['cep'], $_POST['phone'],
            $_POST['email'], $_POST['password'], $_POST['userType']);
        }
        else if ($_POST['action' === 'edit-house'])
        {

        }
    }

    // if ($uriSegments[4] === 'guest')
    // {
    //     $query = 'SELECT * FROM guest';

    //     $consult = $conn->prepare($query);
    //     $consult->execute();

    //     while ($data = $consult->fetch(PDO::FETCH_ASSOC))
    //     {
    //         $return[] = array(
    //             "birth" => $data['birth'],
    //             "cep" => $data['cep'],
    //             "cpf" => $data['cpf'],
    //             "email" => $data['email'],
    //             "name" => $data['name'],
    //             "password" => $data['password'],
    //             "phone" => $data['phone']
    //         );
    //     }
    // }
    $novoJSON = json_encode($return, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $novoJSON);
?>