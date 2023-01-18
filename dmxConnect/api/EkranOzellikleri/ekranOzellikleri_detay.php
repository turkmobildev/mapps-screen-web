<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "ekranid"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "queryEkranOzellikleri",
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
              "value": "{{$_GET.ekranid}}",
              "test": "4"
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
                "value": "{{$_GET.ekranid}}",
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
                "operation": "=",
                "table": "oda_ekran_ozellikleri"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM oda_ekran_ozellikleri\nWHERE oeo_oda_id = :P1 /* {{$_GET.ekranid}} */"
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
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>