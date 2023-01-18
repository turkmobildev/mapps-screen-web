<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "oe_oda_id"
      },
      {
        "type": "number",
        "name": "oe_yerleske_id"
      },
      {
        "type": "number",
        "name": "oe_oda_tip_id"
      },
      {
        "type": "text",
        "name": "oeo_device_no"
      },
      {
        "type": "text",
        "name": "oeo_ekran_ip"
      },
      {
        "type": "boolean",
        "name": "oeo_hava_durumu"
      },
      {
        "type": "datetime",
        "name": "oeo_tarih_saat"
      },
      {
        "type": "number",
        "name": "oeo_durum"
      },
      {
        "type": "number",
        "name": "oeo_ad_soyad_bilgisi"
      },
      {
        "type": "boolean",
        "name": "oeo_unvan_goster"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "insertEkranEkle",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "oda_ekran",
                "column": "oe_oda_id",
                "type": "number",
                "value": "{{$_POST.oe_oda_id}}"
              },
              {
                "table": "oda_ekran",
                "column": "oe_yerleske_id",
                "type": "number",
                "value": "{{$_POST.oe_yerleske_id}}"
              },
              {
                "table": "oda_ekran",
                "column": "oe_oda_tip_id",
                "type": "number",
                "value": "{{$_POST.oe_oda_tip_id}}"
              }
            ],
            "table": "oda_ekran",
            "returning": "oe_id",
            "query": "INSERT INTO oda_ekran\n(oe_oda_id, oe_yerleske_id, oe_oda_tip_id) VALUES (:P1 /* {{$_POST.oe_oda_id}} */, :P2 /* {{$_POST.oe_yerleske_id}} */, :P3 /* {{$_POST.oe_oda_tip_id}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.oe_oda_id}}",
                "test": ""
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.oe_yerleske_id}}",
                "test": ""
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.oe_oda_tip_id}}",
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
          "if": "{{insertEkranEkle.affected}}",
          "then": {
            "steps": {
              "name": "insertEkranStandartOda",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "mappsTvDB",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "oda_ekran_ozellikleri",
                      "column": "oeo_oda_id",
                      "type": "number",
                      "value": "{{$_POST.oe_oda_id}}"
                    },
                    {
                      "table": "oda_ekran_ozellikleri",
                      "column": "oeo_oda_ekran_id",
                      "type": "number",
                      "value": "{{insertEkranEkle.identity}}"
                    },
                    {
                      "table": "oda_ekran_ozellikleri",
                      "column": "oeo_yerleske_id",
                      "type": "number",
                      "value": "{{$_POST.oe_yerleske_id}}"
                    },
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
                      "column": "oeo_hava_durumu",
                      "type": "boolean",
                      "value": "{{$_POST.oeo_hava_durumu == 1 ? 0:1}}"
                    },
                    {
                      "table": "oda_ekran_ozellikleri",
                      "column": "oeo_tarih_saat",
                      "type": "datetime",
                      "value": "{{$_POST.oeo_tarih_saat == 1 ? 1:0}}"
                    },
                    {
                      "table": "oda_ekran_ozellikleri",
                      "column": "oeo_durum",
                      "type": "number",
                      "value": "{{$_POST.oeo_durum == 1 ? 1:0}}"
                    },
                    {
                      "table": "oda_ekran_ozellikleri",
                      "column": "oeo_ad_soyad_bilgisi",
                      "type": "number",
                      "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}}"
                    },
                    {
                      "table": "oda_ekran_ozellikleri",
                      "column": "oeo_unvan_goster",
                      "type": "boolean",
                      "value": "{{$_POST.oeo_unvan_goster}}"
                    }
                  ],
                  "table": "oda_ekran_ozellikleri",
                  "returning": "oeo_id",
                  "query": "INSERT INTO oda_ekran_ozellikleri\n(oeo_oda_id, oeo_oda_ekran_id, oeo_yerleske_id, oeo_device_no, oeo_ekran_ip, oeo_hava_durumu, oeo_tarih_saat, oeo_durum, oeo_ad_soyad_bilgisi, oeo_unvan_goster) VALUES (:P1 /* {{$_POST.oe_oda_id}} */, :P2 /* {{insertEkranEkle.identity}} */, :P3 /* {{$_POST.oe_yerleske_id}} */, :P4 /* {{$_POST.oeo_device_no}} */, :P5 /* {{$_POST.oeo_ekran_ip}} */, :P6 /* {{$_POST.oeo_hava_durumu == 1 ? 0:1}} */, :P7 /* {{$_POST.oeo_tarih_saat == 1 ? 1:0}} */, :P8 /* {{$_POST.oeo_durum == 1 ? 1:0}} */, :P9 /* {{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}} */, :P10 /* {{$_POST.oeo_unvan_goster}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.oe_oda_id}}",
                      "test": ""
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{insertEkranEkle.identity}}",
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
                      "value": "{{$_POST.oeo_device_no}}",
                      "test": ""
                    },
                    {
                      "name": ":P5",
                      "type": "expression",
                      "value": "{{$_POST.oeo_ekran_ip}}",
                      "test": ""
                    },
                    {
                      "name": ":P6",
                      "type": "expression",
                      "value": "{{$_POST.oeo_hava_durumu == 1 ? 0:1}}",
                      "test": ""
                    },
                    {
                      "name": ":P7",
                      "type": "expression",
                      "value": "{{$_POST.oeo_tarih_saat == 1 ? 1:0}}",
                      "test": ""
                    },
                    {
                      "name": ":P8",
                      "type": "expression",
                      "value": "{{$_POST.oeo_durum == 1 ? 1:0}}",
                      "test": ""
                    },
                    {
                      "name": ":P9",
                      "type": "expression",
                      "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}}",
                      "test": ""
                    },
                    {
                      "name": ":P10",
                      "type": "expression",
                      "value": "{{$_POST.oeo_unvan_goster}}",
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