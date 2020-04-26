<?php
    /*
     * Base Controller
     * Loads models and views
     */

    class Controller {

        public function __construct() {
        }

        // Load Model
        public function model($model) {
            // Require Model File
            require_once '../app/models/' . $model . '.php';

            // Instantiate model class
            return new $model();
        }

        // Load View
        public function view($view, $data) {
            // Require View File if exists
            if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                // View does not exist
                die("View does not exist");
            }
        }
    }