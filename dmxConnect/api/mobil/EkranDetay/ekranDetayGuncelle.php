<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "odaYerleskeId"
      },
      {
        "type": "text",
        "name": "odaId"
      },
      {
        "type": "text",
        "name": "odaEkranId"
      },
      {
        "type": "text",
        "name": "odaAdSoyad"
      },
      {
        "type": "text",
        "name": "odaOdaAdi"
      },
      {
        "type": "text",
        "name": "odaBirimAdi"
      },
      {
        "type": "text",
        "name": "odaUnvan"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "updateEkranDetay",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_oda_adi",
              "type": "text",
              "value": "{{$_POST.odaOdaAdi}}",
              "condition": "{{$_POST.odaOdaAdi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_kisi_ad_soyad",
              "type": "text",
              "value": "{{$_POST.odaAdSoyad}}",
              "condition": "{{$_POST.odaAdSoyad}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_birim_adi",
              "type": "text",
              "value": "{{$_POST.odaBirimAdi}}",
              "condition": "{{$_POST.odaBirimAdi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_unvan",
              "type": "text",
              "value": "{{$_POST.odaUnvan}}",
              "condition": "{{$_POST.odaUnvan}}"
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
                "value": "{{$_POST.odaId}}",
                "data": {
                  "column": "kyo_id"
                },
                "operation": "="
              },
              {
                "id": "kyo_yerleske_id",
                "field": "kyo_yerleske_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.odaYerleskeId}}",
                "data": {
                  "column": "kyo_yerleske_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "kyo_id",
          "query": "UPDATE kurum_yerleskeler_oda\nSET kyo_oda_adi = :P1 /* {{$_POST.odaOdaAdi}} */, kyo_kisi_ad_soyad = :P2 /* {{$_POST.odaAdSoyad}} */, kyo_birim_adi = :P3 /* {{$_POST.odaBirimAdi}} */, kyo_unvan = :P4 /* {{$_POST.odaUnvan}} */\nWHERE kyo_id = :P5 /* {{$_POST.odaId}} */ AND kyo_yerleske_id = :P6 /* {{$_POST.odaYerleskeId}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.odaOdaAdi}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.odaAdSoyad}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.odaBirimAdi}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.odaUnvan}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
              "value": "{{$_POST.odaId}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P6",
              "value": "{{$_POST.odaYerleskeId}}",
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