<?php
/**
 * KofarArziki Data - Database Connection
 * PDO connection with prepared statements support
 */

require_once 'config.php';

class Database {
    private static $pdo = null;

    /**
     * Get database connection
     * @return PDO
     */
    public static function connect() {
        if (self::$pdo === null) {
            try {
                $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
                self::$pdo = new PDO(
                    $dsn,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                if (DEBUG_MODE) {
                    die('Database Connection Error: ' . $e->getMessage());
                } else {
                    error_log('Database Connection Error: ' . $e->getMessage());
                    die('Database connection failed. Please try again later.');
                }
            }
        }
        return self::$pdo;
    }

    /**
     * Execute prepared statement query
     * @param string $query SQL query with placeholders
     * @param array $params Parameters for prepared statement
     * @return mixed Query result
     */
    public static function query($query, $params = []) {
        try {
            $stmt = self::connect()->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            if (DEBUG_MODE) {
                error_log('Query Error: ' . $e->getMessage());
            }
            throw $e;
        }
    }

    /**
     * Fetch all results from query
     * @param string $query SQL query with placeholders
     * @param array $params Parameters for prepared statement
     * @return array Results
     */
    public static function fetchAll($query, $params = []) {
        $stmt = self::query($query, $params);
        return $stmt->fetchAll();
    }

    /**
     * Fetch single result from query
     * @param string $query SQL query with placeholders
     * @param array $params Parameters for prepared statement
     * @return array|null Single result or null
     */
    public static function fetch($query, $params = []) {
        $stmt = self::query($query, $params);
        return $stmt->fetch();
    }

    /**
     * Execute INSERT, UPDATE, DELETE query
     * @param string $query SQL query with placeholders
     * @param array $params Parameters for prepared statement
     * @return int Number of affected rows
     */
    public static function execute($query, $params = []) {
        $stmt = self::query($query, $params);
        return $stmt->rowCount();
    }

    /**
     * Get last insert ID
     * @return string Last insert ID
     */
    public static function lastInsertId() {
        return self::connect()->lastInsertId();
    }

    /**
     * Begin transaction
     */
    public static function beginTransaction() {
        self::connect()->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public static function commit() {
        self::connect()->commit();
    }

    /**
     * Rollback transaction
     */
    public static function rollback() {
        self::connect()->rollBack();
    }
}

?>
