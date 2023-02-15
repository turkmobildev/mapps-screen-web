<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "oda_id"
      },
      {
        "type": "text",
        "name": "oda_kat_bilgisi"
      },
      {
        "type": "text",
        "name": "oda_oda_adi"
      },
      {
        "type": "text",
        "name": "oda_oda_adi_fs"
      },
      {
        "type": "text",
        "name": "oda_oda_adi_yr"
      },
      {
        "type": "text",
        "name": "oda_birim_adi"
      },
      {
        "type": "text",
        "name": "oda_ad_soyad"
      },
      {
        "type": "text",
        "name": "oda_ad_soyad_fs"
      },
      {
        "type": "text",
        "name": "oda_ad_soyad_yr"
      },
      {
        "type": "text",
        "name": "oda_unvan"
      },
      {
        "type": "text",
        "name": "oda_unvan_fs"
      },
      {
        "type": "text",
        "name": "oda_unvan_yr"
      },
      {
        "type": "text",
        "name": "oda_birim_adi_fs"
      },
      {
        "type": "text",
        "name": "oda_birim_adi_yr"
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
              "column": "kyo_kisi_ad_soyad",
              "type": "text",
              "value": "{{$_POST.oda_ad_soyad}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeAdSoyad",
              "type": "text",
              "value": "{{$_POST.oda_ad_soyad_fs}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkAdSoyad",
              "type": "text",
              "value": "{{$_POST.oda_ad_soyad_yr}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_unvan",
              "type": "text",
              "value": "{{$_POST.oda_unvan}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeUnvan",
              "type": "text",
              "value": "{{$_POST.oda_unvan_fs}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkUnvan",
              "type": "text",
              "value": "{{$_POST.oda_unvan_yr}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_birim_adi",
              "type": "text",
              "value": "{{$_POST.oda_birim_adi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeBirimAdi",
              "type": "text",
              "value": "{{$_POST.oda_birim_adi_fs}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkBirimAdi",
              "type": "text",
              "value": "{{$_POST.oda_birim_adi_yr}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_oda_adi",
              "type": "text",
              "value": "{{$_POST.oda_oda_adi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectFontSizeOdaAdi",
              "type": "text",
              "value": "{{$_POST.oda_oda_adi_fs}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "selectRenkOdaAdi",
              "type": "text",
              "value": "{{$_POST.oda_oda_adi_yr}}"
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
                "value": "{{$_POST.oda_id}}",
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
          "query": "UPDATE kurum_yerleskeler_oda\nSET kyo_kisi_ad_soyad = :P1 /* {{$_POST.oda_ad_soyad}} */, selectFontSizeAdSoyad = :P2 /* {{$_POST.oda_ad_soyad_fs}} */, selectRenkAdSoyad = :P3 /* {{$_POST.oda_ad_soyad_yr}} */, kyo_unvan = :P4 /* {{$_POST.oda_unvan}} */, selectFontSizeUnvan = :P5 /* {{$_POST.oda_unvan_fs}} */, selectRenkUnvan = :P6 /* {{$_POST.oda_unvan_yr}} */, kyo_birim_adi = :P7 /* {{$_POST.oda_birim_adi}} */, selectFontSizeBirimAdi = :P8 /* {{$_POST.oda_birim_adi_fs}} */, selectRenkBirimAdi = :P9 /* {{$_POST.oda_birim_adi_yr}} */, kyo_oda_adi = :P10 /* {{$_POST.oda_oda_adi}} */, selectFontSizeOdaAdi = :P11 /* {{$_POST.oda_oda_adi_fs}} */, selectRenkOdaAdi = :P12 /* {{$_POST.oda_oda_adi_yr}} */\nWHERE kyo_id = :P13 /* {{$_POST.oda_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.oda_ad_soyad}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.oda_ad_soyad_fs}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.oda_ad_soyad_yr}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.oda_unvan}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.oda_unvan_fs}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.oda_unvan_yr}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.oda_birim_adi}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.oda_birim_adi_fs}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.oda_birim_adi_yr}}",
              "test": ""
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.oda_oda_adi}}",
              "test": ""
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.oda_oda_adi_fs}}",
              "test": ""
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.oda_oda_adi_yr}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P13",
              "value": "{{$_POST.oda_id}}",
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