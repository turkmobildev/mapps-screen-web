<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "t_baslangic"
      },
      {
        "type": "text",
        "name": "t_bitis"
      },
      {
        "type": "text",
        "name": "t_konu"
      },
      {
        "type": "text",
        "name": "t_oda_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "custom",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "query": "INSERT INTO toplanti (t_konu, t_baslangic, t_bitis, t_oda_id)\nSELECT :P3, :P1, :P2 , :P4\nFROM toplanti\nWHERE NOT EXISTS (\n  SELECT 1 FROM toplanti\n  WHERE (t_baslangic BETWEEN :P1 AND :P2\n  OR t_bitis BETWEEN :P1 AND :P2) AND t_oda_id = :P4\n)\nLIMIT 1;",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_POST.t_baslangic}}"
              },
              {
                "name": ":P2",
                "value": "{{$_POST.t_bitis}}"
              },
              {
                "name": ":P3",
                "value": "{{$_POST.t_konu}}"
              },
              {
                "name": ":P4",
                "value": "{{$_POST.t_oda_id}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{custom.affected==0}}",
          "then": {
            "steps": {
              "name": "yanit",
              "module": "core",
              "action": "response",
              "options": {
                "status": 601,
                "data": "dolu"
              }
            }
          }
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>