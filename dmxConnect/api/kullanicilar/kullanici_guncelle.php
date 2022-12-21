<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "kullanici_adi_soyadi"
      },
      {
        "type": "text",
        "name": "kullanici_unvan"
      },
      {
        "type": "text",
        "name": "kullanici_telefon"
      },
      {
        "type": "text",
        "name": "kullanici_eposta"
      },
      {
        "type": "number",
        "name": "kullanici_durum"
      },
      {
        "type": "number",
        "name": "kullanici_tipi"
      },
      {
        "type": "number",
        "name": "kullanici_id"
      }
    ]
  },
  "exec": {
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
              "column": "ok_unvan",
              "type": "text",
              "value": "{{$_POST.kullanici_unvan}}"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_ad_soyad",
              "type": "text",
              "value": "{{$_POST.kullanici_adi_soyadi}}"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_eposta",
              "type": "text",
              "value": "{{$_POST.kullanici_eposta}}"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_durum",
              "type": "number",
              "value": "{{$_POST.kullanici_durum ? 1 : 0}}"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_telefon",
              "type": "text",
              "value": "{{$_POST.kullanici_telefon}}"
            },
            {
              "table": "oda_kullanicilar",
              "column": "ok_tip",
              "type": "number",
              "value": "{{$_POST.kullanici_tipi == 1 ? 1:0}}"
            }
          ],
          "table": "oda_kullanicilar",
          "returning": "ok_id",
          "query": "UPDATE oda_kullanicilar\nSET ok_unvan = :P1 /* {{$_POST.kullanici_unvan}} */, ok_ad_soyad = :P2 /* {{$_POST.kullanici_adi_soyadi}} */, ok_eposta = :P3 /* {{$_POST.kullanici_eposta}} */, ok_durum = :P4 /* {{$_POST.kullanici_durum ? 1 : 0}} */, ok_telefon = :P5 /* {{$_POST.kullanici_telefon}} */, ok_tip = :P6 /* {{$_POST.kullanici_tipi == 1 ? 1:0}} */\nWHERE ok_id = :P7 /* {{$_POST.kullanici_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.kullanici_unvan}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.kullanici_adi_soyadi}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.kullanici_eposta}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.kullanici_durum ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.kullanici_telefon}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.kullanici_tipi == 1 ? 1:0}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P7",
              "value": "{{$_POST.kullanici_id}}",
              "test": ""
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "ok_id",
                "field": "ok_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.kullanici_id}}",
                "data": {
                  "column": "ok_id"
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
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>