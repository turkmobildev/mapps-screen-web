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
      },
      {
        "type": "text",
        "name": "ekran_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
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
      },
      {
        "name": "delete",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "delete",
            "table": "oda_ekran_kullanicilar",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "okk_oda_kullanicilar_id",
                  "field": "okk_oda_kullanicilar_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.kullanici_id}}",
                  "data": {
                    "column": "okk_oda_kullanicilar_id"
                  },
                  "operation": "="
                },
                {
                  "id": "okk_ekranlar_id",
                  "field": "okk_ekranlar_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.ekran_id}}",
                  "data": {
                    "column": "okk_ekranlar_id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "okk_id",
            "query": "DELETE\nFROM oda_ekran_kullanicilar\nWHERE okk_oda_kullanicilar_id = :P1 /* {{$_POST.kullanici_id}} */ AND okk_ekranlar_id = :P2 /* {{$_POST.ekran_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.kullanici_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.ekran_id}}",
                "test": ""
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ]
      }
    ]
  }
}
JSON
);
?>