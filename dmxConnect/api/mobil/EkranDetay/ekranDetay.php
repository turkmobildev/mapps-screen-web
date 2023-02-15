<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "odaid"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "queryEkranDetayi",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "oda_ekran_ozellikleri",
                "column": "*"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.odaid}}",
                "test": "17"
              }
            ],
            "table": {
              "name": "oda_ekran_ozellikleri"
            },
            "primary": "oeo_id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "oda_ekran_ozellikleri.oeo_oda_id",
                  "field": "oda_ekran_ozellikleri.oeo_oda_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.odaid}}",
                  "data": {
                    "table": "oda_ekran_ozellikleri",
                    "column": "oeo_oda_id",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "default": "0",
                      "primary": false,
                      "nullable": true,
                      "name": "oeo_oda_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT *\nFROM oda_ekran_ozellikleri\nWHERE oeo_oda_id = :P1 /* {{$_GET.odaid}} */"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "oeo_id"
          },
          {
            "type": "number",
            "name": "oeo_oda_id"
          },
          {
            "type": "number",
            "name": "oeo_yerleske_id"
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
            "type": "boolean",
            "name": "oeo_hava_durumu"
          },
          {
            "type": "text",
            "name": "oeo_toplanti_konu"
          },
          {
            "type": "datetime",
            "name": "oeo_toplanti_baslangic"
          },
          {
            "type": "datetime",
            "name": "oeo_toplanti_bitis"
          },
          {
            "type": "text",
            "name": "oeo_toplanti_katilimci_listesi"
          },
          {
            "type": "boolean",
            "name": "oeo_kurum_logo"
          },
          {
            "type": "boolean",
            "name": "oeo_oda_adi_goster"
          },
          {
            "type": "text",
            "name": "oeo_font_size"
          },
          {
            "type": "boolean",
            "name": "oeo_birim_adi_goster"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "queryEkranIcerikDetayi",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_id"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_yerleske_id"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_kat_bilgisi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_oda_tip"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_ekran_tipi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_oda_adi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectFontSizeOdaAdi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "selectRenkOdaAdi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_birim_adi"
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
                "column": "kyo_unvan"
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
                "column": "kyo_kisi_ad_soyad"
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
                "value": "{{queryEkranDetayi.oeo_oda_id}}",
                "test": ""
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
                  "value": "{{queryEkranDetayi.oeo_oda_id}}",
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
            "query": "SELECT kyo_id, kyo_yerleske_id, kyo_kat_bilgisi, kyo_oda_tip, kyo_ekran_tipi, kyo_oda_adi, selectFontSizeOdaAdi, selectRenkOdaAdi, kyo_birim_adi, selectFontSizeBirimAdi, selectRenkBirimAdi, kyo_unvan, selectFontSizeUnvan, selectRenkUnvan, kyo_kisi_ad_soyad, selectFontSizeAdSoyad, selectRenkAdSoyad\nFROM kurum_yerleskeler_oda\nWHERE kyo_id = :P1 /* {{queryEkranDetayi.oeo_oda_id}} */"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "kyo_id"
          },
          {
            "type": "number",
            "name": "kyo_yerleske_id"
          },
          {
            "type": "text",
            "name": "kyo_kat_bilgisi"
          },
          {
            "type": "number",
            "name": "kyo_oda_tip"
          },
          {
            "type": "number",
            "name": "kyo_ekran_tipi"
          },
          {
            "type": "text",
            "name": "kyo_oda_adi"
          },
          {
            "type": "text",
            "name": "selectFontSizeOdaAdi"
          },
          {
            "type": "text",
            "name": "selectRenkOdaAdi"
          },
          {
            "type": "text",
            "name": "kyo_birim_adi"
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
            "name": "kyo_unvan"
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
            "name": "kyo_kisi_ad_soyad"
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