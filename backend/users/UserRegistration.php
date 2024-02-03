<?php

class UserRegistration {
    private $database;

    public function __construct(DatabaseConnection $database) {
        $this->database = $database;
    }

    public function registerUser(User $user) {
        
        if (!$this->validateUserData($user)) {
            return false;
        }
        
        if ($this->isUserExists($user->getEmail())) {
            return false;
        }

        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);

        $connection = $this->database->getConnection();
        $query = "INSERT INTO users (user_name, user_surname, user_email, user_password) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->execute([$user->getName(), $user->getSurname(), $user->getEmail(), $user->getPassword()]);

        
        return $stmt->rowCount() > 0;
    }

    private function validateUserData(User $user) {
        return !empty($user->getName()) && !empty($user->getSurname()) && !empty($user->getEmail()) && !empty($user->getPassword());
    }

    private function isUserExists($email) {
        $connection = $this->database->getConnection();
        $query = "SELECT COUNT(*) FROM users WHERE user_email = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$email]);

        $count = $stmt->fetchColumn();

        return $count > 0;
    }
    public function checkLoginCredentials(User $user) {
        $email = $user->getEmail();
        $query = "SELECT * FROM users WHERE user_email = :email";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();

        $userData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($userData && password_verify($user->getPassword(), $userData['user_password'])) {
            $user->setUserId($userData['user_id']);
           
            return true; 
        }

        return false;
    }
    public function getUserById($userId) {
        $query = "SELECT * FROM users WHERE user_id = :user_id"; 
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
           
            $user = new User($row['user_name'], $row['user_surname'], $row['user_email'], $row['user_password']);
            $user->setUserId($row['user_id']); 
            return $user;
        } else {
            return null; 
        }
    }
    public function updateUserInfo($userId, $name, $surname, $email, $password) {
        $sql = "UPDATE users SET user_name = :user_name, user_surname = :user_surname, user_email = :user_email";
       
        // $stmt->bindParam(':user_name', $name);
        // $stmt->bindParam(':user_surname', $surname);
        // $stmt->bindParam(':user_email', $email);
        // $stmt->bindParam(':user_password', $password);
        // $stmt->bindParam(':user_id', $userId);
        $params = [
            ':user_name' => $name,
            ':user_surname' => $surname,
            ':user_email' => $email,
            
        ];
        
        
        if (isset($hashedPassword)) {
            $sql .= ", user_password = :user_password"; 
            $params[':user_password'] = $hashedPassword;
        }
        
       
        $sql .= " WHERE user_id = :user_id";
        $params[':user_id'] = $userId;
        
        $stmt = $this->database->getConnection()->prepare($sql);;
        return  $stmt->execute($params);
    }
    
}

?>
