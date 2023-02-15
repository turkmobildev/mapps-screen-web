<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "oda_id"
      },
      {
        "type": "number",
        "name": "renk_id"
      },
      {
        "type": "text",
        "name": "ip_adres"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "update",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_ekran_renk_id",
                "type": "number",
                "value": "{{$_POST.renk_id}}"
              }
            ],
            "table": "oda_ekran_ozellikleri",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "oeo_oda_id",
                  "field": "oeo_oda_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.oda_id}}",
                  "data": {
                    "column": "oeo_oda_id"
                  },
                  "operation": "="
                },
                {
                  "id": "oeo_ekran_ip",
                  "field": "oeo_ekran_ip",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.ip_adres}}",
                  "data": {
                    "column": "oeo_ekran_ip"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "oeo_id",
            "query": "UPDATE oda_ekran_ozellikleri\nSET oeo_ekran_renk_id = :P1 /* {{$_POST.renk_id}} */\nWHERE oeo_oda_id = :P2 /* {{$_POST.oda_id}} */ AND oeo_ekran_ip = :P3 /* {{$_POST.ip_adres}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.renk_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.oda_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_POST.ip_adres}}",
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
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{update.affected}}",
          "then": {
            "steps": {
              "name": "response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 200,
                "data": "updated"
              }
            }
          },
          "else": {
            "steps": {
              "name": "response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 400,
                "data": "Bad Request"
              }
            }
          }
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>