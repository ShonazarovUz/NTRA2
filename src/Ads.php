<?php

namespace App;

use DateTime;
use PDO;

class Ads
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new DB)->connect();
    }

    public function createAds(string $title, string $description, int $user_id, int $status_id, int $branch_id, string $address, int $price, int $rooms )
    {
        $query = "INSERT INTO ads (title, description, user_id, status_id, branch_id, address, price, rooms, created_at) 
        VALUES (:title, :description, :user_id, :status_id, :branch_id, :address, :price, :rooms, NOW())";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':branch_id', $branch_id);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':rooms', $rooms);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        public function getAd(int $id)
        {
            $query = "SELECT * FROM ads WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getAds()
        {
            $query = "SELECT *, ads.address AS address FROM ads JOIN branch ON branch.id = ads.branch_id";
            return $this->pdo->query($query)->fetchAll();
        }
    public function updateAds(
        int    $id,
        string $title,
        string $description,
        int    $user_id,
        int    $status_id,
        int    $branch_id,
        string $address,
        float  $price,
        int    $rooms
    ) {
        $query = "UPDATE ads SET title = :title, description = :description, user_id = :user_id,
                 status_id = :status_id, branch_id = :branch_id, address = :address, 
                 price = :price, rooms = :rooms, updated_at = NOW() WHERE id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':branch_id', $branch_id);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':rooms', $rooms);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        public function deleteAds(int $id)
        {
            $query = "DELETE FROM ads WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

}