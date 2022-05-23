<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    if(isset($loginButton)):?>
    <a href="<?= $loginButton; ?>"><button>Login With Google</button></a>
    <?php endif;?>
</body>
</html>