<?php
namespace App\Model;
use PDO;
use App\Objet\Commentaires;

class CommentManager
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function add(Commentaires $commentaires)
    {             
        $q = $this->db->prepare('INSERT INTO commentaires(id_billet, pseudo, contenu, mail, dateAjout, signaler) VALUES (:id_billet, :pseudo, :contenu, :mail, NOW(), :signaler)');

        $q->bindValue(':id_billet', $commentaires->id_billet()); 
        $q->bindValue(':pseudo', $commentaires->pseudo());
        $q->bindValue(':contenu', $commentaires->contenu());
        $q->bindValue(':mail', $commentaires->mail());
        $q->bindValue(':signaler', "");
      
        $q->execute();                       
    }    
    public function getList($id)
    {
        $q = $this->db->prepare('SELECT id, id_billet, pseudo, mail, contenu, dateAjout, signaler FROM commentaires WHERE id_billet =:id ORDER BY id DESC');        
              
        $q->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $q->execute();     

        $commentList = $q->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\Objet\Commentaires'); 

        return $commentList; 
    }      
    public function signaler($id)
    { 
        $q = $this->db->prepare('UPDATE commentaires SET signaler = :signaler WHERE id='.(int) $id); 
        
        $q->bindValue(':signaler','signaler');

        $q->execute();
    }
    public function getSignalList()
    {
        $q = $this->db->prepare('SELECT id, id_billet, pseudo, mail, contenu, dateAjout, signaler FROM commentaires WHERE signaler =:signaler ORDER BY id DESC');        
       
        $q->bindValue(':signaler','signaler');                   
        $q->execute();     

        $signalList = $q->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\Objet\Commentaires'); 

        return $signalList; 
    }
    public function validation($id)
    {
        $q = $this->db->prepare('UPDATE commentaires SET signaler = :signaler WHERE id='.(int) $id); 
        
        $q->bindValue(':signaler','');
        $q->execute();
    }
    public function delete($id)
    {
        $this->db->exec('DELETE FROM commentaires WHERE id='.(int) $id);
    }
    public function save(Commentaires $commentaires)
    {  
        if ($commentaires->isValid())
        {
            $this->add($commentaires);
        }
        else
        {
            throw new RuntimeException('Votre commentaire doit être valide pour être enregistré');
        }        
    }
}
?>