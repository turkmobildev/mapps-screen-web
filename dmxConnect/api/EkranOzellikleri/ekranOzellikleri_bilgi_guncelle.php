<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/spa/ekran_detay.html",
      "linkedForm": "serverconnectform1"
    },
    "$_POST": [
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
        "type": "number",
        "fieldName": "kyo_id",
        "name": "kyo_id"
      },
      {
        "type": "text",
        "fieldName": "selectFontSizeOdaAdi",
        "name": "selectFontSizeOdaAdi"
      },
      {
        "type": "text",
        "fieldName": "selectRenkOdaAdi",
        "name": "selectRenkOdaAdi"
      },
      {
        "type": "text",
        "fieldName": "selectFontSizeBirimAdi",
        "name": "selectFontSizeBirimAdi"
      },
      {
        "type": "text",
        "fieldName": "selectRenkBirimAdi",
        "name": "selectRenkBirimAdi"
      },
      {
        "type": "text",
        "fieldName": "selectFontSizeUnvan",
        "name": "selectFontSizeUnvan"
      },
      {
        "type": "text",
        "fieldName": "selectRenkUnvan",
        "name": "selectRenkUnvan"
      },
      {
        "type": "text",
        "fieldName": "selectFontSizeAdSoyad",
        "name": "selectFontSizeAdSoyad"
      },
      {
        "type": "text",
        "fieldName": "selectRenkAdSoyad",
        "name": "selectRenkAdSoyad"
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
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeOdaAdi",
              "type": "text",
              "value": "{{$_POST.selectFontSizeOdaAdi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkOdaAdi",
              "type": "text",
              "value": "{{$_POST.selectRenkOdaAdi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeBirimAdi",
              "type": "text",
              "value": "{{$_POST.selectFontSizeBirimAdi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkBirimAdi",
              "type": "text",
              "value": "{{$_POST.selectRenkBirimAdi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeUnvan",
              "type": "text",
              "value": "{{$_POST.selectFontSizeUnvan}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkUnvan",
              "type": "text",
              "value": "{{$_POST.selectRenkUnvan}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeAdSoyad",
              "type": "text",
              "value": "{{$_POST.selectFontSizeAdSoyad}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkAdSoyad",
              "type": "text",
              "value": "{{$_POST.selectRenkAdSoyad}}"
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
                "value": "{{$_POST.kyo_id}}",
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
          "query": "UPDATE kurum_yerleskeler_oda\nSET kyo_oda_adi = :P1 /* {{$_POST.kyo_oda_adi}} */, kyo_birim_adi = :P2 /* {{$_POST.kyo_birim_adi}} */, kyo_unvan = :P3 /* {{$_POST.kyo_unvan}} */, kyo_kisi_ad_soyad = :P4 /* {{$_POST.kyo_kisi_ad_soyad}} */, selectFontSizeOdaAdi = :P5 /* {{$_POST.selectFontSizeOdaAdi}} */, selectRenkOdaAdi = :P6 /* {{$_POST.selectRenkOdaAdi}} */, selectFontSizeBirimAdi = :P7 /* {{$_POST.selectFontSizeBirimAdi}} */, selectRenkBirimAdi = :P8 /* {{$_POST.selectRenkBirimAdi}} */, selectFontSizeUnvan = :P9 /* {{$_POST.selectFontSizeUnvan}} */, selectRenkUnvan = :P10 /* {{$_POST.selectRenkUnvan}} */, selectFontSizeAdSoyad = :P11 /* {{$_POST.selectFontSizeAdSoyad}} */, selectRenkAdSoyad = :P12 /* {{$_POST.selectRenkAdSoyad}} */\nWHERE kyo_id = :P13 /* {{$_POST.kyo_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.kyo_oda_adi}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.kyo_birim_adi}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.kyo_unvan}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.kyo_kisi_ad_soyad}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.selectFontSizeOdaAdi}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.selectRenkOdaAdi}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.selectFontSizeBirimAdi}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.selectRenkBirimAdi}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.selectFontSizeUnvan}}",
              "test": ""
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.selectRenkUnvan}}",
              "test": ""
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.selectFontSizeAdSoyad}}",
              "test": ""
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.selectRenkAdSoyad}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P13",
              "value": "{{$_POST.kyo_id}}",
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