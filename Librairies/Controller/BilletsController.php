<?php
namespace App\Controller; 
use PDO;
use App\Objet\Billet;
use App\Objet\Connect;
use App\Model\CommentManager;
use App\Model\BilletsManager;

class BilletsController{         
              
        //fonction qui affiche les 5 billets et la pagination (page accueil) 
       public function list(){    
              $db = Connect::getPDO();            
              $manager = new BilletsManager($db);
              $nbBillets = $manager->count();
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
                     $pageCourante=1;  
                                    
              }
              $pageEntree= ($pageCourante-1) * $billetsPage;          
              $billetsList = $manager->getList($pageEntree, $billetsPage);
              
              include("Librairies/View/HomeView.php"); 
       }
       //fonction qui contrôle si $value est un nombre, si il existe dans la bdd et affiche le billet.  
       public function unique(){ 
              $db = Connect::getPDO();    
              $manager = new BilletsManager($db); 
              $CommentManager = new CommentManager($db); 
              $value = $_GET['billetUnique'];                     
              $billet = $manager->getUnique($value);                                                       
              $commentList = $CommentManager->getList($value);                             
                     if(preg_match("#[0-9]#" , $value) && !empty($billet))
                     {
                            include('Librairies/View/BilletView.php'); 
                     }
                     else
                     {
                            include('Librairies/View/Erreur404.php');
                     }                      
       }
       /*fonction qui affiche la liste et le nombre de billets dans la page admistration, 
        *affiche les commentaires signalés */
       public function adminList(){
              $db = Connect::getPDO();               
              $manager = new BilletsManager($db);       
              $billetList = $manager->getList();                 
              $billetCount = $manager->count(); 
              
              $CommentManager = new CommentManager($db);                      
              $signalList = $CommentManager->getSignalList(); 

              include('Librairies/View/AdminView.php');                     
       } 
       // fonction qui affiche un billet à modifier dans la page administration         
       public function adminChange(){       
              $db = Connect::getPDO();  
              $manager = new BilletsManager($db);
              $value = $_GET['modifierBillet'];

              if(preg_match("#[0-9]#" , $value))
              {                                   
                     $billet = $manager->getUnique($value);                                                                           
                     $billetCount = $manager->count();                              
                     $billetList = $manager->getList(); 

                     $CommentManager = new CommentManager($db);                      
                     $signalList = $CommentManager->getSignalList(); 
              
                     include('Librairies/View/ChangeBilletView.php');  
              }
              else
              {
                     $this->adminList();      
              }                                                                                        
       } 
       /*fonction qui permet de valider un nouveau billet
        *ou modifier billet existant*/ 
       public function save(){            
              $db = Connect::getPDO(); 
              $manager = new BilletsManager($db);
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
                   $manager->save($billet);
           
                   $billet->isNew();                
                 }
                 else
                 {
                   $erreurs = $billet->erreurs();
              } 
              $this->adminList();
                              
       } 
       //fonction pour supprimer un billet    
       public function delete(){
              $db = Connect::getPDO();    
              $manager = new BilletsManager($db); 
              $manager->delete((int) $_GET['supprimerBillet']);                                                    
              $this->adminList();               
       }           

}       
       
       
