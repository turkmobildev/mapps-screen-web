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
              "table": "oda_tipleri",
              "column": "*"
            }
          ],
          "params": [],
          "table": {
            "name": "oda_tipleri"
          },
          "primary": "ot_oda_id",
          "joins": [],
          "query": "SELECT *\nFROM oda_tipleri"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "ot_oda_id"
        },
        {
          "type": "text",
          "name": "ot_oda_tip_adi"
        },
        {
          "type": "number",
          "name": "ot_ky_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>