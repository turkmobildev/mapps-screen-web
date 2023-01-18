<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "oe_oda_id"
      },
      {
        "type": "number",
        "name": "oe_yerleske_id"
      },
      {
        "type": "number",
        "name": "oe_oda_tip_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "oda_ekran",
              "column": "oe_oda_id",
              "type": "number",
              "value": "{{$_POST.oe_oda_id}}"
            },
            {
              "table": "oda_ekran",
              "column": "oe_yerleske_id",
              "type": "number",
              "value": "{{$_POST.oe_yerleske_id}}"
            },
            {
              "table": "oda_ekran",
              "column": "oe_oda_tip_id",
              "type": "number",
              "value": "{{$_POST.oe_oda_tip_id}}"
            }
          ],
          "table": "oda_ekran",
          "returning": "oe_id",
          "query": "INSERT INTO oda_ekran\n(oe_oda_id, oe_yerleske_id, oe_oda_tip_id) VALUES (:P1 /* {{$_POST.oe_oda_id}} */, :P2 /* {{$_POST.oe_yerleske_id}} */, :P3 /* {{$_POST.oe_oda_tip_id}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.oe_oda_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.oe_yerleske_id}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.oe_oda_tip_id}}",
              "test": ""
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>