<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/spa/ekran-guncelle.html",
      "linkedForm": "formEkranGuncelle"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "oeo_device_no",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            }
          }
        },
        "name": "oeo_device_no"
      },
      {
        "type": "text",
        "fieldName": "oeo_ekran_ip",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            },
            "core:ipv4": {
              "param": "",
              "message": "Lütfen geçerli bir IP adresi giriniz."
            }
          }
        },
        "name": "oeo_ekran_ip"
      },
      {
        "type": "text",
        "fieldName": "oeo_hava_durumu",
        "name": "oeo_hava_durumu"
      },
      {
        "type": "text",
        "fieldName": "oeo_tarih_saat",
        "name": "oeo_tarih_saat"
      },
      {
        "type": "text",
        "fieldName": "oeo_durum",
        "name": "oeo_durum"
      },
      {
        "type": "text",
        "fieldName": "oeo_ad_soyad_bilgisi",
        "name": "oeo_ad_soyad_bilgisi"
      },
      {
        "type": "text",
        "fieldName": "oeo_unvan_goster",
        "name": "oeo_unvan_goster"
      },
      {
        "type": "text",
        "fieldName": "oe_yerleske_id",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            }
          }
        },
        "name": "oe_yerleske_id"
      },
      {
        "type": "text",
        "fieldName": "oe_oda_id",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            }
          }
        },
        "name": "oe_oda_id"
      },
      {
        "type": "text",
        "fieldName": "oe_oda_tip_id",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur ."
            }
          }
        },
        "name": "oe_oda_tip_id"
      },
      {
        "type": "text",
        "fieldName": "ozellikRowId",
        "name": "ozellikRowId"
      },
      {
        "type": "boolean",
        "name": "oeo_oda_adi_goster"
      },
      {
        "type": "boolean",
        "name": "oeo_kurum_logo"
      },
      {
        "type": "number",
        "name": "oeo_ekran_renk_id"
      },
      {
        "type": "boolean",
        "name": "oeo_birim_adi_goster"
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
              "column": "oeo_device_no",
              "type": "text",
              "value": "{{$_POST.oeo_device_no}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_ekran_ip",
              "type": "text",
              "value": "{{$_POST.oeo_ekran_ip}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_yerleske_id",
              "type": "number",
              "value": "{{$_POST.oe_yerleske_id}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_tarih_saat",
              "type": "boolean",
              "value": "{{$_POST.oeo_tarih_saat == 1 ? 1 : 0}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_ad_soyad_bilgisi",
              "type": "boolean",
              "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1 : 0}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_unvan_goster",
              "type": "boolean",
              "value": "{{$_POST.oeo_unvan_goster == 1 ? 1 : 0}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_durum",
              "type": "boolean",
              "value": "{{$_POST.oeo_durum == 1 ? 1 : 0}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_hava_durumu",
              "type": "boolean",
              "value": "{{$_POST.oeo_hava_durumu == 1 ? 1 : 0}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_oda_adi_goster",
              "type": "boolean",
              "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_kurum_logo",
              "type": "boolean",
              "value": "{{$_POST.oeo_kurum_logo == 1 ? 1 : 0}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_ekran_renk_id",
              "type": "number",
              "value": "{{$_POST.oeo_ekran_renk_id}}"
            },
            {
              "table": "oda_ekran_ozellikleri",
              "column": "oeo_birim_adi_goster",
              "type": "boolean",
              "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1 : 0}}"
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
                "value": "{{$_POST.ozellikRowId}}",
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
          "query": "UPDATE oda_ekran_ozellikleri\nSET oeo_device_no = :P1 /* {{$_POST.oeo_device_no}} */, oeo_ekran_ip = :P2 /* {{$_POST.oeo_ekran_ip}} */, oeo_yerleske_id = :P3 /* {{$_POST.oe_yerleske_id}} */, oeo_tarih_saat = :P4 /* {{$_POST.oeo_tarih_saat == 1 ? 1 : 0}} */, oeo_ad_soyad_bilgisi = :P5 /* {{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1 : 0}} */, oeo_unvan_goster = :P6 /* {{$_POST.oeo_unvan_goster == 1 ? 1 : 0}} */, oeo_durum = :P7 /* {{$_POST.oeo_durum == 1 ? 1 : 0}} */, oeo_hava_durumu = :P8 /* {{$_POST.oeo_hava_durumu == 1 ? 1 : 0}} */, oeo_oda_adi_goster = :P9 /* {{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}} */, oeo_kurum_logo = :P10 /* {{$_POST.oeo_kurum_logo == 1 ? 1 : 0}} */, oeo_ekran_renk_id = :P11 /* {{$_POST.oeo_ekran_renk_id}} */, oeo_birim_adi_goster = :P12 /* {{$_POST.oeo_birim_adi_goster == 1 ? 1 : 0}} */\nWHERE oeo_id = :P13 /* {{$_POST.ozellikRowId}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.oeo_device_no}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.oeo_ekran_ip}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.oe_yerleske_id}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.oeo_tarih_saat == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.oeo_unvan_goster == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.oeo_durum == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.oeo_hava_durumu == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.oeo_kurum_logo == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.oeo_ekran_renk_id}}",
              "test": ""
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1 : 0}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P13",
              "value": "{{$_POST.ozellikRowId}}",
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