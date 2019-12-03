<?php
session_start();

include_once '/var/www/html/TODO-LIST/configs/autoload.php';

use php\dao\UserDao;
use php\model\User;
/**
 * Autenticação do Email
 */
function isEmail($email){

    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }

    return false;
}

/**
 * Carrega o User na Session
 */
function loginAuth()
{

    $userDao = new UserDao();
    $user = null;

    if(isset($_REQUEST["login-btn"]))
    {
        
        if(isEmail($_REQUEST['login']))
        {
            $user = $userDao->getUserByEmail($_REQUEST['login'], $_REQUEST['password']);

            if($user)
            {
                $_SESSION['user'] = serialize($user);
            }
            else
            {
                unset($_SESSION['user']);
            }
        }
        else
        {
            $user = $userDao->getUserByNickname($_REQUEST['login'], $_REQUEST['password']);

            if($user)
            {
                $_SESSION['user'] = serialize($user);
            }
            else
            {
                unset($_SESSION['user']);
            }
        }

        return $user;
    }
    else
    {
        echo "<script type='text/javascript'>";
        echo "location.href='/TODO-LIST/pages/login.php'";
        echo "</script>";
    }
}

function redirectAuth(User $user){
    if(isset($_SESSION['user']) && $user->getId() != null)
    {
        echo "<script type='text/javascript'>";
        echo "location.href='/TODO-LIST/pages/dashboard.php'";
        echo "</script>";
        return true;
    }
    else
    {
        return false;
    }
}

/**
 * Utiliza as funções:
 */
$user = loginAuth();
if(!redirectAuth($user)) echo 'Não existe usuário';

?>