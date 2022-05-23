<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?= form_open();?>

<div>
    <input type="email" name="email">
</div>
<br>


<div>
    <input type="password" name="password">
</div>
<br>
<div>
    <input type="text" name="name">
</div>

<br><br>
<input type="submit">

<?= form_close();?>

</body>
</html>