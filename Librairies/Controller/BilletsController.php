<?php
namespace App\Controller; 
use PDO;
use App\Objet\Billet;
use App\Objet\Connect;
use App\Model\CommentManager;
use App\Model\BilletsManager;

class BilletsController{     
           
              private $mComment;
              private $mBillet;             
       
       public function __construct() {
              $db = Connect::getPDO();
              $this->mComment = new CommentManager($db);
              $this->mBillet = new BilletsManager($db);
       }
              
        //fonction qui affiche les 5 derniers billets
       public function list(){   
              $nbBillets = $this->mBillet->count();           
              $billetsPage = 5;
              $nbPages = ceil($nbBillets/$billetsPage); 
                     if(isset($_GET['page']))  
                     {
                            $pageCourante=(int)($_GET['page']);
                            
                            if($pageCourante>$nbPages)
                            {
                                   $pageCourante=$nbPages;   
                            }
                     }
                     else
                     {
                            $pageCourante = 1;  
                                          
                     }

              $pageEntree = ($pageCourante-1) * $billetsPage;          
              $billetsList = $this->mBillet->getList($pageEntree, $billetsPage);
              
              include("Librairies/View/HomeView.php"); 
       }
       //fonction qui contrôle si $value est un nombre, si il existe dans la bdd, et affiche le billet.        
       public function unique(){  
              $value = $_GET['billetUnique']; 
              $commentList = $this->mComment->getList($value);  
                     if(preg_match("#[0-9]#" , $value))
                     {
                            $billet = $this->mBillet->getUnique($value);

                            if(!empty($billet))                                  
                            {   
                                   include ('Librairies/View/BilletView.php');
                            } 
                            else
                            {
                                   require ('Librairies/View/Erreur404.php');          
                            } 
                     }                                  
                     else
                     {
                            require 'Librairies/View/Erreur404.php';
                     }                                    
       }

       /*fonction qui affiche la liste et le nombre de billets dans la page admistration, 
        *affiche les commentaires signalés */
       public function adminList(){                                             
             $billetCount = $this->mBillet->count();                                             
             $signalList = $this->mComment->getSignalList(); 
             $billetsPage = 10;
             $nbPages = ceil($billetCount/$billetsPage); 

                     if(isset($_GET['pages']))  
                     {
                            $pageCourante = (int)($_GET['pages']);
                            
                            if($pageCourante > $nbPages)
                            {
                                   $pageCourante = $nbPages;   
                            }
                     }
                     else
                     {
                            $pageCourante = 1;  
                                          
                     }                  
              $pageEntree = ($pageCourante-1) * $billetsPage;          
              $billetList = $this->mBillet->getList($pageEntree, $billetsPage);

              include ('Librairies/View/AdminView.php');           
       }
       
       // fonction qui affiche un billet à modifier dans la page administration         
       public function adminChange(){                    
              $value = $_GET['modifierBillet'];                        
                      
                     if(preg_match("#[0-9]#" , $value)) 
                     {                                   
                            $billet = $this->mBillet->getUnique($value);                                                                                            
                            include ('Librairies/View/AdminChange.php'); 
                            $this->adminList();                                                                                                  
                     }
                     else
                     {
                            require 'Librairies/View/Erreur404.php';                                    
                     }                                                               
       } 

       /*fonction qui permet de valider un nouveau billet
        *ou modifier billet existant*/ 
       public function save(){                             
              $billet = new Billet(             
              [         
                     'titre' => $_POST['titre'],
                     'contenu' => $_POST['contenu']                   
              ]    
              );    
                     if(isset($_POST['id']))
                     {
                            $billet->setId($_POST['id']);
                     }   
                     if($billet->isValid())
                     {         
                            $this->mBillet->save($billet);                                                
                     }
                     else
                     {
                            $erreurs = $billet->erreurs();
                            include('Librairies/View/AdminChange.php');
                     } 
                            $this->adminList();
                              
       } 

       //fonction pour supprimer un billet    
       public function delete(){
                     if(isset($_POST["supprimer"]))
                     {
                            $billet = (int) $_POST['id'];                            
                     }
                     else
                     {
                            $billet = (int) $_GET['supprimerBillet'];                            
                     }  
              $this->mBillet->delete($billet);                                                                    
              $this->adminList();  
       }           

}       
       
       
