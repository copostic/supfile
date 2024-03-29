<?php

use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

$view = $page ?? 'login';
$result = ['success' => 'unknown', 'message' => 'result not modified'];

if (!empty($page)) {
    if ($page == 'social') {
        try {
            $hybridauth = new Hybridauth($config);

            $storage = new Session();

            if (isset($_GET['provider'])) {
                $storage->set('provider', $_GET['provider']);
            }

            if ($provider = $storage->get('provider')) {
                $hybridauth->disconnectAllAdapters();
                $adapter = $hybridauth->authenticate($provider);
                $storage->set('provider', null);
                if ($adapter->isConnected()) {
                    $profile = $adapter->getUserProfile();
                    $userExist = $user->checkIfExists($profile->email);
                    if ($userExist) {
                        $result = $user->getByEmail($profile->email);
                    } else {
                        $result = $user->createOnDB($profile->email, $profile->firstName, $profile->lastName);
                    }
                    $_SESSION['connected'] = true;
                    $_SESSION['email'] = $profile->email;
                    $_SESSION['first_name'] = $result['first_name'] ?? $profile->firstName ?? 'John';
                    $_SESSION['last_name'] = $result['last_name'] ?? $profile->lastName ?? 'John';
                    $_SESSION['uuid'] = $result['uuid'];

                }
            }

            if (isset($_GET['logout'])) {
                $adapter = $hybridauth->getAdapter($_GET['logout']);
                $adapter->disconnect();
                $hybridauth->disconnectAllAdapters();
            }
            HttpClient\Util::redirect('/explorer');
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    } elseif ($page == 'login') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {
            $result = $user->localLogin($_POST['email'], $_POST['password']);
        }

    } elseif ($page == 'register') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_verify']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_verify = $_POST['password_verify'];
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $result = $user->localRegister($email, $password, $password_verify, $firstName, $lastName);

        } else {
            $result = ['success' => 'false', 'message' => 'You must fill all the fields'];
        }
    } elseif ($page == 'logout') {
        $hybridauth = new Hybridauth($config);
        $hybridauth->disconnectAllAdapters();
        unset($_SESSION);
        session_destroy();
        header('Location: /explorer');
    }
} else {
    header('Location: /auth/login');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $view !== 'logout') {
    $smarty->display(VIEWS . 'inc/header.tpl');
    $smarty->display(VIEWS . 'account/' . $view . '.tpl');
    $smarty->display(VIEWS . 'inc/footer.tpl');
} else {
    $smarty->assign('result', json_encode($result));
    echo json_encode($result);
}