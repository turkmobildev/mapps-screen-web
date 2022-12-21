<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "yerleske_id"
      },
      {
        "type": "text",
        "name": "yerleske_adi"
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
              "table": "kurum_yerleskeler",
              "column": "yerleske_id",
              "type": "number",
              "value": "{{$_POST.yerleske_id}}"
            },
            {
              "table": "kurum_yerleskeler",
              "column": "yerleske_adi",
              "type": "text",
              "value": "{{$_POST.yerleske_adi}}"
            }
          ],
          "table": "kurum_yerleskeler",
          "query": "INSERT INTO kurum_yerleskeler\n(yerleske_id, yerleske_adi) VALUES (:P1 /* {{$_POST.yerleske_id}} */, :P2 /* {{$_POST.yerleske_adi}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.yerleske_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.yerleske_adi}}",
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