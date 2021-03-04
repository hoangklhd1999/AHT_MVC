<?php

    namespace MVC\Models;

    use MVC\Core\Resource;
    use MVC\Models\Task;

    class TaskResource extends Resource
    {
        public function __construct($table, $id, Task $task)
        {
            parent::_init($table, $id, $task);
        }
    }