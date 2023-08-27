<?php
namespace api\models;

use PDO;

class CollectionModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function findAll()
    {
        $query = "SELECT * FROM collections";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $query = "SELECT * FROM collections WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $description, $targetAmount, $link)
    {
        $query = "INSERT INTO collections (title, description, target_amount, link, created_at)
                  VALUES (:title, :description, :target_amount, :link, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":target_amount", $targetAmount);
        $stmt->bindParam(":link", $link);
        return $stmt->execute();
    }

    public function update($id, $title, $description, $targetAmount, $link)
    {
        $query = "UPDATE collections SET title = :title, description = :description,
                  target_amount = :target_amount, link = :link WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":target_amount", $targetAmount);
        $stmt->bindParam(":link", $link);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM collections WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function getCollectionDetails($collectionId) {
        $query = "SELECT c.title, c.description, c.target_amount, c.link, co.user_name, co.amount FROM collections c LEFT JOIN contributors co ON c.id = co.collection_id WHERE c.id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$collectionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //


    public function getCollectionsWithLessContributions() {
        $query = "SELECT c.id, c.title, c.description, c.target_amount, c.link, 
                         SUM(co.amount) AS contributed_amount 
                  FROM collections c 
                  LEFT JOIN contributors co ON c.id = co.collection_id 
                  GROUP BY c.id 
                  HAVING contributed_amount < c.target_amount";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
