<?php
namespace App\Objet;

class Commentaires
{
    private $erreur = [];
    private $id;  
    private $pseudo;
    private $mail;
    private $contenu;
    private $id_billet;
    private $dateAjout;
    private $signaler;

    const ID_BILLET_INVALIDE = 1;
    const PSEUDO_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;
    const MAIL_INVALIDE = 4;
    const SIGNALER_INVALIDE = 5;

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
    public function isNew()
    {
        return empty($this->id);
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
        if (!is_int($id_billet) || empty($id_billet))
        {
            $this->erreurs[] = self::ID_BILLET_INVALIDE;
        }
        else
        {
            $this->id_billet = (int) $id_billet;
        }          
    } 
    public function setPseudo($pseudo)
    {
        if (!is_string($pseudo) || empty($pseudo))
        {
            $this->erreurs[] = self::PSEUDO_INVALIDE;
        }
        else
        {
            $this->pseudo = $pseudo;
        }
    }
    public function setContenu($contenu)
    {
        if (!is_string($contenu) || empty($contenu))
        {
            $this->erreur[] = self::CONTENU_INVALIDE;
        }
        else
        {
            $this->contenu = $contenu;
        }
    }
    public function setMail($mail)
    {
        if (!is_string($mail) || empty($mail))
        {
            $this->erreurs[] = self::MAIL_INVALIDE;
        }
        else
        {
            $this->mail = $mail;
        }
    }
    public function setDateAjout(DateTime $dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }
   public function setSignaler()
    {
        
            if (!is_string($signaler) || empty($signaler))
            {
                $this->erreurs[] = self::SIGNALER_INVALIDE;
            }
            else
            {
                $this->signaler = $signaler;
            }         
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