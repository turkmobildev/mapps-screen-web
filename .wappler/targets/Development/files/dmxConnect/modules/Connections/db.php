<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "db",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "databaseType": "MySQL",
        "connectionString": "mysql:host=db;sslverify=false;port=3306;dbname=mapps-screen;user=db_user;password=ubiYDBj9;charset=utf8"
    }
}
JSON;
?>