<?php

class Gestor extends User {
    public function getProjects() {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE manager_id = :manager_id");
        $stmt->bindParam(':manager_id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createProject($title, $description) {
        $stmt = $this->db->prepare("
            INSERT INTO projects (title, description, manager_id, created_at)
            VALUES (:title, :description, :manager_id, NOW())
        ");
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, \PDO::PARAM_STR);
        $stmt->bindParam(':manager_id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function inviteCollaborator($email, $name, $surname, $phone) {
        $stmt = $this->db->prepare("
            INSERT INTO users (email, name, surname, phone, role, password, created_at)
            VALUES (:email, :name, :surname, :phone, 'Colaborador', '', NOW())
        ");
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, \PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, \PDO::PARAM_STR);
        $stmt->execute();
    }
}


?>