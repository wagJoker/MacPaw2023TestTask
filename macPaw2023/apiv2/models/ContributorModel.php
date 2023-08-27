<?php


namespace api\models;


class ContributorModel
{
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function addContribution($collectionId, $userName, $amount) {
        $query = "INSERT INTO contributors (collection_id, user_name, amount) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$collectionId, $userName, $amount]);
    }
}
