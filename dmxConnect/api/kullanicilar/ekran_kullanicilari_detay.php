<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "ekranid"
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "oda_ekran_kullanicilar",
              "column": "okk_id"
            },
            {
              "table": "oda_ekran_kullanicilar",
              "column": "okk_ekranlar_id"
            },
            {
              "table": "oda_ekran_kullanicilar",
              "column": "okk_oda_kullanicilar_id"
            },
            {
              "table": "k",
              "column": "ok_id"
            },
            {
              "table": "k",
              "column": "ok_ad_soyad"
            },
            {
              "table": "k",
              "column": "ok_unvan"
            },
            {
              "table": "k",
              "column": "ok_telefon"
            },
            {
              "table": "k",
              "column": "ok_eposta"
            },
            {
              "table": "k",
              "column": "ok_durum"
            },
            {
              "table": "k",
              "column": "ok_tip"
            },
            {
              "table": "k",
              "column": "ok_olusturulma"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.ekranid}}",
              "test": ""
            }
          ],
          "table": {
            "name": "oda_ekran_kullanicilar"
          },
          "primary": "okk_id",
          "joins": [
            {
              "table": "oda_kullanicilar",
              "column": "*",
              "alias": "k",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "k",
                    "column": "ok_id",
                    "operator": "equal",
                    "value": {
                      "table": "oda_ekran_kullanicilar",
                      "column": "okk_oda_kullanicilar_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "ok_id"
            }
          ],
          "query": "SELECT oda_ekran_kullanicilar.okk_id, oda_ekran_kullanicilar.okk_ekranlar_id, oda_ekran_kullanicilar.okk_oda_kullanicilar_id, k.ok_id, k.ok_ad_soyad, k.ok_unvan, k.ok_telefon, k.ok_eposta, k.ok_durum, k.ok_tip, k.ok_olusturulma\nFROM oda_ekran_kullanicilar\nINNER JOIN oda_kullanicilar AS k ON k.ok_id = oda_ekran_kullanicilar.okk_oda_kullanicilar_id\nWHERE oda_ekran_kullanicilar.okk_ekranlar_id = :P1 /* {{$_GET.ekranid}} */",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "oda_ekran_kullanicilar.okk_ekranlar_id",
                "field": "oda_ekran_kullanicilar.okk_ekranlar_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.ekranid}}",
                "data": {
                  "table": "oda_ekran_kullanicilar",
                  "column": "okk_ekranlar_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "default": "",
                    "primary": false,
                    "nullable": true,
                    "name": "okk_ekranlar_id"
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
          "type": "number",
          "name": "okk_id"
        },
        {
          "type": "number",
          "name": "okk_ekranlar_id"
        },
        {
          "type": "number",
          "name": "okk_oda_kullanicilar_id"
        },
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
          "type": "number",
          "name": "ok_durum"
        },
        {
          "type": "number",
          "name": "ok_tip"
        },
        {
          "type": "datetime",
          "name": "ok_olusturulma"
        }
      ],
      "outputType": "array",
      "output": true
    }
  }
}
JSON
);
?>