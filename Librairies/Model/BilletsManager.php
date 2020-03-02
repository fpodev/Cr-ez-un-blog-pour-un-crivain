<?php  
namespace App\Model;
use PDO;
use App\Objet\Billet;

class BilletsManager 
{
    private $db;

    public function __construct(PDO $db)
    {
       $this->db = $db;
    }
    public function add(Billet $billet)
    {
    $q = $this->db->prepare('INSERT INTO billets(titre, contenu, dateAjout, dateModif) VALUES(:titre, :contenu, NOW(), NOW())');
    
    $q->bindValue(':titre', $billet->titre());
    $q->bindValue(':contenu', $billet->contenu());
    
    $q->execute();    
    }
    public function delete($id)
    {
    $this->db->exec('DELETE FROM billets WHERE id = '.(int) $id);
    }
    public function count()
    {     
        return $this->db->query('SELECT COUNT(*) FROM billets')->fetchColumn();                         
    }
    public function getList($debut =-1 , $limite =-1)
    {      
        $sql = 'SELECT id, titre, contenu, dateAjout, dateModif FROM billets ORDER BY id DESC';
       
       if ($debut != -1 || $limite != -1)
       {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
       }
        $q = $this->db->query($sql);               
        
        $billetsList = $q->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\Objet\Billet');          
        
        $q->closeCursor(); 
        
        return $billetsList;                 
    }
    public function getUnique($id)
    {        
        $q = $this->db->prepare('SELECT id, titre, contenu, dateAjout, dateModif FROM billets WHERE id =:id');

        $q->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $q->execute();   
        
        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\Objet\Billet');

        $billet = $q->fetch();         

        return $billet;
    }
    protected function update(Billet $billet)
    {
        $q = $this->db->prepare('UPDATE billets SET titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

        $q->bindValue(':titre', $billet->titre());
        $q->bindValue(':contenu', $billet->contenu());
        $q->bindValue(':id', $billet->id(), PDO::PARAM_INT);

        $q->execute();
    }
    public function save(Billet $billet)
    {
        if ($billet->isValid())
        {   
            $billet->isNew() ? $this->add($billet) : $this->update($billet);
        }
        else
        {
            throw new RuntimeException('Le billet doit être valide pour être enregistré');
        }
    }   
}    
?>