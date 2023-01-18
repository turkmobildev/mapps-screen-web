<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
        "type": "text",
        "name": "ok_sifre"
      },
      {
        "type": "number",
        "name": "ok_tip"
      },
      {
        "type": "number",
        "name": "ok_durum"
      },
      {
        "type": "number",
        "name": "okk_ekranlar_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "insert",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "oda_kullanicilar",
                "column": "ok_ad_soyad",
                "type": "text",
                "value": "{{$_POST.ok_ad_soyad}}"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_telefon",
                "type": "text",
                "value": "{{$_POST.ok_telefon}}"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_eposta",
                "type": "text",
                "value": "{{$_POST.ok_eposta}}"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_sifre",
                "type": "text",
                "value": "{{$_POST.ok_sifre.md5('TURKMOBIL')}}"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_tip",
                "type": "number",
                "value": "{{$_POST.ok_tip}}"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_olusturulma",
                "type": "datetime",
                "value": "{{NOW}}"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_durum",
                "type": "number",
                "value": "{{$_POST.ok_durum}}"
              }
            ],
            "table": "oda_kullanicilar",
            "returning": "ok_id",
            "query": "INSERT INTO oda_kullanicilar\n(ok_ad_soyad, ok_telefon, ok_eposta, ok_sifre, ok_tip, ok_olusturulma, ok_durum) VALUES (:P1 /* {{$_POST.ok_ad_soyad}} */, :P2 /* {{$_POST.ok_telefon}} */, :P3 /* {{$_POST.ok_eposta}} */, :P4 /* {{$_POST.ok_sifre.md5('TURKMOBIL')}} */, :P5 /* {{$_POST.ok_tip}} */, :P6 /* {{NOW}} */, :P7 /* {{$_POST.ok_durum}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.ok_ad_soyad}}",
                "test": ""
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.ok_telefon}}",
                "test": ""
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.ok_eposta}}",
                "test": ""
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.ok_sifre.md5('TURKMOBIL')}}",
                "test": ""
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.ok_tip}}",
                "test": ""
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{NOW}}",
                "test": ""
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.ok_durum}}",
                "test": ""
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
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
          "if": "{{insert.affected}}",
          "then": {
            "steps": {
              "name": "insert1",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "mappsTvDB",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "oda_ekran_kullanicilar",
                      "column": "okk_ekranlar_id",
                      "type": "number",
                      "value": "{{$_POST.okk_ekranlar_id}}"
                    },
                    {
                      "table": "oda_ekran_kullanicilar",
                      "column": "okk_oda_kullanicilar_id",
                      "type": "number",
                      "value": "{{insert.identity}}"
                    }
                  ],
                  "table": "oda_ekran_kullanicilar",
                  "returning": "okk_id",
                  "query": "INSERT INTO oda_ekran_kullanicilar\n(okk_ekranlar_id, okk_oda_kullanicilar_id) VALUES (:P1 /* {{$_POST.okk_ekranlar_id}} */, :P2 /* {{insert.identity}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.okk_ekranlar_id}}",
                      "test": ""
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{insert.identity}}",
                      "test": ""
                    }
                  ]
                }
              },
              "meta": [
                {
                  "name": "identity",
                  "type": "text"
                },
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