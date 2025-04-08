<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\models\Task;
use Formacom\models\Comment;

class ColaboradorController extends Controller {
    // Dashboard del colaborador: muestra tareas asignadas
    public function dashboard() {
        $taskModel = new Task();
        
        // Obtener todas las tareas asignadas al colaborador autenticado
        $tasks = $taskModel->getAssignedTasks($_SESSION['user_id']);
        
        // Cargar la vista del dashboard con las tareas
        $this->view('colaborador/dashboard', ['tasks' => $tasks]);
    }

    // Marcar una tarea como completada
    public function completeTask($data) {
        if (!isset($data['task_id'])) {
            die('ID de tarea no proporcionado.');
        }

        $taskModel = new Task();

        // Actualizar el estado de la tarea a "Completada"
        $taskModel->markAsCompleted($data['task_id'], $_SESSION['user_id']);

        // Redirigir al dashboard
        header('Location: /colaborador/dashboard');
    }

    // Ver detalles de una tarea
    public function taskDetails($taskId) {
        $taskModel = new Task();

        // Obtener los detalles de la tarea
        $task = $taskModel->findById($taskId);

        if (!$task || $task['assigned_user_id'] != $_SESSION['user_id']) {
            die('No tienes permiso para acceder a esta tarea.');
        }

        $commentModel = new Comment();
        
        // Obtener todos los comentarios de la tarea
        $comments = $commentModel->getByTaskId($taskId);

        // Cargar la vista de los detalles de la tarea
        $this->view('colaborador/tasks', [
            'task' => $task,
            'comments' => $comments
        ]);
    }

    // Añadir comentario a una tarea
    public function addComment($data) {
        if (!isset($data['task_id']) || !isset($data['content'])) {
            die('Datos incompletos para añadir comentario.');
        }

        $commentModel = new Comment();

        // Añadir el comentario
        $commentModel->add([
            'task_id' => $data['task_id'],
            'content' => $data['content'],
            'author_id' => $_SESSION['user_id']
        ]);

        // Redirigir a la vista de detalles de la tarea
        header('Location: /colaborador/task/' . $data['task_id']);
    }
}

?> 
