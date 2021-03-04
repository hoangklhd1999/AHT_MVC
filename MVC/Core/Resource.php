<?php

    namespace MVC\Core;


    use MVC\Config\Database;
    use PDO;

    class Resource implements ResourceInterface
    {
        private $table;
        private $id;
        private $model;

        /**
         * Init the parameters need for
         * @param string $table The table in database
         * @param null|int $id The id field
         * @param object $model The model mapping to table in database
         */

        public function _init($table, $id, $model)
        {
            $this->table = $table;
            $this->id = $id;
            $this->model = $model;
        }

        public function save($model)
        {
            $placeNames = [];
            $properties = $model->getProperties();

            if ($model->id === null) {
                unset($properties['id']);
            }

            foreach ($properties as $key => $value) {
                array_push($placeNames, ':' . $key);
            }

            $columns = [];

            foreach (array_keys($properties) as $k => $v) {
                if ($v !== 'id') {
                    array_push($columns, $v . ' = :' . $v);
                }
            }

            $columns = implode(',', $columns);
            $columnsString = implode(',', array_keys($properties));
            $placeNamesString = implode(',', $placeNames);

            if ($model->id === null) {

                $sql = "INSERT INTO {$this->table} ({$columnsString}, created_at, updated_at) VALUES ({$placeNamesString}, :created_at, :updated_at)";
                $req = Database::getBdd()->prepare($sql);
                $date = array("created_at" => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));

                return $req->execute(array_merge($properties, $date));
            } else {

                $sql = "UPDATE {$this->table} SET " . $columns . ', updated_at = :updated_at WHERE id = :id';
                $req = Database::getBdd()->prepare($sql);
                $date = array("id" => $model->id, 'updated_at' => date('Y-m-d H:i:s'));

                return $req->execute(array_merge($properties, $date));
            }
        }

        public function find($id)
        {
            $class = get_class($this->model);
            $sql = "SELECT * FROM {$this->table} where id = :id";
            $req = Database::getBdd()->prepare($sql);
            $req->setFetchMode(PDO::FETCH_INTO, new $class);
            $req->execute(['id' => $id]);

            return $req->fetch();
        }

        public function all($model)
        {
            $properties = implode(',', array_keys($model->getProperties()));
            $sql = "SELECT {$properties} FROM {$this->table}";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();

            return $req->fetchAll(PDO::FETCH_OBJ);
        }

        public function delete($model)
        {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $req = Database::getBdd()->prepare($sql);

            return $req->execute([':id' => $model->id]);
        }
    }