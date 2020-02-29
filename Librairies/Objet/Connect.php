<?php
namespace App\Objet;
use PDO;

class Connect
{    
    public static function getPDO() {       
        $db = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8','fpodevovly796', 'PzyfeeaGkbfK5');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
   
       return $db;
    }  
}
?>