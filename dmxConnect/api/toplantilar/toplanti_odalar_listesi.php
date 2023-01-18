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
    "steps": [
      {
        "name": "queryYerleskeler",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "params": [],
            "table": {
              "name": "kurum_yerleskeler"
            },
            "primary": "yerleske_id",
            "joins": [],
            "query": "SELECT *\nFROM kurum_yerleskeler"
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
          }
        ],
        "outputType": "array"
      },
      {
        "name": "queryOdalar",
        "module": "dbconnector",
        "action": "select",
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
            "params": [],
            "table": {
              "name": "kurum_yerleskeler_oda"
            },
            "primary": "kyo_id",
            "joins": [],
            "query": "SELECT *\nFROM kurum_yerleskeler_oda\nWHERE kyo_oda_tip = 1",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "kurum_yerleskeler_oda.kyo_oda_tip",
                  "field": "kurum_yerleskeler_oda.kyo_oda_tip",
                  "type": "double",
                  "operator": "equal",
                  "value": 1,
                  "data": {
                    "table": "kurum_yerleskeler_oda",
                    "column": "kyo_oda_tip",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "default": "",
                      "primary": false,
                      "nullable": true,
                      "name": "kyo_oda_tip"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            }
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
            "type": "text",
            "name": "kyo_oda_adi"
          },
          {
            "type": "number",
            "name": "kyo_oda_tip"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>