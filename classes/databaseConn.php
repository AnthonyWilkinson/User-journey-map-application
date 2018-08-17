<?php

class databaseConn {
    // private statics to hold the connection
    private static $dbConnection = null;

    // make the next 2 functions private to prevent normal
    // class instantiation
    private function __construct() {
    }
    private function __clone() {
    }

    // Pass database details
    public static function getConnection($dsn='mysql:host=localhost;dbname=unn_w14011103', $username='unn_w14011103', $password='Pamelawilk21') {

        // if there isn't a connection already then create one
        if ( !self::$dbConnection ) {
            try {
                // connection options to include using exception mode
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                // pass in the options as the last parameter so pdo uses exceptions
                self::$dbConnection = new PDO( $dsn, $username, $password, $options );
            }
            catch( PDOException $e ) {
                // in a production system you would log the error not display it
                echo $e->getMessage();
            }
        }
        // return the connection
        return self::$dbConnection;
    }

}