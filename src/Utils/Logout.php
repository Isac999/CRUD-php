<?php 
    namespace models\utils;

    require_once('./src/Models/Connect.php');
    use models\connect\Connect;

    class Logout extends Connect {
        public static function logout() : void
        {
            if (!isset($_SESSION)) {
                session_start();
            }
            
            session_destroy();
            header("Location: ../login");
        }
    }

    Logout::logout();
?>