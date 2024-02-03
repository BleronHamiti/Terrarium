<?php

class UserManagement {
    private $database;

    public function __construct(DatabaseConnection $database) {
        $this->database = $database;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $statement->execute();
    }

    public function getUserById($userId) {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $name, $surname, $email, $role) {
        $query = "UPDATE users SET user_name = :name, user_surname = :surname, user_email = :email, user_role = :role WHERE user_id = :user_id";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':surname', $surname);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':role', $role);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $statement->execute();
    }

    private function getUserIdByEmail($email) {
        $query = "SELECT user_id FROM users WHERE user_email = :email";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['user_id'];
        }
        return false;
    }
}

?>

