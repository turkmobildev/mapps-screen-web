<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "delete",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "mappsTvDB",
    "sql": {
      "type": "delete",
      "table": "oda_ekran_tipleri",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "et_id",
            "field": "et_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.et_id}}",
            "data": {
              "column": "et_id"
            },
            "operation": "="
          }
        ],
        "conditional": null,
        "valid": true
      },
      "query": "DELETE\nFROM oda_ekran_tipleri\nWHERE et_id = :P1 /* {{$_POST.et_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.et_id}}",
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
JSON
);
?>