<?php 
namespace App\Objet;

class Billet
{
    private $erreurs = [];
    private $id;    
    private $titre;
    private $contenu;
    private $dateAjout;
    private $dateModif; 
   
    const TITRE_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;
    
    public function __construct($valeurs=[])
    {
        if (!empty($valeurs))
        {        
            $this->hydrate($valeurs);
        }
    }    
    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methode = 'set'.ucfirst($attribut);

            if (is_callable([$this, $methode]))
            {
                $this->$methode($valeur);
            }
        }
    }  
    public function isNew()
    {
        return empty($this->id);
    }  
    
    public function isValid()
    {
        return !(empty($this->titre) || empty($this->contenu));
    }   
    //setters
    public function setId($id)
    {
        $this->id = (int) $id;
    }
    public function setTitre($titre)
    {
        if (!is_string($titre) || empty($titre))
        {
            $this->erreurs[] = self::TITRE_INVALIDE;
        }
        else
        {
            $this->titre = $titre;
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
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
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
    public function titre()
    {
        return $this->titre;
    }
    public function contenu()
    {
        return $this->contenu;
    }
    public function dateAjout()
    {
        return $this->dateAjout;
    }
    public function dateModif()    
    {
        return $this->dateModif;
    }   
}    
?>