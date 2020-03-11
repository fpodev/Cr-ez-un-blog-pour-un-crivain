<?php
namespace App\Controller;
use PDO;
use App\Objet\Connect;
use App\Objet\Commentaires;
use App\Model\CommentManager;
use App\Controller\BilletsController;

class CommentController{

        private $mComment;        

    public function __construct() {
        $db = Connect::getPDO();
        $this->mComment = new CommentManager($db);       
    }

    public function save(){           
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
            $this->mComment->save($commentaires) ;                               
          }
          else  
          {
           require 'Librairies/View/Erreur404.php';
          } 

        $billet = $commentaires->id_billet();  
                
        header("Location: index.php?billetUnique=$billet");              
    }

    public function signaler(){       
        $signal = $this->mComment->signaler((int)$_GET['signalComment']);         
        $billet = (int)$_GET['idBillet'];

        header("Location: index.php?billetUnique=$billet");
    } 

    public function validation(){        
        $validation = $this->mComment->validation((int)$_GET['validerComment']); 
        $adminPage= new BilletsController();
        $adminPage->adminList();
    }      

    public function delete(){              
        $this->mComment->delete((int)$_GET['deleteComment']);  
        
        header("Location: index.php?connexion");
    }
 } 
?>  