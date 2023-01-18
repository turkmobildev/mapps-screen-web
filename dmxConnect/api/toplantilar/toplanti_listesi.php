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
        "name": "oda_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "queryToplantilar",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "toplanti",
              "column": "*"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.oda_id}}",
              "test": ""
            }
          ],
          "table": {
            "name": "toplanti"
          },
          "primary": "t_id",
          "joins": [],
          "query": "SELECT *\nFROM toplanti\nWHERE t_oda_id = :P1 /* {{$_GET.oda_id}} */",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "toplanti.t_oda_id",
                "field": "toplanti.t_oda_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.oda_id}}",
                "data": {
                  "table": "toplanti",
                  "column": "t_oda_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "default": "",
                    "primary": false,
                    "nullable": true,
                    "name": "t_oda_id"
                  }
                },
                "operation": "=",
                "table": "toplanti"
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
          "name": "t_id"
        },
        {
          "type": "number",
          "name": "t_oda_id"
        },
        {
          "type": "text",
          "name": "t_konu"
        },
        {
          "type": "datetime",
          "name": "t_baslangic"
        },
        {
          "type": "datetime",
          "name": "t_bitis"
        },
        {
          "type": "boolean",
          "name": "t_tum_gun"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>