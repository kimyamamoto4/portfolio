<?php
/**
 * Database Connection Class
 * Uses PDO for secure database operations
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'portfolio_db';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $conn = null;
    
    /**
     * Get database connection
     * @return PDO|null
     */
    public function getConnection() {
        if ($this->conn !== null) {
            return $this->conn;
        }
        
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_PERSISTENT         => false
            ];
            
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
            return $this->conn;
            
        } catch(PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Close database connection
     */
    public function closeConnection() {
        $this->conn = null;
    }
    
    /**
     * Test database connection
     * @return bool
     */
    public function testConnection() {
        $conn = $this->getConnection();
        return $conn !== null;
    }
    
    /**
     * Execute a query and return results
     * @param string $sql
     * @param array $params
     * @return array|false
     */
    public function query($sql, $params = []) {
        try {
            $conn = $this->getConnection();
            if (!$conn) {
                return false;
            }
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            
            return $stmt->fetchAll();
            
        } catch(PDOException $e) {
            error_log("Query Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Execute an insert/update/delete query
     * @param string $sql
     * @param array $params
     * @return bool|int Returns last insert ID for INSERT, affected rows for UPDATE/DELETE, or false on failure
     */
    public function execute($sql, $params = []) {
        try {
            $conn = $this->getConnection();
            if (!$conn) {
                return false;
            }
            
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute($params);
            
            // Return last insert ID for INSERT statements
            if (stripos(trim($sql), 'INSERT') === 0) {
                return $conn->lastInsertId();
            }
            
            // Return affected rows for UPDATE/DELETE
            return $stmt->rowCount();
            
        } catch(PDOException $e) {
            error_log("Execute Error: " . $e->getMessage());
            return false;
        }
    }
}

// Usage example:
/*
// Create database instance
$db = new Database();

// Test connection
if ($db->testConnection()) {
    echo "Database connected successfully!";
} else {
    echo "Database connection failed!";
}

// Query example (SELECT)
$results = $db->query("SELECT * FROM users WHERE status = ?", ['active']);

// Execute example (INSERT)
$userId = $db->execute(
    "INSERT INTO users (name, email, created_at) VALUES (?, ?, NOW())",
    ['John Doe', 'john@example.com']
);

// Execute example (UPDATE)
$affected = $db->execute(
    "UPDATE users SET name = ? WHERE id = ?",
    ['Jane Doe', 1]
);

// Execute example (DELETE)
$deleted = $db->execute(
    "DELETE FROM users WHERE id = ?",
    [1]
);
*/
?>
