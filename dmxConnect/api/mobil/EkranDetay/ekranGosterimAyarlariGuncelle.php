<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "ipAdresi"
      },
      {
        "type": "text",
        "name": "oda_id"
      },
      {
        "type": "text",
        "name": "hava_durumu"
      },
      {
        "type": "text",
        "name": "ad_soyad"
      },
      {
        "type": "text",
        "name": "birim_adi"
      },
      {
        "type": "text",
        "name": "kisi_unvan"
      },
      {
        "type": "text",
        "name": "oda_adi"
      },
      {
        "type": "text",
        "name": "oda_durum_bilgisi"
      },
      {
        "type": "text",
        "name": "kurum_logo"
      },
      {
        "type": "text",
        "name": "tarih_saat"
      }
    ]
  },
  "exec": {
    "steps": [
      {
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
                "column": "oeo_hava_durumu",
                "type": "boolean",
                "value": "{{$_POST.hava_durumu == true ? 1 : 0}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_ad_soyad_bilgisi",
                "type": "boolean",
                "value": "{{$_POST.ad_soyad == true ? 1 : 0}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_birim_adi_goster",
                "type": "boolean",
                "value": "{{$_POST.birim_adi == true ? 1 : 0}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_unvan_goster",
                "type": "boolean",
                "value": "{{$_POST.kisi_unvan == true ? 1 : 0}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_oda_adi_goster",
                "type": "boolean",
                "value": "{{$_POST.oda_adi == true ? 1 : 0}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_durum",
                "type": "boolean",
                "value": "{{$_POST.oda_durum_bilgisi == true ? 1 : 0}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_kurum_logo",
                "type": "boolean",
                "value": "{{$_POST.kurum_logo == true ? 1 : 0}}"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "oeo_tarih_saat",
                "type": "boolean",
                "value": "{{$_POST.tarih_saat == true ? 1 : 0}}"
              }
            ],
            "table": "oda_ekran_ozellikleri",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "oeo_oda_id",
                  "field": "oeo_oda_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.oda_id}}",
                  "data": {
                    "column": "oeo_oda_id"
                  },
                  "operation": "="
                },
                {
                  "id": "oeo_ekran_ip",
                  "field": "oeo_ekran_ip",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.ipAdresi}}",
                  "data": {
                    "column": "oeo_ekran_ip"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "oeo_id",
            "query": "UPDATE oda_ekran_ozellikleri\nSET oeo_hava_durumu = :P1 /* {{$_POST.hava_durumu == true ? 1 : 0}} */, oeo_ad_soyad_bilgisi = :P2 /* {{$_POST.ad_soyad == true ? 1 : 0}} */, oeo_birim_adi_goster = :P3 /* {{$_POST.birim_adi == true ? 1 : 0}} */, oeo_unvan_goster = :P4 /* {{$_POST.kisi_unvan == true ? 1 : 0}} */, oeo_oda_adi_goster = :P5 /* {{$_POST.oda_adi == true ? 1 : 0}} */, oeo_durum = :P6 /* {{$_POST.oda_durum_bilgisi == true ? 1 : 0}} */, oeo_kurum_logo = :P7 /* {{$_POST.kurum_logo == true ? 1 : 0}} */, oeo_tarih_saat = :P8 /* {{$_POST.tarih_saat == true ? 1 : 0}} */\nWHERE oeo_oda_id = :P9 /* {{$_POST.oda_id}} */ AND oeo_ekran_ip = :P10 /* {{$_POST.ipAdresi}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.hava_durumu == true ? 1 : 0}}",
                "test": ""
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.ad_soyad == true ? 1 : 0}}",
                "test": ""
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.birim_adi == true ? 1 : 0}}",
                "test": ""
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.kisi_unvan == true ? 1 : 0}}",
                "test": ""
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.oda_adi == true ? 1 : 0}}",
                "test": ""
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.oda_durum_bilgisi == true ? 1 : 0}}",
                "test": ""
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.kurum_logo == true ? 1 : 0}}",
                "test": ""
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.tarih_saat == true ? 1 : 0}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P9",
                "value": "{{$_POST.oda_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P10",
                "value": "{{$_POST.ipAdresi}}",
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
        ],
        "output": true
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{update.affected}}",
          "then": {
            "steps": {
              "name": "responce",
              "module": "core",
              "action": "response",
              "options": {
                "status": 200,
                "data": "updated"
              },
              "output": true
            }
          },
          "else": {
            "steps": {
              "name": "responce",
              "module": "core",
              "action": "response",
              "options": {
                "status": 400,
                "data": "Bad request"
              },
              "output": true
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