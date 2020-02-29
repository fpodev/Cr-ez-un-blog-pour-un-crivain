<?php
namespace App\Controller;
use PDO;
use App\Objet\Connect;
use App\Model\LoginManager;
use App\Controller\BilletsController;

class LoginController{    

    public function connexion(){                                
            $db = Connect::getPDO(); 
            $manager = new LoginManager($db);
            $resultat = $manager->connexion(($_POST['identifiant']));                                    
            $okPass = password_verify($_POST['pass'], $resultat['pass']);        
                if(!$resultat || !$okPass)       
                {
                    echo 'Mauvais identifiant ou mot de passe';
                    include('Librairies/View/LoginView.php'); 
                }
                else
                {                                                                                                      
                    $_SESSION['identifiant'] = $_POST['identifiant'];
                    $_SESSION['admin'] = $_COOKIE;                 
                    $vueAdmin = new Billetscontroller();
                    $vueAdmin->adminList();                                                                                                                                                                                                        
                }                                                
            }           
    public function ChangePass(){
            $db = Connect::getPDO(); 
            $manager = new LoginManager($db);                              
            $resultat = $manager->connexion($_SESSION["identifiant"]);                                                
            $okPass = password_verify($_POST['pass1'], $resultat['pass']);        
                if(!$resultat || !$okPass)
                {
                    echo 'erreur ancien mot de passe';
                }
                elseif($_POST['pass2'] === $_POST['pass3'])                     
                {               
                    $newPass = $manager->nouveauPass($_SESSION['identifiant']);
                    
                    session_destroy();    
                    include('Librairies/View/LoginView.php'); 
                }
                else
                {
                    echo 'Erreur confimation nouveau mot de pass'; 
                    include('Librairies/View/changePassView.php');
                }
           }
    public function ChangePage(){
                include ("Librairies/View/changePassView.php");
           }
}            