<?php

include_once '/var/www/html/TODO-LIST/configs/autoload.php';

// phpinfo();

error_reporting(E_ALL); 

use php\model\User;
use php\dao\UserDao;

$name = $_REQUEST['_name'];
$lastName = $_REQUEST['_lastName'];
$nickName = $_REQUEST['_nickName'];
$email = $_REQUEST['_email'];
$password = $_REQUEST['_password'];
$sexo = $_REQUEST['sexo'];
$imageProfile = $_REQUEST['image-profile'];

$userDao = new UserDao;
$user = new User;

$user->setName($name);
$user->setLastName($lastName);
$user->setNickname($nickName);
$user->setEmail($email);
$user->setPassword($password);
$user->setSexo($sexo);
$user->setImageProfile($imageProfile);

$userDao->createUser($user);


echo "<script type='text/javascript'>";
// echo "document.alert('Cadastrado com sucesso')";
echo "location.href='/TODO-LIST/pages/login.php'";
echo "</script>";    