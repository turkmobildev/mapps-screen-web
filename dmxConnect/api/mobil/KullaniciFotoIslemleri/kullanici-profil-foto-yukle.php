<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "file",
        "name": "foto",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          }
        ],
        "outputType": "file"
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
    "steps": [
      {
        "name": "decode",
        "module": "jwt",
        "action": "decode",
        "options": {
          "token": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}"
        },
        "outputType": "text",
        "output": true
      },
      {
        "name": "aaa",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{decode}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "upload",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads",
          "template": "{name}{_n}{ext}",
          "replaceSpace": true,
          "fields": "{{$_POST.foto}}"
        },
        "output": true,
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "file"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{upload.error==0}}",
          "then": {
            "steps": {
              "name": "update",
              "module": "dbupdater",
              "action": "update",
              "options": {
                "connection": "mappsTvDB",
                "sql": {
                  "type": "update",
                  "values": [
                    {
                      "table": "oda_kullanicilar",
                      "column": "ko_foto_url",
                      "type": "text",
                      "value": "{{'https://mapps-screen.turkmobil.com.tr/'+upload.url}}"
                    }
                  ],
                  "table": "oda_kullanicilar",
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "ok_id",
                        "field": "ok_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{decode.payload.userid}}",
                        "data": {
                          "column": "ok_id"
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "returning": "ok_id",
                  "query": "UPDATE oda_kullanicilar\nSET ko_foto_url = :P1 /* {{'https://mapps-screen.turkmobil.com.tr/'+upload.url}} */\nWHERE ok_id = :P2 /* {{decode.payload.userid}} */",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{'https://mapps-screen.turkmobil.com.tr/'+upload.url}}",
                      "test": ""
                    },
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P2",
                      "value": "{{decode.payload.userid}}",
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