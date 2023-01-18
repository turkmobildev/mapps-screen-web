<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "oe_id"
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
          "table": "kurum_yerleskeler_oda",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "kyo_id",
                "field": "kyo_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.oe_id}}",
                "data": {
                  "column": "kyo_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "kyo_id",
          "query": "DELETE\nFROM kurum_yerleskeler_oda\nWHERE kyo_id = :P1 /* {{$_POST.oe_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.oe_id}}",
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
      ],
      "output": true
    }
  }
}
JSON
);
?>