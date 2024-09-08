<?php

namespace App;
use PDO;
class Branch
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo= (new DB)->connect();
    }

    public function createBranch(string $name, string $address)
    {
        $query="INSERT INTO branch (name, address) VALUES (:name, :address)";
        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':address', $address);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getBranch(int $id)
    {
        $query="SELECT * FROM branches WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBranch(int $id, string $name, string $address)
    {
        $query = "UPDATE branch SET name = :name, address = :address, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->execute();
    }
    public function deleteBranch(int $id)
    {
        $query = "DELETE FROM branch WHERE id = :id";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();   
    }
}