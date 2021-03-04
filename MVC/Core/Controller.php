<?php

    namespace MVC\Core;

    class Controller
    {
        var $vars = [];
        var $layout = "default";

        function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

        function render($filename)
        {
            extract($this->vars);
            ob_start();
            $viewPath = str_replace('Controller', '', get_class($this));
            $viewPath = str_replace('MVC\s', '', $viewPath);
            $viewPath = str_replace("\\", '', $viewPath);
            $viewPath = ROOT . '/Views/' . $viewPath . '/' . $filename . '.php';

            require($viewPath);

            $content_for_layout = ob_get_clean();

            if ($this->layout == false) {
                $content_for_layout;
            } else {

                require(ROOT . "Views/Layouts/" . $this->layout . '.php');
            }
        }

        private function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        protected function secure_form($form)
        {
            foreach ($form as $key => $value) {
                $form[$key] = $this->secure_input($value);
            }
        }
    }