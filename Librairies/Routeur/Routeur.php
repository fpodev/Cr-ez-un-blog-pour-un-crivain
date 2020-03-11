<?php
use App\Controller\BilletsController;
use App\Controller\CommentController; 
use App\Controller\LoginController;
session_start();

require 'vendor/autoload.php'; 

Class Routeur{

      private $ctrlBillet;
      private $ctrlLogin;
      private $ctrComment;

    public function __construct(){
      $this->ctrlBillet = new BilletsController();
      $this->ctrlLogin = new LoginController();
      $this->ctrlComment = new CommentController();
}

    public function router(){
        //-------------------partie administration---------------------

            /*commande la connextion à l'espace administration
            *par lien pied de page ou retour à la page administration
            *par le bouton annuler de la page modification et permet la pagination*/
            if(isset($_GET['connexion']) || isset($_POST['annuler']) || isset($_GET['pages']))
            { 
              //si une session existe ce connect directement
              if(!empty($_SESSION['admin']) && $_SESSION['admin'] === $_COOKIE)
              {
                $this->ctrlBillet->adminList();                                    
              }
              //si session non existante, detruit la session dans le cache et renvoie sur la page pour se connecter
              else{ 
                session_destroy();                 
                include ('Librairies/View/LoginView.php');   
              }
            }           
            //commande la connexion à la page administation
            elseif(isset($_POST['connexion']))
            {
              $this->ctrlLogin->connexion();              
            }
            //commande la page de changement du mot de passe 
            elseif(isset($_GET['changePass']))
            {
              include ("Librairies/View/changePassView.php");
            }
            //commande le changement du mot de passe
            elseif(isset($_POST['changePass']))
            {   
              $this->ctrlLogin->changePass();                       
            }
            //commande l'affichage d'un billet à modifier
            elseif(isset($_GET['modifierBillet']))
            {     
              $this->ctrlBillet->adminChange();                                                                      
            }
            //commande la suppression d'un billet 
            elseif(isset($_GET['supprimerBillet']) || isset($_POST['supprimer']))
            {
              $this->ctrlBillet->delete();                          
            }
            //commande l'ajout ou la modification d'un billet dans la bdd
            elseif(isset($_POST['postBillet']) || (isset($_POST['postModifier']))) 
            {
              $this->ctrlBillet->save();                    
            } 
            //commande la validation d'un commentaire par l'administrateur
            elseif(isset($_GET['validerComment']))
            {
              $this->ctrlComment->validation();             
            }
            //commande la suppression d'un commentaire par l'administrateur
            elseif(isset($_GET['deleteComment']))
            {
              $this->ctrlComment->delete();              
            } 
        //------------fin partie administration----------
        //------------partie public---------------------- 
            //commmande l'affichage d'un billet
            elseif(isset($_GET['billetUnique']))
            {      
              $this->ctrlBillet->unique();                                                   
            } 
            //commande l'ajout d'un commentaire    
            elseif(isset($_POST['envoyer']))
            {  
              $this->ctrlComment->save();               
            } 
            //commande le signalement d'un commentaire
            elseif(isset($_GET['signalComment']) && $_GET['idBillet'])
            {
              $this->ctrlComment->signaler();              
            }    
            //commande la pagination
            elseif(isset($_GET['page'])) 
            {
              $this->ctrlBillet->list();              
            }         
            //commande l'affichage de la page d'accueil par défaut
            else 
            {           
              $this->ctrlBillet->list();
          }  
        
        }
    }


