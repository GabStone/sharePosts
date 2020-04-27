<?php

    class Pages extends Controller {

        public function __construct() {
        }

        /*
         * Landing Page
         */
        public function index() {
            $data = ['title' =>'SharePosts', 'description' => 'Simple social network built using phpMVC framework'];
            $this->view('pages/index', $data);
        }

        /*
         * About Page
         */
        public function about() {
            $data = ['title' => 'About Us', 'description' => 'App to share posts with other users'];
            $this->view('pages/about', $data);
        }
    }