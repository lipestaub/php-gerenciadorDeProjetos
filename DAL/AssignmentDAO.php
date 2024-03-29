<?php 
    require_once __DIR__ . '/../config/Connect.php';
    class AssignmentDAO
    {

        private $db;

        public function __construct()
        {
            $this->db = Connection::getConnection();
        }

        public function createAssignment(Assignment $assignment)
        {
            $query = 'INSERT INTO assignment (user_id, task_id) VALUES (:user_id, :task_id);';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':user_id', $assignment->getUserId());
            $stmt->bindValue(':task_id', $assignment->getTaskId());
            $stmt->execute();
        }

        public function getAssignmentsByUserId(int $userId)
        {
            $query = 'SELECT * FROM assignment WHERE user_id = :user_id;';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        }

        public function getAssignmentsByTaskId(int $taskId)
        {
            $query = 'SELECT * FROM assignment WHERE task_id = :task_id;';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":task_id", $taskId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        }

        public function getAssignmentByTaskIdAndUserId(int $taskId, int $userId)
        {
            $query = 'SELECT * FROM assignment WHERE task_id = :task_id AND user_id = :user_id;';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":task_id", $taskId);
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll()[0];
        }

        public function getAssignmentById(int $assignmentId)
        {
            $query = 'SELECT * FROM assignment WHERE id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id", $assignmentId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll()[0];
        }
    }
?>