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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "kurum_yerleskeler",
              "column": "yerleske_id"
            },
            {
              "table": "kurum_yerleskeler",
              "column": "yerleske_adi"
            },
            {
              "table": "oda",
              "column": "kyo_id"
            },
            {
              "table": "oda",
              "column": "kyo_yerleske_id"
            },
            {
              "table": "oda",
              "column": "kyo_kat_bilgisi"
            },
            {
              "table": "oda",
              "column": "kyo_oda_adi"
            },
            {
              "table": "oda",
              "column": "kyo_oda_tip"
            },
            {
              "table": "oda",
              "column": "kyo_ekran_tipi"
            },
            {
              "table": "odatip",
              "column": "ot_oda_tip_adi"
            },
            {
              "table": "ekrantipleri",
              "column": "et_adi"
            }
          ],
          "params": [],
          "table": {
            "name": "kurum_yerleskeler"
          },
          "joins": [
            {
              "table": "kurum_yerleskeler_oda",
              "column": "*",
              "alias": "oda",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "oda",
                    "column": "kyo_yerleske_id",
                    "operator": "equal",
                    "value": {
                      "table": "kurum_yerleskeler",
                      "column": "yerleske_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "kyo_id"
            },
            {
              "table": "oda_tipleri",
              "column": "*",
              "alias": "odatip",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "odatip",
                    "column": "ot_oda_id",
                    "operator": "equal",
                    "value": {
                      "table": "oda",
                      "column": "kyo_oda_tip"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "ot_oda_id"
            },
            {
              "table": "oda_ekran_tipleri",
              "column": "*",
              "alias": "ekrantipleri",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "ekrantipleri",
                    "column": "et_id",
                    "operator": "equal",
                    "value": {
                      "table": "oda",
                      "column": "kyo_ekran_tipi"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "et_id"
            }
          ],
          "query": "SELECT kurum_yerleskeler.yerleske_id, kurum_yerleskeler.yerleske_adi, oda.kyo_id, oda.kyo_yerleske_id, oda.kyo_kat_bilgisi, oda.kyo_oda_adi, oda.kyo_oda_tip, oda.kyo_ekran_tipi, odatip.ot_oda_tip_adi, ekrantipleri.et_adi\nFROM kurum_yerleskeler\nLEFT JOIN kurum_yerleskeler_oda AS oda ON oda.kyo_yerleske_id = kurum_yerleskeler.yerleske_id LEFT JOIN oda_tipleri AS odatip ON odatip.ot_oda_id = oda.kyo_oda_tip LEFT JOIN oda_ekran_tipleri AS ekrantipleri ON ekrantipleri.et_id = oda.kyo_ekran_tipi"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "yerleske_id"
        },
        {
          "type": "text",
          "name": "yerleske_adi"
        },
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
          "type": "text",
          "name": "kyo_oda_adi"
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
          "name": "ot_oda_tip_adi"
        },
        {
          "type": "text",
          "name": "et_adi"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>