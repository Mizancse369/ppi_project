<?php
try{
    $connection=new PdO('mysql:host:localhost;dbname=ecommerce','root','');
}catch (PDOException $e){
    echo 'something went wrong';
}
