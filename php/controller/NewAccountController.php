<?php

include_once '../database/Connection.php';
include_once '../model/User.php';
include_once '../dao/UserDao.php';

$name = $_REQUEST['_name'];
$nickName = $_REQUEST['_nickName'];
$email = $_REQUEST['_email'];
$password = $_REQUEST['_password'];
$sexo = $_REQUEST['sexo'];
$imageProfile = $_REQUEST['image-profile'];


echo $name.'<br />';
echo $nickName.'<br />';
echo $email.'<br />';
echo $password.'<br />';
echo $imageProfile.'<br />';

$user = new User;
$user->setName($name);
$user->setNickname($nickName);
$user->setEmail($email);
$user->setPassword($password);
$user->setSexo($sexo);
$user->setImageProfile($imageProfile);

$userDao = new UserDao;

// var_dump($user);

$userDao->createUser($user);

echo "<script type='text/javascript'>";
// echo "document.alert('Cadastrado com sucesso')";
echo "location.href='/TODO-LIST/pages/login.php'";
echo "</script>";    