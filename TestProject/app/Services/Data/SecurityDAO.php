<?php
namespace App\Services\Data;

use \PDO;
use App\Model\UserModel;
use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use PDOException;

class SecurityDAO {
    private $conn = null;
    
    //best practice: do not create a database connections in a dao
    //so you can support atomic database transactions
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function findByUser(UserModel $user) {
        Log::info("Entering SecurityDAO.findByUser()");
        
        try {
        //select username and password and see if the row exists
        $username = $user->getUsername();
        $password = $user->getPassword();
        
        $stmt = $this->conn->prepare('SELECT ID, USERNAME, PASSWORD FROM users WHERE USERNAME = :username AND PASSWORD = :password');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        /*see if user existed and return true if found
        else return false if not found*/
        if ($stmt->rowCount() == 1) {
            Log::info("Exit SecurityDAO.findByUser() with true");
            return true;
        }
        
        else {
            Log::info("Exit SecurityDAO.findByUser() with false");
            return false;
            }
        }
        
        catch (PDOException $e) {
            //best practice: catch all exceptions (do not swallow exceptions),
            //log the exception, do not throw technology specific exceptions,
            //and throw a custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}