<?php

    namespace MVC\Core;

    interface ResourceInterface
    {
        public function _init($table, $id, $model);
        public function save($model);
        public function delete($model);
    }
