<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "yerleske_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "delete",
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
          "query": "DELETE\nFROM kurum_yerleskeler\nWHERE yerleske_id = :P1 /* {{$_POST.yerleske_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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