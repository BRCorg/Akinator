<?php

function getConnexion():object
{
    $pdo = new PDO('mysql:host=db.3wa.io;port=3306;dbname=berancanguven_akinator;charset=utf8', 'berancanguven', 'ed404198ec927ebf7fad314932c57a62');
    
    return $pdo;
}