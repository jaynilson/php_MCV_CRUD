<?php


class UserData
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function store($userId, $data, $public)
    {
        try {
            $sql = "INSERT INTO userData (userId, data, public) VAlUE (:userId, :data, :public)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":data", $data);
            $stmt->bindParam(":public", $public);
            $stmt->execute();
            echo "store successful";
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function getData()
    {
        $userId = $_SESSION['userId'];
        $sql = "SELECT data FROM userData WHERE public = true OR (userId = :userId AND public = false)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $data;
    }
}

