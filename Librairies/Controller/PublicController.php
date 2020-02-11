<?php
namespace App\Controller;
use PDO;
use App\Objet\Commentaires;
use App\Objet\Connect;
use App\Model\PublicManager;

class PublicController{
    public function save(){
      $db = Connect::getPDO(); 
      $manager = new PublicManager($db);
      $commentaires = new Commentaires(             
      [                          
           'pseudo' => $_POST['pseudo'],
           'mail' => $_POST['mail'],
           'contenu' => $_POST['contenu'],
           'id_billet' => (int)$_POST['id_billet'],           
      ]  
      );     
        if($commentaires->isValid())
        {          
          $manager->save($commentaires);
          
          $message = $commentaires->isNew() ? 'Votre commentaire a bien été ajoutée !': 'blbla';
        }  
        require 'Librairies/View/BilletView.php';                    
     }     
       public function getList(){            
            $db = Connect::getPDO(); 
            $manager = new PublicManager($db);                      
            $commentList = $manager->getList((int)$_GET['id']);            
            require 'Librairies/View/BilletView2.php';          
       }
      public function signaler(){
            $db = Connect::getPDO(); 
            $manager = new PublicManager($db);  
            $signal = $manager->signaler((int)$_GET['signal']);
            var_dump($signal);
       }
  }

  