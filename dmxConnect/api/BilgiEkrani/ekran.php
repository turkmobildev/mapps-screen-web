<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "ip"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "distinct": false,
            "columns": [
              {
                "table": "ozellikler",
                "column": "oeo_oda_id",
                "field": "ozellikler.oeo_oda_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_oda_ekran_id",
                "field": "ozellikler.oeo_oda_ekran_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_device_no",
                "field": "ozellikler.oeo_device_no"
              },
              {
                "table": "ozellikler",
                "column": "oeo_ekran_renk_id",
                "field": "ozellikler.oeo_ekran_renk_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_ekran_ip",
                "field": "ozellikler.oeo_ekran_ip"
              },
              {
                "table": "ozellikler",
                "column": "oeo_yerleske_id",
                "field": "ozellikler.oeo_yerleske_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_tarih_saat",
                "field": "ozellikler.oeo_tarih_saat"
              },
              {
                "table": "ozellikler",
                "column": "oeo_ad_soyad_bilgisi",
                "field": "ozellikler.oeo_ad_soyad_bilgisi"
              },
              {
                "table": "ozellikler",
                "column": "oeo_unvan_goster",
                "field": "ozellikler.oeo_unvan_goster"
              },
              {
                "table": "ozellikler",
                "column": "oeo_durum",
                "field": "ozellikler.oeo_durum"
              },
              {
                "table": "renk",
                "column": "oer_ad",
                "field": "renk.oer_ad"
              },
              {
                "table": "renk",
                "column": "oer_class",
                "field": "renk.oer_class"
              },
              {
                "table": "renk",
                "column": "oer_id",
                "field": "renk.oer_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_oda_adi_goster",
                "field": "ozellikler.oeo_oda_adi_goster"
              },
              {
                "table": "ozellikler",
                "column": "oeo_hava_durumu",
                "field": "ozellikler.oeo_hava_durumu"
              },
              {
                "table": "ozellikler",
                "column": "oeo_kurum_logo",
                "field": "ozellikler.oeo_kurum_logo"
              },
              {
                "table": "ozellikler",
                "column": "oeo_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_birim_adi_goster"
              }
            ],
            "table": {
              "name": "oda_ekran"
            },
            "joins": [
              {
                "table": "oda_ekran_ozellikleri",
                "column": "*",
                "alias": "ozellikler",
                "type": "INNER",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "ozellikler",
                      "column": "oeo_oda_ekran_id",
                      "field": "ozellikler.oeo_oda_ekran_id",
                      "operation": "=",
                      "operator": "equal",
                      "value": {
                        "table": "oda_ekran",
                        "column": "oe_id",
                        "field": "oda_ekran.oe_id"
                      }
                    }
                  ]
                },
                "primary": "oeo_id"
              },
              {
                "table": "oda_ekran_renk",
                "column": "*",
                "alias": "renk",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "renk",
                      "column": "oer_id",
                      "field": "renk.oer_id",
                      "operation": "=",
                      "operator": "equal",
                      "value": {
                        "table": "ozellikler",
                        "column": "oeo_ekran_renk_id",
                        "field": "ozellikler.oeo_ekran_renk_id"
                      }
                    }
                  ]
                },
                "primary": "oer_id"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "table": "ozellikler",
                  "column": "oeo_ekran_ip",
                  "field": "ozellikler.oeo_ekran_ip",
                  "operation": "=",
                  "operator": "equal",
                  "value": "{{$_GET.ip}}",
                  "id": "ozellikler.oeo_ekran_ip"
                }
              ]
            },
            "orders": [],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.ip}}",
                "test": "192.168.0.6"
              }
            ],
            "primary": "oe_id",
            "query": "SELECT ozellikler.oeo_oda_id, ozellikler.oeo_oda_ekran_id, ozellikler.oeo_device_no, ozellikler.oeo_ekran_renk_id, ozellikler.oeo_ekran_ip, ozellikler.oeo_yerleske_id, ozellikler.oeo_tarih_saat, ozellikler.oeo_ad_soyad_bilgisi, ozellikler.oeo_unvan_goster, ozellikler.oeo_durum, renk.oer_ad, renk.oer_class, renk.oer_id, ozellikler.oeo_oda_adi_goster, ozellikler.oeo_hava_durumu, ozellikler.oeo_kurum_logo, ozellikler.oeo_id, ozellikler.oeo_birim_adi_goster\nFROM oda_ekran\nINNER JOIN oda_ekran_ozellikleri AS ozellikler ON ozellikler.oeo_oda_ekran_id = oda_ekran.oe_id LEFT JOIN oda_ekran_renk AS renk ON renk.oer_id = ozellikler.oeo_ekran_renk_id\nWHERE ozellikler.oeo_ekran_ip = :P1 /* {{$_GET.ip}} */"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "oeo_oda_id"
          },
          {
            "type": "number",
            "name": "oeo_oda_ekran_id"
          },
          {
            "type": "text",
            "name": "oeo_device_no"
          },
          {
            "type": "number",
            "name": "oeo_ekran_renk_id"
          },
          {
            "type": "text",
            "name": "oeo_ekran_ip"
          },
          {
            "type": "number",
            "name": "oeo_yerleske_id"
          },
          {
            "type": "boolean",
            "name": "oeo_tarih_saat"
          },
          {
            "type": "boolean",
            "name": "oeo_ad_soyad_bilgisi"
          },
          {
            "type": "boolean",
            "name": "oeo_unvan_goster"
          },
          {
            "type": "boolean",
            "name": "oeo_durum"
          },
          {
            "type": "text",
            "name": "oer_ad"
          },
          {
            "type": "text",
            "name": "oer_class"
          },
          {
            "type": "number",
            "name": "oer_id"
          },
          {
            "type": "boolean",
            "name": "oeo_oda_adi_goster"
          },
          {
            "type": "boolean",
            "name": "oeo_hava_durumu"
          },
          {
            "type": "boolean",
            "name": "oeo_kurum_logo"
          },
          {
            "type": "number",
            "name": "oeo_id"
          },
          {
            "type": "boolean",
            "name": "oeo_birim_adi_goster"
          }
        ],
        "outputType": "object",
        "type": "dbconnector_single"
      },
      {
        "name": "queryOdaAdi",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_oda_adi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_oda_tip"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_kat_bilgisi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_birim_adi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_unvan"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_kisi_ad_soyad"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectRenkOdaAdi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectFontSizeOdaAdi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectFontSizeBirimAdi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectRenkBirimAdi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectFontSizeUnvan"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectRenkUnvan"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectFontSizeAdSoyad"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectRenkAdSoyad"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{query.oeo_oda_id}}",
                "test": "2"
              }
            ],
            "table": {
              "name": "kurum_yerleskeler_oda"
            },
            "primary": "kyo_id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "kurum_yerleskeler_oda.kyo_id",
                  "field": "kurum_yerleskeler_oda.kyo_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{query.oeo_oda_id}}",
                  "data": {
                    "table": "kurum_yerleskeler_oda",
                    "column": "kyo_id",
                    "type": "number",
                    "columnObj": {
                      "type": "increments",
                      "primary": true,
                      "nullable": false,
                      "name": "kyo_id"
                    }
                  },
                  "operation": "=",
                  "table": "kurum_yerleskeler_oda"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT kyo_oda_adi, kyo_oda_tip, kyo_kat_bilgisi, kyo_birim_adi, kyo_unvan, kyo_kisi_ad_soyad, selectRenkOdaAdi, selectFontSizeOdaAdi, selectFontSizeBirimAdi, selectRenkBirimAdi, selectFontSizeUnvan, selectRenkUnvan, selectFontSizeAdSoyad, selectRenkAdSoyad\nFROM kurum_yerleskeler_oda\nWHERE kyo_id = :P1 /* {{query.oeo_oda_id}} */"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "text",
            "name": "kyo_oda_adi"
          },
          {
            "type": "number",
            "name": "kyo_oda_tip"
          },
          {
            "type": "text",
            "name": "kyo_kat_bilgisi"
          },
          {
            "type": "text",
            "name": "kyo_birim_adi"
          },
          {
            "type": "text",
            "name": "kyo_unvan"
          },
          {
            "type": "text",
            "name": "kyo_kisi_ad_soyad"
          },
          {
            "type": "text",
            "name": "selectRenkOdaAdi"
          },
          {
            "type": "text",
            "name": "selectFontSizeOdaAdi"
          },
          {
            "type": "text",
            "name": "selectFontSizeBirimAdi"
          },
          {
            "type": "text",
            "name": "selectRenkBirimAdi"
          },
          {
            "type": "text",
            "name": "selectFontSizeUnvan"
          },
          {
            "type": "text",
            "name": "selectRenkUnvan"
          },
          {
            "type": "text",
            "name": "selectFontSizeAdSoyad"
          },
          {
            "type": "text",
            "name": "selectRenkAdSoyad"
          }
        ],
        "outputType": "object"
      }
    ]
  }
}
JSON
);
?>