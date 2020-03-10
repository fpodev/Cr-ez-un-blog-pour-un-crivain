<?php
namespace App\Model;
use PDO;

class LoginManager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db; 
    }
    public function connexion($identifiant)
    {
        $q = $this->db->prepare('SELECT pass FROM connexion WHERE identifiant = :identifiant');        
       
        $q->bindValue(':identifiant', $identifiant);                

        $q->execute();  
        
        $resultat = $q->fetch();

        $q->closeCursor();

        return $resultat;         
    }    
    public function nouveauPass($identifiant){
        
        $pass_hache = password_hash($_POST['pass2'], PASSWORD_DEFAULT);
         
        $q = $this->db->prepare('UPDATE connexion SET pass = :pass WHERE identifiant = :identifiant');       
        
        $q->bindValue(':pass', $pass_hache);
        $q->bindValue(':identifiant', $identifiant);

        $q->execute();

    }   
}