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
        "type": "text",
        "name": "ip_adresi"
      },
      {
        "type": "text",
        "name": "cihaz_no"
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
                "column": "oeo_device_no",
                "type": "text",
                "value": "{{$_POST.cihaz_no}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_ekran_ip",
                "type": "text",
                "value": "{{$_POST.ip_adresi}}"
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
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "oeo_id",
            "query": "UPDATE oda_ekran_ozellikleri\nSET oeo_device_no = :P1 /* {{$_POST.cihaz_no}} */, oeo_ekran_ip = :P2 /* {{$_POST.ip_adresi}} */\nWHERE oeo_oda_id = :P3 /* {{$_POST.oda_id}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.cihaz_no}}",
                "test": ""
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.ip_adresi}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_POST.oda_id}}",
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
              "name": "responce",
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
                "data": "Bad request"
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