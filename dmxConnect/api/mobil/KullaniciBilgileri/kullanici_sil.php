<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "password"
      }
    ],
    "$_SERVER": [
      {
        "type": "text",
        "name": "HTTP_MAPPS_AUTHORIZATION"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "",
      "module": "core",
      "action": "condition",
      "options": {
        "if": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}",
        "then": {
          "steps": [
            {
              "name": "decode",
              "module": "jwt",
              "action": "decode",
              "options": {
                "token": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}"
              },
              "outputType": "text",
              "output": false
            },
            {
              "name": "userid",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "{{decode.payload.sub}}"
              },
              "meta": [],
              "outputType": "text",
              "output": false
            },
            {
              "name": "phone",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "{{decode.payload.phone}}"
              },
              "meta": [],
              "outputType": "text",
              "output": false
            },
            {
              "name": "delete",
              "module": "dbupdater",
              "action": "delete",
              "options": {
                "connection": "mappsTvDB",
                "sql": {
                  "type": "delete",
                  "table": "oda_kullanicilar",
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "ok_id",
                        "field": "ok_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{userid}}",
                        "data": {
                          "column": "ok_id"
                        },
                        "operation": "="
                      },
                      {
                        "id": "ok_telefon",
                        "field": "ok_telefon",
                        "type": "string",
                        "operator": "equal",
                        "value": "{{phone}}",
                        "data": {
                          "column": "ok_telefon"
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "returning": "ok_id",
                  "query": "DELETE\nFROM oda_kullanicilar\nWHERE ok_id = :P1 /* {{userid}} */ AND ok_telefon = :P2 /* {{phone}} */",
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{userid}}",
                      "test": ""
                    },
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P2",
                      "value": "{{phone}}",
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
              ],
              "output": true
            }
          ]
        }
      },
      "outputType": "boolean",
      "output": false
    }
  }
}
JSON
);
?>