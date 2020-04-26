<?php
    /*
     * App Core Class
     * Creates URL & loads core controller
     * URL Format - /controller/method/params
     */

    class Core {

        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            //print_r($this->getURL());

            $url = $this->getURL();

            // Look in controllers for first value (try and find file with the first param name)
            if (isset($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If the file exists, set the controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for second part of url
            if (isset($url[1])) {
                // Check if the method exist in the controller class
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // Get Params
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getURL() {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');

                // Filter the URL to match a correctly formatted URL
                $url = filter_var($url, FILTER_SANITIZE_URL);

                // Create array with the url parameters
                $url = explode('/', $url);
                return $url;
            }
        }
    }