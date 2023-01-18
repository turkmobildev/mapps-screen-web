<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "rowid"
      }
    ]
  },
  "exec": {
    "steps": {
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
              "column": "ok_ad_soyad"
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
              "value": "{{$_GET.rowid}}",
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
                "value": "{{$_GET.rowid}}",
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
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT ok_ad_soyad, ok_telefon, ok_eposta, ok_tip, ok_durum\nFROM oda_kullanicilar\nWHERE ok_id = :P1 /* {{$_GET.rowid}} */"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "text",
          "name": "ok_ad_soyad"
        },
        {
          "type": "text",
          "name": "ok_telefon"
        },
        {
          "type": "text",
          "name": "ok_eposta"
        },
        {
          "type": "number",
          "name": "ok_tip"
        },
        {
          "type": "number",
          "name": "ok_durum"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>