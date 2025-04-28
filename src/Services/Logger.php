<?php

namespace App\Services;

use App\Configs\Config;
use PDO;

class Logger
{
    private PDO $db;

    public function __construct()
    {
        $storagePath = Config::get('databases.sqlite');
        $this->db = new PDO('sqlite:' . $storagePath);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->createTableIfNotExists();
    }

    /**
     * Creates the 'visitors' table if it does not exist.
     *
     * @return void
     */
    private function createTableIfNotExists(): void
    {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS visitors (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ip TEXT NOT NULL,
                user_agent TEXT NOT NULL,
                visited_at TEXT NOT NULL
            )
        ");
    }

    /**
     * Logs visitor information into the database.
     *
     * @return void
     */
    public function log(): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO visitors (ip, user_agent, visited_at)
            VALUES (:ip, :user_agent, :visited_at)
        ");

        $stmt->execute([
            ':ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            ':visited_at' => date('Y-m-d H:i:s')
        ]);
    }
}
