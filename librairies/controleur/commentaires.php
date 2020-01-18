<?php
//class qui gére les commentaires des visiteurs.
class Commentaires
{
    private $erreur = [];
    private $id;
    private $id_billet;
    private $pseudo;
    private $mail;
    private $contenu;
    private $dateAjout;

//constante pour les erreurs d'éxécution
    const PSEUDO_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;
    const MAIL_INVALID = 3;

    //constructeur pour assigner les données.
    public function __construct($valeurs=[])
    {
        if(!empty($valeurs))
        {
            $this->hydrate($valeurs);   
        }
    }
    //Methode pour assigner les valeurs
    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeurs);
        {
            $methode = 'set'.ucfirst($attribut);

            if (is_callable([$this, $methode]))
            {
                $this->$methode($valeur);
            }
        }
    }
    //methode pour voir si le commentaire est valide
    public function validate()
    {
        return !(empty($this->pseudo) || empty($this->contenu) || empty($this->mail));
    }
    //setters
    public function setId($id)
    {
        $this->id = (int) $id;
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
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
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
    public function pseudo()
    {
        return $this->pseudo = $pseudo;
    }
    public function contenu()
    {
        $this->contenu = $contenu;
    }
    public function dateAjout()
    {
        $this->dateAjout = $dateAjout;
    }
}
?>