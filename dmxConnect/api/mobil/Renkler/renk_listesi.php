<?php
require('../../../../dmxConnectLib/dmxConnect.php');


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
              "table": "oda_ekran_renk",
              "column": "*"
            }
          ],
          "params": [],
          "table": {
            "name": "oda_ekran_renk"
          },
          "primary": "oer_id",
          "joins": [],
          "query": "SELECT *\nFROM oda_ekran_renk"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "oer_id"
        },
        {
          "type": "text",
          "name": "oer_ad"
        },
        {
          "type": "text",
          "name": "oer_class"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>