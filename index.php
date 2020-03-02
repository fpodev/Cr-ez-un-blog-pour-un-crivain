<?php
ini_set('display_errors','On');
use App\Controller\BilletsController;
use App\Controller\CommentController; 
use App\Controller\LoginController;
session_start();

require 'vendor/autoload.php'; 

//-------------------partie administration---------------------

    /*commande la connextion à l'espace administration
     *par lien pied de page ou retour à la page administration
     *par le bouton annuler de la page modification*/
    if(isset($_GET['connexion']) || isset($_POST['annuler']))
    { 
      //si une session existe ce connect directement
      if(!empty($_SESSION['admin']) && $_SESSION['admin'] === $_COOKIE)
      {
        $vueAdmin = new Billetscontroller();
        $vueAdmin->adminList();        
      }
      //si session non existante, detruit la session dans le cache et renvoie sur la page pour se connecter
      else{ 
        session_destroy();                 
        include ('Librairies/View/LoginView.php');   
      }
    }
    //commande la connexion à la page administation
    elseif(isset($_POST['connecter']) && $_POST['connecter'] == 'Se connecter')
    {
      $connexion = new LoginController();
      $connexion->connexion();
    }
    //commande la page de changement du mot de passe 
    elseif(isset($_GET['changePass']))
    {
      $connexion = new LoginController();
      $connexion->changePage();
    }
    //commande le changement du mot de passe
    elseif(isset($_POST['changePass']))
    {                
      $connexion = new LoginController();
      $connexion->changePass();
    }
    //commande l'affichage d'un billet à modifier
    elseif(isset($_GET['modifierBillet']))
    {        
      $modif = new Billetscontroller();
      $modif->adminChange();                                        
    }
    //commande la suppression d'un billet 
    elseif(isset($_GET['supprimerBillet']))
    {
      $delete = new Billetscontroller();
      $delete->delete();               
    }
    //commande l'ajout ou la modification d'un billet dans la bdd
    elseif(isset($_POST['postBillet']) || (isset($_POST['postModifier']))) 
    {
      $billetAjout = new Billetscontroller();
      $billetAjout->save();       
    } 
    //commande la validation d'un commentaire par l'administrateur
    elseif(isset($_GET['validerComment']))
    {
      $valider = new CommentController();
      $valider->validation();
    }
    //commande la suppression d'un commentaire par l'administrateur
    elseif(isset($_GET['deleteComment']))
    {
      $delete = new CommentController();
      $delete->delete();
    } 
//------------fin partie administration----------
//------------partie public---------------------- 
    //commmande l'affichage d'un billet
    elseif(isset($_GET['billetUnique']))
    {             
      $billetUnique = new Billetscontroller();
      $billetUnique->unique();                               
    } 
    //commande l'ajout d'un commentaire    
    elseif(isset($_POST['action']) && $_POST['action'] == 'Envoyer') 
    {  
      $commentAjout = new CommentController();       
      $commentAjout->save();  
    } 
    //commande le signalement d'un commentaire
    elseif(isset($_GET['signalComment']) && $_GET['idBillet'])
    {
      $signal = new CommentController();
      $signal->signaler();
    }    
    //commande la pagination
    elseif(isset($_GET['page'])) 
    {
      $page = new Billetscontroller();
      $page->list();
    }
//-----------------------fin partie public---------------------  

    //commande l'affichage de la page d'accueil par défaut
    else 
    {           
      $home = new Billetscontroller();
      $home->list();
  }  
    


