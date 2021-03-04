<?php

    namespace MVC\Controllers;

    use MVC\Models\Task;
    use MVC\Core\Controller;
    use MVC\Models\TaskRepository;

    class TasksController extends Controller
    {
        private $taskRepo;

        public function __construct()
        {
            $this->taskRepo = new TaskRepository();
        }

        public function index()
        {
            $tasks = new Task();
            $d['tasks'] = $this->taskRepo->getAll($tasks);
            $this->set($d);
            $this->render("index");
        }

        public function create()
        {
            extract($_POST);

            if (isset($title) && !empty($title) && isset($description) && !empty($description)) {

                $task = new Task();
                $task->title = $title;
                $task->description = $description;

                if ($this->taskRepo->add($task)) {
                    header("Location: " . WEBROOT . "tasks/index");
                }
            }

            $this->render("create");
        }

        public function edit($id)
        {
            $task = new Task();
            extract($_POST);

            $d['task'] = $this->taskRepo->get($id);
            if (isset($title)) {

                $task->id = $id;
                $task->title = $title;
                $task->description = $description;

                if ($this->taskRepo->update($task)) {
                    header("Location: " . WEBROOT . "tasks/index");
                }
            }
            $this->set($d);
            $this->render("edit");
        }

        public function delete($id)
        {
            $task = new Task();
            $task->id = $id;

            if ($this->taskRepo->delete($task)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
    }