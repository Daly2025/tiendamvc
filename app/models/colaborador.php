<?php

namespace Formacom\models;

class Colaborador extends User {
    public function getAssignedTasks() {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE assigned_user_id = :user_id");
        $stmt->bindParam(':user_id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function markTaskAsCompleted($taskId) {
        $stmt = $this->db->prepare("
            UPDATE tasks SET status = 'Completada' WHERE id = :task_id AND assigned_user_id = :user_id
        ");
        $stmt->bindParam(':task_id', $taskId, \PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addComment($taskId, $content) {
        $stmt = $this->db->prepare("
            INSERT INTO comments (content, task_id, author_id, created_at)
            VALUES (:content, :task_id, :author_id, NOW())
        ");
        $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
        $stmt->bindParam(':task_id', $taskId, \PDO::PARAM_INT);
        $stmt->bindParam(':author_id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
