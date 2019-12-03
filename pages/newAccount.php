<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Criar Conta</title>
</head>
<body>
    
    <div class="back-page">
        <a href="login.php"><img src="../img/left-arrow.png"></a>
    </div><!--back-page-->
    <div class="container">
        <div class="Panel-criar">
            <div class="Panel-criar-left">
                <div class="Panel-criar-title"><p>Nova Conta</p></div><!--Panel-criar-title-->
                <div class="Panel-criar-text">
                    <p>
                        Todo-List é uma ferramenta para você manter suas
                        tarefas organizadas, todas em um só lugar. Não perca
                        tempo, crie sua conta e faça parte do universo produtivo.
                    </p>
                </div><!--Panel-criar-texto-->
                <div class="Panel-criar-form">
                    <form action="newAccount-part2.php" method="POST" name="Panel-criar-form">
                        <input type="text" name="name" class="Panel-criar-field" placeholder="Primeiro Nome">
                        <input type="text" name="lastName" class="Panel-criar-field" placeholder="Último Nome">
                        <input type="text" name="nickName" class="Panel-criar-field" placeholder="Nickname">
                        <input type="mail" name="email" class="Panel-criar-field" placeholder="Email">
                        <input type="password" name="password" class="Panel-criar-field" placeholder="Senha">
                        <input type="submit" value="Criar Conta" name="newAccount-btn" class="Panel-login-btn-cn">
                    </form>
                </div><!--Panel-criar-form-->
            </div><!--Panel-criar-left-->

            <div class="Panel-criar-right">
                <div class="panel-criar-right-image"></div>
            </div><!--Panel-criar-right-->
        </div><!--Panel-Criar-conta-->
    </div>

    <script src="../js/createAccountScript.js"></script>
</body>
</html>