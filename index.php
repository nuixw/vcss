<?php
require_once('vcss.php');
$vcss = new Vcss('./style/style.css');
$vcss->Cache(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vcss</title>
        <link rel="stylesheet" href="<?php $vcss->Create();?>">
    </head>

    <body>
        <h1>Les variables pour les nuls !</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate commodi cumque quibusdam error fugiat quos harum! Laboriosam vel, labore esse quibusdam ipsum libero voluptatibus consequuntur error molestiae reiciendis, neque voluptates!</p>
        <button>Mon petit bouton</button>
    </body>

</html> 
