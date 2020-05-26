<?php

    class Post {

        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getPosts() {
            $this->db->query('SELECT *, posts.id as postId, users.id as userId, posts.created_at as postCreatedAt, users.created_at as usersCreatedAt FROM posts 
                                    INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC');
            $result = $this->db->resultSet();
            return $result;
        }

        public function addPost($data) {
            $this->db->query('INSERT INTO posts(title, user_id, body) VALUES(:title, :user_id, :body)');

            // Bind Values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':body', $data['body']);

            // Execute Insert Statement
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function getPostById($id) {
            $this->db->query('SELECT * FROM posts where id = :id');

            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function editPost($data) {
            $this->db->query('UPDATE posts SET title = :title, body = :body where id = :id');

            // Bind Values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':id', $data['id']);

            // Execute Insert Statement
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deletePost($id) {
            $this->db->query('DELETE FROM posts where id = :id');

            // Bind Values
            $this->db->bind(':id', $id);

            // Execute Insert Statement
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }