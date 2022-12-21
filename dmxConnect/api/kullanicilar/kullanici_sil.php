<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "kullanici_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "deleteKullanici",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "delete",
          "table": "oda_kullanicilar",
          "returning": "ok_id",
          "query": "DELETE\nFROM oda_kullanicilar\nWHERE ok_id = :P1 /* {{$_POST.kullanici_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.kullanici_id}}",
              "test": ""
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "ok_id",
                "field": "ok_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.kullanici_id}}",
                "data": {
                  "column": "ok_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>