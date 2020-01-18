<?php  

class BilletsManager
{
   private $db; 

   public function __construct($db)
   {
       $this->setDb($db);
   }
   public function __add(Billets $billets)
   {
    $q = $this->db->prepare('INSERT INTO billets(titre, contenu, dateAjout, dateModif) VALUES (:titre, :contenu, NOW(), NOW())');
    
    $q->bindValue(':titre', $billets->titre());
    $q->bindValue(':contenu', $billets->contenu());
    
    $q->execute();    
    }
    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM billets')->fetchColumn();
    }
    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, titre, contenu, dateAjout, dateModif FROM billets ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $q = $this->db->query($sql);
        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Billets');

        $listeBillets = $q->fetchAll();

        foreach ($listeBillets as $billets)
        {
            $billets->setDateAjout(new DateTime($billets->dateAjout()));
            $billets->setDateModif(new DateTime($billets->dateModif()));
        }
        $q->closeCursor();

        return $listeBillets;
    }
    public function getUnique($id)
    {
        $q = $this->db->prepare('SELECT id, titre, contenu, dateAjout, dateModif FROM billets WHERE id =:id');
        $q->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Billets');

        $billets = $requete->fetch();

        $billets->setDateAjout(new DateTime($billets->dateAjout()));
        $billets->setDateModif(new DateTime($billets->dateModif()));

        return $billets;
    }
    protected function update(Billets $billets)
    {
        $q = $this->db->prepare('UPDATE billets SET titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');

        $q->bindValue(':titre', $billets->titre());
        $q->bindValue(':contenu', $billets->contenu());
        $q->bindValue(':id', $billets->id(), PDO::PARAM_INT);

        $q->execute();
    }
    public function save(Billets $billets)
    {
        if ($billets->isValid())
        {
            $billets->isNew() ? $this->add($billets) : $this->update($billets);
        }
        else
        {
            throw new RuntimeException('Le billet doit être valide pour être enregistré');
        }
    }
}    
?>