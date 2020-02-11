<?php
namespace App\Model;
use PDO;
use App\Objet\Commentaires;

class PublicManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function add(Commentaires $commentaires)
    {
        $q = $this->db->prepare('INSERT INTO commentaires (id_billet, pseudo, contenu, mail, dateAjout) VALUES (:id_billet, :pseudo, :contenu, :mail, NOW())');

        $q->bindValue(':id_billet', $commentaires->id_billet());
        $q->bindValue(':pseudo', $commentaires->pseudo());
        $q->bindValue(':contenu', $commentaires->contenu());
        $q->bindValue(':mail', $commentaires->mail());
        
        $q->execute();
    }
 /*  public function count($id_billet)
    {
        return $this->db->query('SELECT COUNT(*) FROM commentaires')->fetchColumn();
    }*/
    public function getList($id)
    {
        $q = $this->db->prepare('SELECT id, id_billet, pseudo, mail, contenu, dateAjout, signaler FROM commentaires WHERE id_billet =:id ORDER BY id DESC');        
              
        $q->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $q->execute();     

        $commentList = $q->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\Objet\Commentaires'); 

        return $commentList; 
    }
    public function getUnique($id)
    {        
        $q = $this->db->prepare('SELECT id, id_billet, pseudo, contenu, dateAjout FROM commentaires WHERE id =:id');

        $q->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $q->execute();      

        $commentaire = $q->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\Objet\Commentaires');         

        return $commentaires;
    }
    public function delete($id)
    {
        $this->db->exec('DELETE FROM commentaires WHERE id='.(int) $id);
    }
    public function signaler($id)
    { 
        $q = $this->db->prepare('UPDATE commentaires SET signaler = :signaler WHERE id='.(int) $id); 
        
        $q->bindValue(':signaler','signaler');
        $q->execute();

    }
    public function save(Commentaires $commentaires)
    {
        if ($commentaires->isValid())
        {
            $commentaires->isNew() ? $this->add($commentaires) : $this->update($commentaires);
        }
        else
        {
            throw new RuntimeException('Votre commentaire doit être valide pour être enregistré');
        }
    }
}
?>