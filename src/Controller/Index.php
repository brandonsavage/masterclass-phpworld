<?php

namespace Masterclass\Controller;

use Masterclass\Database\Database;
use PDO;

class Index {
    
    protected $db;

    public function __construct(\PDO $pdo) {
        $this->db = $pdo;
        $this->newDB = new Database($pdo);
    }
    
    public function index() {
        
        $sql = 'SELECT * FROM story ORDER BY created_on DESC';
        $stories = $this->newDB->fetchAll($sql);
        
        $content = '<ol>';
        
        foreach($stories as $story) {
            $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
            $count = $this->newDB->fetchColumn($comment_sql, [$story['id']]);
            $content .= '
                <li>
                <a class="headline" href="' . $story['url'] . '">' . $story['headline'] . '</a><br />
                <span class="details">' .
                $story['created_by'] . ' | <a href="/story/?id=' .
                $story['id'] . '">' . $count . ' Comments</a> |
                ' . date('n/j/Y g:i a', strtotime($story['created_on'])) . '</span>
                </li>
            ';
        }
        
        $content .= '</ol>';
        
        require '../layout.phtml';
    }
}

