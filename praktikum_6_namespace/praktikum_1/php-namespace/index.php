<?php 

require_once __DIR__ . '/src/Models/User.php'; 
require_once __DIR__ . '/src/Services/UserService.php'; 

use App\Services\UserService; 

$service = new UserService(); 

$user = $service->createUser( 
    'Budi', 
    'budi@example.com' 
); 

echo $service->displayUser($user);