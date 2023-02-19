<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "unvan"
      },
      {
        "type": "text",
        "name": "eposta"
      },
      {
        "type": "text",
        "name": "adSoyad"
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
      "lib/jwt/jwt-decode",
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
                "column": "ok_eposta"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_ad_soyad"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ko_foto_url"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_unvan"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_olusturulma"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_durum"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{decoder.userId}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{decoder.phone}}",
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
                  "id": "oda_kullanicilar.ok_id",
                  "field": "oda_kullanicilar.ok_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{decoder.userId}}",
                  "data": {
                    "table": "oda_kullanicilar",
                    "column": "ok_id",
                    "type": "number",
                    "columnObj": {
                      "type": "increments",
                      "primary": true,
                      "nullable": false,
                      "name": "ok_id"
                    }
                  },
                  "operation": "="
                },
                {
                  "id": "oda_kullanicilar.ok_telefon",
                  "field": "oda_kullanicilar.ok_telefon",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{decoder.phone}}",
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
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT ok_eposta, ok_ad_soyad, ko_foto_url, ok_unvan, ok_olusturulma, ok_durum\nFROM oda_kullanicilar\nWHERE ok_id = :P1 /* {{decoder.userId}} */ AND ok_telefon = :P2 /* {{decoder.phone}} */"
          }
        },
        "meta": [
          {
            "type": "text",
            "name": "ok_eposta"
          },
          {
            "type": "text",
            "name": "ok_ad_soyad"
          },
          {
            "type": "text",
            "name": "ko_foto_url"
          },
          {
            "type": "text",
            "name": "ok_unvan"
          },
          {
            "type": "datetime",
            "name": "ok_olusturulma"
          },
          {
            "type": "number",
            "name": "ok_durum"
          }
        ],
        "outputType": "object",
        "output": true
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
                        "column": "ok_ad_soyad",
                        "type": "text",
                        "value": "{{$_POST.adSoyad}}"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_unvan",
                        "type": "text",
                        "value": "{{$_POST.unvan}}"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_eposta",
                        "type": "text",
                        "value": "{{$_POST.eposta}}"
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
                          "value": "{{decoder.userId}}",
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
                    "query": "UPDATE oda_kullanicilar\nSET ok_ad_soyad = :P1 /* {{$_POST.adSoyad}} */, ok_unvan = :P2 /* {{$_POST.unvan}} */, ok_eposta = :P3 /* {{$_POST.eposta}} */\nWHERE ok_id = :P4 /* {{decoder.userId}} */",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.adSoyad}}",
                        "test": ""
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.unvan}}",
                        "test": ""
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.eposta}}",
                        "test": ""
                      },
                      {
                        "operator": "equal",
                        "type": "expression",
                        "name": ":P4",
                        "value": "{{decoder.userId}}",
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
                        "data": "OK"
                      }
                    }
                  },
                  "else": {
                    "steps": {
                      "name": "response",
                      "module": "core",
                      "action": "response",
                      "options": {
                        "status": 403,
                        "data": "forbidden"
                      },
                      "disabled": true
                    }
                  }
                },
                "outputType": "boolean"
              }
            ]
          },
          "else": {
            "steps": {
              "name": "response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 403,
                "data": "notFound"
              },
              "disabled": true
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