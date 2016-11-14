<?php

namespace Masterclass\Controller;

use Masterclass\Request\Request;
use PDO;

class Comment {

    protected $db;
    protected $request;

    public function __construct(\PDO $pdo, Request $request) {
        $this->db = $pdo;
        $this->request = $request;
    }
    
    public function create() {
        if(!($this->request->session('AUTHENTICATED'))) {
            header("Location: /");
            exit;
        }
        
        $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            $this->request->session('username'),
            $this->request->post('story_id'),
            filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ));
        header("Location: /story/?id=" . $_POST['story_id']);
    }
    
}