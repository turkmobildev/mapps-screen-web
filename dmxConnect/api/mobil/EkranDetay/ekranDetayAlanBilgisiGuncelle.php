<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "oeo_hava_durumu"
      },
      {
        "type": "text",
        "name": "oeo_ad_soyad_bilgisi"
      },
      {
        "type": "text",
        "name": "sw_oeo_tarih_saat"
      },
      {
        "type": "text",
        "name": "oeo_birim_adi_goster"
      },
      {
        "type": "text",
        "name": "oeo_unvan_goster"
      },
      {
        "type": "text",
        "name": "oeo_oda_adi_goster"
      },
      {
        "type": "text",
        "name": "oeo_durum"
      },
      {
        "type": "text",
        "name": "oeo_kurum_logo"
      },
      {
        "type": "text",
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
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_oda_adi_goster",
              "type": "boolean",
              "value": "{{$_POST.oeo_oda_adi_goster}}"
            }
          ],
          "table": "oda_ekran_ozellikleri",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "oeo_id",
                "field": "oeo_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.odaid}}",
                "data": {
                  "column": "oeo_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "oeo_id",
          "query": "UPDATE oda_ekran_ozellikleri\nSET oeo_oda_adi_goster = :P1 /* {{$_POST.oeo_oda_adi_goster}} */\nWHERE oeo_id = :P2 /* {{$_POST.odaid}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.oeo_oda_adi_goster}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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