<?php

class CommentairesMananager
{
    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function __add(Commentaires $commentaires)
    {
        $q = $this->db->prepare('INSERT INTO commentaires(pseudo, mail, contenu, dateAjout) VALUES (:pseudo, :mail, :contenu, NOW())');

        $q->bindValue(':pseudo', $commentaires->pseudo());
        $q->bindValue(':mail', $commentaires->mail());
        $q->bindValue(':contenu', $commentaires->contenu());

        $q->execute();
    }
    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM commentaires')->fetchColumn();
    }
    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, pseudo, mail, contenu, dateAjout FROM commentaires ORDER BY id DESC';
        
        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $q = $this->db->query($sql);
        $q->setFetchMode(PDO::FETCH_CLASS |PDO::FETCH_PROPS_LATE, 'Commentaires');

        foreach ($listeCommentaires as $commentaires)
        {
            $commentaires->setDateAjout(new DateTime($commentaires->dateAjout()));
        }
        $q->closeCursor();

        return $listeCommentaires;
    }
    public function delete($id)
    {
        $this->db->exec('DELETE FROM commentaires WHERE id='.(int) $id);
    }
    public function save(Commentaires $commentaires)
    {
        if ($commentaires->isValid())
        {
           $this->add($commentaire);  
        }
        else
        {
            throw new RuntimeException('Votre commentaire doit être valide pour être enregistré');
        }
    }
}
?>