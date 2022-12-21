<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "et_adi"
      },
      {
        "type": "number",
        "name": "et_id"
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
              "table": "oda_ekran_tipleri",
              "column": "et_adi",
              "type": "text",
              "value": "{{$_POST.et_adi}}"
            }
          ],
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
          "query": "UPDATE oda_ekran_tipleri\nSET et_adi = :P1 /* {{$_POST.et_adi}} */\nWHERE et_id = :P2 /* {{$_POST.et_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.et_adi}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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
  }
}
JSON
);
?>