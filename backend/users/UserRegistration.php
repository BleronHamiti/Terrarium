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
            $loggedInUser = new User(
                $userData['user_name'],
                $userData['user_surname'],
                $userData['user_email'],
                '', 
                $userData['user_role']
            );
            $loggedInUser->setUserId($userData['user_id']);
            return $loggedInUser; 
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
           
            $user = new User($row['user_name'], $row['user_surname'], $row['user_email'], $row['user_password'],$row['user_role']);
            $user->setUserId($row['user_id']); 
            return $user;
        } else {
            return null; 
        }
    }

    public function updateUser($userId, $name, $surname, $email, $password) {
        $existingUser = $this->getUserById($userId);
        if (!$existingUser) {
            return false;
        }

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashedPassword = $existingUser->getPassword();
        }

        $connection = $this->database->getConnection();
        $query = "UPDATE users SET user_name = ?, user_surname = ?, user_email = ?, user_password = ? WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$name, $surname, $email, $hashedPassword, $userId]);

        return $stmt->rowCount() > 0;
    }
}

?>
