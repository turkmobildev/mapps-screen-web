<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "phone"
      },
      {
        "type": "text",
        "name": "password"
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
                "table": "oda_kullanicilar",
                "column": "ok_id"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_uuid"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.phone}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.password.sha256('netglobal')}}",
                "test": ""
              }
            ],
            "table": {
              "name": "oda_kullanicilar"
            },
            "primary": "ok_id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "oda_kullanicilar.ok_telefon",
                  "field": "oda_kullanicilar.ok_telefon",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.phone}}",
                  "data": {
                    "table": "oda_kullanicilar",
                    "column": "ok_telefon",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 12,
                      "primary": false,
                      "nullable": true,
                      "name": "ok_telefon"
                    }
                  },
                  "operation": "="
                },
                {
                  "id": "oda_kullanicilar.ok_sifre",
                  "field": "oda_kullanicilar.ok_sifre",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.password.sha256('netglobal')}}",
                  "data": {
                    "table": "oda_kullanicilar",
                    "column": "ok_sifre",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 255,
                      "primary": false,
                      "nullable": true,
                      "name": "ok_sifre"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT ok_id, ok_uuid\nFROM oda_kullanicilar\nWHERE ok_telefon = :P1 /* {{$_POST.phone}} */ AND ok_sifre = :P2 /* {{$_POST.password.sha256('netglobal')}} */"
          }
        },
        "meta": [
          {
            "type": "number",
            "name": "ok_id"
          },
          {
            "type": "text",
            "name": "ok_uuid"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "queryToken",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "tokens",
                "column": "*"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{query.ok_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "tokens"
            },
            "primary": "id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "tokens.user_id",
                  "field": "tokens.user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{query.ok_id}}",
                  "data": {
                    "table": "tokens",
                    "column": "user_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": false,
                      "references": "ok_id",
                      "inTable": "oda_kullanicilar",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "CASCADE",
                      "name": "user_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT *\nFROM tokens\nWHERE user_id = :P1 /* {{query.ok_id}} */"
          }
        },
        "meta": [
          {
            "type": "number",
            "name": "id"
          },
          {
            "type": "number",
            "name": "user_id"
          },
          {
            "type": "text",
            "name": "token"
          },
          {
            "type": "datetime",
            "name": "created_at"
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
            "steps": [
              {
                "name": "token",
                "module": "core",
                "action": "setvalue",
                "options": {
                  "value": "{{queryToken.token}}"
                },
                "meta": [],
                "outputType": "text",
                "output": true
              },
              {
                "name": "verify",
                "module": "jwt",
                "action": "verify",
                "options": {
                  "key": "netglobal",
                  "token": "{{token}}",
                  "throw": true
                },
                "outputType": "text",
                "output": false
              },
              {
                "name": "result",
                "module": "core",
                "action": "setvalue",
                "options": {
                  "value": "{{verify}}"
                },
                "meta": [],
                "outputType": "text",
                "output": true
              }
            ]
          },
          "else": {
            "steps": {
              "name": "response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 401,
                "data": "Unauthorized"
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