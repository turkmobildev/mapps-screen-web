<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "mappsTvDB",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "connectionString": "mysql:host=mapps-screen.turkmobil.com.tr;dbname=mappstv;user=screen;password=use147!!;sslverify=false;port=3306",
        "meta"  : false
    }
}
JSON;
?>