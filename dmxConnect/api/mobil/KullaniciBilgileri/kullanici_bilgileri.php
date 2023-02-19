<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
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
        "name": "decoder",
        "module": "core",
        "action": "exec",
        "options": {
          "exec": "jwt/jwt-decode",
          "params": {
            "token": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}"
          }
        },
        "output": false
      },
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
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_telefon"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_eposta"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_tip"
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
            "query": "SELECT ok_eposta, ok_ad_soyad, ko_foto_url, ok_unvan, ok_olusturulma, ok_durum, ok_telefon, ok_eposta, ok_tip\nFROM oda_kullanicilar\nWHERE ok_id = :P1 /* {{decoder.userId}} */ AND ok_telefon = :P2 /* {{decoder.phone}} */"
          }
        },
        "output": true,
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
          },
          {
            "type": "text",
            "name": "ok_telefon"
          },
          {
            "type": "number",
            "name": "ok_tip"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "ok_durum",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{(query.ok_durum == 1)?true:false}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "ok_olusturulma",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{query.ok_olusturulma.formatDate('dd.MM.yyyy')}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      }
    ]
  }
}
JSON
);
?>