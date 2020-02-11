<?php
use App\Objet\Billets;
use App\Controller\AdminController;
use App\Controller\PublicController;
require 'vendor/autoload.php'; 
        
    if(isset($_GET['action']) && $_GET['action'] == 'admin') {
        $admin = new AdminController;
        $admin->adminList();               
    }
    elseif(isset($_GET['id'])){             
       $billetUnique = new AdminController();
       $billetUnique->unique();                               
    } 
    elseif(isset($_GET['modifier'])){        
      $modif = new AdminController();
      $modif->adminChange();                                        
      } 
      elseif(isset($_GET['supprimer']))
      {
        $delete = new AdminController();
        $delete->delete();               
      } 
     elseif(isset($_POST['titre']))
     {
      $billetAjout = new AdminController();
      $billetAjout->save();       
    }         
     elseif(isset($_POST['action']) && $_POST['action'] =='Envoyer')  
     {  
        $commentAjout = new PublicController();       
        $commentAjout->save();  
      } 
     elseif(isset($_GET['signal']))
      { var_dump($_GET['signal']);
        $signal = new PublicController();
        $signal->signaler();
      }
     else {
        $home = new AdminController();
        $home->list();
           
  }  
    


