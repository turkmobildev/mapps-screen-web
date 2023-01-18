<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "kurum_yerleskeler_oda",
              "column": "*"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.id}}",
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
                "value": "{{$_GET.id}}",
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
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM kurum_yerleskeler_oda\nWHERE kyo_id = :P1 /* {{$_GET.id}} */"
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
  }
}
JSON
);
?>