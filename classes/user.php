<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function signup($username, $email, $password, $gender, $height, $weight, $goal) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (username, email, password, gender, height, weight, goal)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$username, $email, $hash, $gender, $height, $weight, $goal]);
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateProfile($id, $username, $email, $gender, $height, $weight, $goal) {
        $stmt = $this->pdo->prepare(
            "UPDATE users SET username=?, email=?, gender=?, height=?, weight=?, goal=? WHERE id=?"
        );
        return $stmt->execute([$username, $email, $gender, $height, $weight, $goal, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
