<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "token"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "tokens",
                "column": "token"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.token}}",
                "test": ""
              }
            ],
            "table": {
              "name": "tokens"
            },
            "primary": "id",
            "joins": [],
            "query": "SELECT token\nFROM tokens\nWHERE token = :P1 /* {{$_POST.token}} */",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "tokens.token",
                  "field": "tokens.token",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.token}}",
                  "data": {
                    "table": "tokens",
                    "column": "token",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "maxLength": 255,
                      "primary": false,
                      "nullable": false,
                      "name": "token"
                    }
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
            "type": "text",
            "name": "token"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{query}}",
          "then": {
            "steps": {
              "name": "decode",
              "module": "jwt",
              "action": "decode",
              "options": {
                "token": "{{query.token}}"
              },
              "outputType": "text"
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