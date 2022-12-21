<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "queryKullanicilar",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "SELECT",
          "limit": 10,
          "columns": [
            {
              "table": "oda_kullanicilar",
              "column": "ok_id"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_ad_soyad"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_unvan"
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
              "column": "ok_sifre"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ko_foto_url"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_tip"
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
          "params": [],
          "table": {
            "name": "oda_kullanicilar"
          },
          "primary": "ok_id",
          "joins": [],
          "query": "SELECT ok_id, ok_ad_soyad, ok_unvan, ok_telefon, ok_eposta, ok_sifre, ko_foto_url, ok_tip, ok_olusturulma, ok_durum\nFROM oda_kullanicilar\nFETCH NEXT 10 ROWS ONLY"
        }
      },
      "output": true,
      "meta": [
        {
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
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
              "type": "text",
              "name": "ok_sifre"
            },
            {
              "type": "text",
              "name": "ko_foto_url"
            },
            {
              "type": "number",
              "name": "ok_tip"
            },
            {
              "type": "datetime",
              "name": "ok_olusturulma"
            },
            {
              "type": "number",
              "name": "ok_durum"
            }
          ]
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>