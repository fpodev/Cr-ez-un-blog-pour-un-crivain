<?php
namespace App\Controller;
use PDO;
use App\Objet\Connect;
use App\Objet\Commentaires;
use App\Model\CommentManager;
use App\Controller\BilletsController;

class CommentController{

    public function save(){    
        $db = Connect::getPDO(); 
        $manager = new CommentManager($db);
        $commentaires = new Commentaires(             
        [                          
            'pseudo' => $_POST['pseudo'],
            'mail' => $_POST['mail'],
            'contenu' => $_POST['contenu'],
            'id_billet' => (int)$_POST['id_billet']           
        ]
        );                         
          if($commentaires->isValid())
          {     
            $manager->save($commentaires) ;                               
          }
          else  
          {
            $erreurs = $commentaires->erreurs();
          }              
        $billet = $commentaires->id_billet();   
        
        header("Location: index.php?billetUnique=$billet");              
    }

    public function signaler(){
        $db = Connect::getPDO(); 
        $manager = new CommentManager($db);  
        $signal = $manager->signaler((int)$_GET['signalComment']);         
        $billet = (int)$_GET['idBillet'];

        header("Location: index.php?billetUnique=$billet");
    } 

    public function validation(){
        $db = Connect::getPDO();
        $manager = new CommentManager($db);
        $validation = $manager->validation((int)$_GET['validerComment']); 
        $adminPage= new BilletsController();
        $adminPage->adminList();

    }      
    public function delete(){

        $db = Connect::getPDO();
        $manager = new CommentManager($db);

        $delete = $manager->delete((int)$_GET['deleteComment']);  
        
        header("Location: index.php?connexion");
    }
 } 
?>  