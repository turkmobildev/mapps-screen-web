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
      "name": "queryEkranTipleri",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "oda_ekran_tipleri",
              "column": "*"
            }
          ],
          "params": [],
          "table": {
            "name": "oda_ekran_tipleri"
          },
          "joins": [],
          "query": "SELECT *\nFROM oda_ekran_tipleri",
          "primary": "et_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "et_id"
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