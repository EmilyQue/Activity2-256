<?php
namespace App\Services\Business;

use \PDO;
use App\Model\UserModel;
use Illuminate\Support\Facades\Log;
use App\Services\Data\SecurityDAO;

class SecurityService {
    public function authenticate(UserModel $user) {
        Log::info("Entering SecurityService.authenticate()");
        
        //best practice: externalize your app configuration 
        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        
        //best practice: do not create database connections in a dao 
        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //create a security service dao with this connection and try to find the password in user
        $service = new SecurityDAO($conn);
        $flag = $service->findByUser($user);
        
        //return the finder results
        Log::info("Exit SecurityService.authenticate() with " . $flag);
        return $flag;
    }
}