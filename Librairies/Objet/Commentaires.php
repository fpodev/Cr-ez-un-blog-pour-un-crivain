<?php
namespace App\Objet;

class Commentaires
{
    private $id;  
    private $pseudo;
    private $mail;
    private $contenu;
    private $id_billet;
    private $dateAjout; 
    private $signaler;   

    public function __construct($valeurs=[])
    {
        if(!empty($valeurs))
        {
            $this->hydrate($valeurs);   
        }
    }    
    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur):
        
            $methode = 'set'.ucfirst($attribut);

            if (is_callable([$this, $methode]))
            {
                $this->$methode($valeur);
            }
        endforeach;
    }
         
    public function isValid()
    {
        return !(empty($this->id_billet) || empty($this->pseudo) || empty($this->contenu) || empty($this->mail));
    }
    //setters  
    public function setId($id)
    {
        $this->id = (int) $id;
    } 
    public function setId_billet($id_billet)    
    {             
        $this->id_billet = (int) $id_billet;                 
    } 
    public function setPseudo($pseudo)
    {        
        $this->pseudo = $pseudo;        
    }
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;        
    }
    public function setMail($mail)
    {        
        $this->mail = $mail;        
    }
    public function setDateAjout(DateTime $dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }
    public function setSignaler()
    {               
        $this->signaler = $signaler;                     
    }
    //getters
    public function erreurs()
    {
        return $this->erreurs;
    }   
    public function id()
    {
        return $this->id;
    }
    public function id_billet()
    {
        return $this->id_billet; 
    }
    public function pseudo()
    {
        return $this->pseudo;
    }
    public function contenu()
    {
        return $this->contenu;
    }
    public function mail()
    {
        return $this->mail;
    }
    public function dateAjout()
    {
        return $this->dateAjout; 
    }
    public function signaler()
    {
        return $this->signaler;
    }
}
?>