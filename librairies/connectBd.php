<?php
class connectionDb
{
    public static function getDb()
    {
        $db = new PDO('mysql:host=localhost;dbname=blog', 'fabrice', 'Frbrl7C90848467');
        $db = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        return $db;
    }  
}
?>