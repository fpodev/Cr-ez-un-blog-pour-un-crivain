<?php
namespace App\Controller;
use PDO;
use App\Objet\Billets;
use App\Objet\Connect;
use App\Model\PublicManager;
use App\Model\BilletsManager;

class AdminController{     
       
       public function list(){       
              $db = Connect::getPDO();            
              $manager = new BilletsManager($db);
              $billetList = $manager->getList(0, 5);                  
              
              chdir('Librairies/View');
              include('HomeView.php'); 
       }
       public function unique(){       
              $db = Connect::getPDO();    
              $manager = new BilletsManager($db);                    
              $billetId = $manager->getUnique((int)$_GET['id']);  
              $managere = new PublicManager($db);                      
              $commentList = $managere->getList((int)$_GET['id']);           

             chdir('Librairies/View');
             include('BilletView.php');                       
       }
       public function adminList(){       
              $db = Connect::getPDO();  
              $manager = new BilletsManager($db);       
              $billetList = $manager->getList();                 
              $billetCount = $manager->count();  

              include('Librairies/View/AdminView.php');                    
       }  
       public function adminChange(){       
              $db = Connect::getPDO();  
              $manager = new BilletsManager($db);       
              $billetUnique = $manager->getUnique((int)$_GET['modifier']);                                                    
              $billetCount = $manager->count();                              
              $billetList = $manager->getList();              
             
              include('Librairies/View/ChangeView.php');                                                                                          
       }
       public function save(){
              $db = Connect::getPDO(); 
              $manager = new BilletsManager($db);
              $billets = new Billets(             
              [         
                     'titre' => $_POST['titre'],
                     'contenu' => $_POST['contenu']
              ]
              );    
                 if(isset($_POST['id']))
                 {
                   $billets->setId($_POST['id']);
                 }      
                 if($billets->isValid())
                 {
                  
                   $manager->save($billets);
           
                   $message = $billets->isNew() ? 'Le billet a bien été ajoutée !' : 'Le billet a bien été modifié !';
                 }
                 else
                 {
                   $erreurs = $billets->erreurs();
              } 
              $billetList = $manager->getList();                      
              include('Librairies/View/AdminView.php'); 
       }

       public function delete(){
              $db = Connect::getPDO();    
              $manager = new BilletsManager($db); 
              $manager->delete((int) $_GET['supprimer']);              
              $billetCount = $manager->count();                              
              $billetList = $manager->getList();                             
              $this->adminList();               
       }
       
}
