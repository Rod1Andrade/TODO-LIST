<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Criar Conta - Concluir</title>
</head>
<body onload="beLoad()">
    
    <div class="back-page">
        <a href="newAccount.php"><img src="../img/left-arrow.png"></a>
    </div><!--back-page-->
    <div class="container">
        <div class="Panel-criar-second">
            <div id="center-Panel">
                <!-- <h1><?=$_REQUEST['name']?></h1> -->
                <form action="../php/controller/NewAccountController.php" name="concluir" method="POST">
                    <input type="hidden" name="_name" value="<?=$_REQUEST['name']?>">
                    <input type="hidden" name="_lastName" value="<?=$_REQUEST['lastName']?>">
                    <input type="hidden" name="_nickName" value="<?=$_REQUEST['nickName']?>">
                    <input type="hidden" name="_email" value="<?=$_REQUEST['email']?>">
                    <input type="hidden" name="_password" value="<?=$_REQUEST['password']?>">
                    
                    <select name="sexo" class="field-select" id="sex_selector" onchange="sexSelector()">
                        <option value="none">sexo..</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>


                    <div id="render-image">
                        <div id="image-flex-align">
                            <div class="render-image-block" id="M-1">
                                <img src="../img/Users-images/1-M.png" width="100" height="100">
                                    <label><input type="radio" name="image-profile" value="1-M"></label>
                            </div>
                            <div class="render-image-block" id="M-2">
                                <img src="../img/Users-images/2-M.png" width="100" height="100">
                                    <label><input type="radio" name="image-profile" value="2-M"></label>
                            </div>

                            <div class="render-image-block" id="F-1">
                                <img src="../img/Users-images/1-F.png" width="100" height="100">
                                    <label><input type="radio" name="image-profile" value="1-F"></label>
                                </div>
                                <div class="render-image-block" id="F-2">
                                <img src="../img/Users-images/2-F.png" width="100" height="100">
                                    <label><input type="radio" name="image-profile" value="2-F"></label>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Finalizar" name="newAccount-btn" class="Panel-login-btn-cn">
                </form>
            </div><!--center-panel-->
        </div><!--Panel-Criar-conta-->
    </div>

    <script src="../js/createAccountScript.js"></script>
</body>
</html>