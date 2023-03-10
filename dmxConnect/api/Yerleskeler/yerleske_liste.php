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
        "name": "queryYerleskeListe",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "kurum_yerleskeler",
                "column": "*"
              }
            ],
            "params": [],
            "table": {
              "name": "kurum_yerleskeler"
            },
            "joins": [],
            "query": "SELECT *\nFROM kurum_yerleskeler",
            "primary": "yerleske_id"
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
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{queryYerleskeListe}}",
          "outputFields": [
            "yerleske_adi",
            "yerleske_id"
          ],
          "exec": {
            "steps": {
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
                      "column": "kyo_oda_adi"
                    },
                    {
                      "table": "kurum_yerleskeler_oda",
                      "column": "kyo_oda_tip"
                    }
                  ],
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{yerleske_id}}",
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
                        "id": "kurum_yerleskeler_oda.kyo_yerleske_id",
                        "field": "kurum_yerleskeler_oda.kyo_yerleske_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{yerleske_id}}",
                        "data": {
                          "table": "kurum_yerleskeler_oda",
                          "column": "kyo_yerleske_id",
                          "type": "number",
                          "columnObj": {
                            "type": "integer",
                            "primary": false,
                            "nullable": false,
                            "default": "",
                            "name": "kyo_yerleske_id"
                          }
                        },
                        "operation": "=",
                        "table": "kurum_yerleskeler_oda"
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "SELECT kyo_id, kyo_yerleske_id, kyo_kat_bilgisi, kyo_oda_adi, kyo_oda_tip\nFROM kurum_yerleskeler_oda\nWHERE kyo_yerleske_id = :P1 /* {{yerleske_id}} */"
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
          }
        },
        "output": true,
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
          {
            "name": "yerleske_id",
            "type": "number"
          },
          {
            "name": "yerleske_adi",
            "type": "text"
          },
          {
            "name": "queryOdalar",
            "type": "array",
            "sub": [
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
            ]
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