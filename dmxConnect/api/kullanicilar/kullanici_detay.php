<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "kid"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "queryKullaniciDetay",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "kullanicilar",
              "column": "ok_id"
            },
            {
              "table": "kullanicilar",
              "column": "ok_ad_soyad"
            },
            {
              "table": "kullanicilar",
              "column": "ok_unvan"
            },
            {
              "table": "kullanicilar",
              "column": "ok_telefon"
            },
            {
              "table": "kullanicilar",
              "column": "ok_eposta"
            },
            {
              "table": "kullanicilar",
              "column": "ok_olusturulma"
            },
            {
              "table": "kullanicilar",
              "column": "ok_durum"
            },
            {
              "table": "kullanicilar",
              "column": "ok_tip"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.kid}}",
              "test": "1"
            }
          ],
          "table": {
            "name": "oda_kullanicilar",
            "alias": "kullanicilar"
          },
          "primary": "ok_id",
          "joins": [],
          "query": "SELECT ok_id, ok_ad_soyad, ok_unvan, ok_telefon, ok_eposta, ok_olusturulma, ok_durum, ok_tip\nFROM oda_kullanicilar AS kullanicilar\nWHERE ok_id = :P1 /* {{$_GET.kid}} */",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "kullanicilar.ok_id",
                "field": "kullanicilar.ok_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.kid}}",
                "data": {
                  "table": "kullanicilar",
                  "column": "ok_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "ok_id"
                  }
                },
                "operation": "=",
                "table": "oda_kullanicilar"
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "ok_id"
        },
        {
          "type": "text",
          "name": "ok_ad_soyad"
        },
        {
          "type": "text",
          "name": "ok_unvan"
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
          "type": "datetime",
          "name": "ok_olusturulma"
        },
        {
          "type": "number",
          "name": "ok_durum"
        },
        {
          "type": "number",
          "name": "ok_tip"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>