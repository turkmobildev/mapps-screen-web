<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "yerleske_adi"
      },
      {
        "type": "number",
        "name": "yerleske_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "kurum_yerleskeler",
              "column": "yerleske_adi",
              "type": "text",
              "value": "{{$_POST.yerleske_adi}}"
            }
          ],
          "table": "kurum_yerleskeler",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "yerleske_id",
                "field": "yerleske_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.yerleske_id}}",
                "data": {
                  "column": "yerleske_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "UPDATE kurum_yerleskeler\nSET yerleske_adi = :P1 /* {{$_POST.yerleske_adi}} */\nWHERE yerleske_id = :P2 /* {{$_POST.yerleske_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.yerleske_adi}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.yerleske_id}}",
              "test": ""
            }
          ]
        }
      },
      "meta": [
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