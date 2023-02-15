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
    "steps": [
      {
        "name": "queryKatBilgisi",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "kurum_kat_bilgileri",
                "column": "*"
              }
            ],
            "params": [],
            "table": {
              "name": "kurum_kat_bilgileri"
            },
            "joins": [],
            "primary": "katId",
            "query": "SELECT *\nFROM kurum_kat_bilgileri"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "katId"
          },
          {
            "type": "text",
            "name": "kat"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "queryRenkler",
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
      },
      {
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
            "primary": "et_id",
            "joins": [],
            "query": "SELECT *\nFROM oda_ekran_tipleri"
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
    ]
  }
}
JSON
);
?>