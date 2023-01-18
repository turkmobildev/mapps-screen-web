<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "t_id"
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
          "table": "toplanti",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "t_id",
                "field": "t_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.t_id}}",
                "data": {
                  "column": "t_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "t_id",
          "query": "DELETE\nFROM toplanti\nWHERE t_id = :P1 /* {{$_GET.t_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.t_id}}",
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