<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>TODO-LIST - Login</title>
</head>
<body>
    <div class="container">
        <div class="item">
            <div class="Panel-login">
                <div class="Panel-title-image"></div><!--Panel-title-image-->
                <div class="Panel-form">
                    <form action="../php/controller/AuthenticatController.php" method="POST" name="Panel-login-form">
                        <input type="text" name="login" class="Panel-login-field" placeholder="E-mail ou Nickname" required="required">
                        <input type="password" name="password" class="Panel-login-field" placeholder="Senha" required="required">
                        <input type="submit" value="Login" name="login-btn" class="Panel-login-btn-lgn">
                        <button class="Panel-login-btn-cn"><a href="newAccount.php">Criar Conta</a></button>
                        <!--<input type="submit" value="Criar Conta" name="newAccount-btn" class="Panel-login-btn-cn">-->
                    </form>
                </div><!--Panel-form-->
            </div><!--Panel-Login-->
        </div>
    </div>
</body>
</html>