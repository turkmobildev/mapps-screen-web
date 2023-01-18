<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/spa/oda_guncelle.html",
      "linkedForm": "formOdaGuncelle"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "kyo_yerleske_id",
        "name": "kyo_yerleske_id"
      },
      {
        "type": "text",
        "fieldName": "kyo_kat_bilgisi",
        "name": "kyo_kat_bilgisi"
      },
      {
        "type": "text",
        "fieldName": "kyo_oda_adi",
        "name": "kyo_oda_adi"
      },
      {
        "type": "text",
        "fieldName": "kyo_birim_adi",
        "name": "kyo_birim_adi"
      },
      {
        "type": "text",
        "fieldName": "kyo_unvan",
        "name": "kyo_unvan"
      },
      {
        "type": "text",
        "fieldName": "kyo_kisi_ad_soyad",
        "name": "kyo_kisi_ad_soyad"
      },
      {
        "type": "text",
        "fieldName": "kyo_oda_tip",
        "name": "kyo_oda_tip"
      },
      {
        "type": "text",
        "fieldName": "kyo_ekran_tipi",
        "name": "kyo_ekran_tipi"
      },
      {
        "type": "text",
        "fieldName": "odaid",
        "name": "odaid"
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
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_yerleske_id",
              "type": "number",
              "value": "{{$_POST.kyo_yerleske_id}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_kat_bilgisi",
              "type": "text",
              "value": "{{$_POST.kyo_kat_bilgisi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_oda_tip",
              "type": "number",
              "value": "{{$_POST.kyo_oda_tip}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_ekran_tipi",
              "type": "number",
              "value": "{{$_POST.kyo_ekran_tipi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_oda_adi",
              "type": "text",
              "value": "{{$_POST.kyo_oda_adi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_birim_adi",
              "type": "text",
              "value": "{{$_POST.kyo_birim_adi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_unvan",
              "type": "text",
              "value": "{{$_POST.kyo_unvan}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_kisi_ad_soyad",
              "type": "text",
              "value": "{{$_POST.kyo_kisi_ad_soyad}}"
            }
          ],
          "table": "kurum_yerleskeler_oda",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "kyo_id",
                "field": "kyo_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.odaid}}",
                "data": {
                  "column": "kyo_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "kyo_id",
          "query": "UPDATE kurum_yerleskeler_oda\nSET kyo_yerleske_id = :P1 /* {{$_POST.kyo_yerleske_id}} */, kyo_kat_bilgisi = :P2 /* {{$_POST.kyo_kat_bilgisi}} */, kyo_oda_tip = :P3 /* {{$_POST.kyo_oda_tip}} */, kyo_ekran_tipi = :P4 /* {{$_POST.kyo_ekran_tipi}} */, kyo_oda_adi = :P5 /* {{$_POST.kyo_oda_adi}} */, kyo_birim_adi = :P6 /* {{$_POST.kyo_birim_adi}} */, kyo_unvan = :P7 /* {{$_POST.kyo_unvan}} */, kyo_kisi_ad_soyad = :P8 /* {{$_POST.kyo_kisi_ad_soyad}} */\nWHERE kyo_id = :P9 /* {{$_POST.odaid}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.kyo_yerleske_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.kyo_kat_bilgisi}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.kyo_oda_tip}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.kyo_ekran_tipi}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.kyo_oda_adi}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.kyo_birim_adi}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.kyo_unvan}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.kyo_kisi_ad_soyad}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P9",
              "value": "{{$_POST.odaid}}",
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
}
JSON
);
?>