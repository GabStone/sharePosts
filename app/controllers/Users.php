<?php


    class Users extends Controller {


        public function __construct() {

            $this->userModel = $this->model('User');

        }

        public function register() {
            // Check for POST Request
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process the form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'nameErr' => '',
                    'emailErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => ''
                ];

                // Validate Email
                if (empty($data['email'])) {
                    $data['emailErr'] = 'Please enter email';
                } else {
                    // Check email
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['emailErr'] = 'Email already registered';
                    }
                }

                // Validate Name
                if (empty($data['name'])) {
                    $data['nameErr'] = 'Please enter name';
                }

                // Validate Password
                if (empty($data['password'])) {
                    $data['passwordErr'] = 'Please enter password';
                } else if (strlen($data['password'] < 6)) {
                    $data['passwordErr'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if (empty($data['confirmPassword'])) {
                    $data['confirmPasswordErr'] = 'Please confirm password';
                } else if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordErr'] = 'Passwords do not match';
                }

                // Make sure errors are empty
                if (empty($data['emailErr']) && empty($data['nameErr']) && empty($data['passwordErr']) && empty($data['confirmPasswordErr'])) {
                    // Validated
                    die("success");
                } else {
                    // Load the view with errors
                    $this->view('users/register', $data);
                }

            } else {
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirmPassword' => '',
                    'nameErr' => '',
                    'emailErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => ''
                ];

                // Load the view
                $this->view('users/register', $data);

            }

        }

        public function login() {
            // Check for POST Request
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process the form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailErr' => '',
                    'passwordErr' => '',
                ];

                // Validate Email
                if (empty($data['email'])) {
                    $data['emailErr'] = 'Please enter email';
                }

                // Validate Password
                if (empty($data['password'])) {
                    $data['passwordErr'] = 'Please enter password';
                }

                // Make sure errors are empty
                if (empty($data['emailErr']) && empty($data['passwordErr'])) {
                    die("success");
                } else {
                    // Load the view with errors
                    $this->view('users/login', $data);
                }


            } else {
                // Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'emailErr' => '',
                    'passwordErr' => ''
                ];

                // Load the view
                $this->view('users/login', $data);

            }
        }
    }