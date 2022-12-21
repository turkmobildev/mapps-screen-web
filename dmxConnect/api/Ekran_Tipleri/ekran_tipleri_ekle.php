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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insertEkranTipiEkle",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "oda_ekran_tipleri",
              "column": "et_adi",
              "type": "text",
              "value": "{{$_POST.et_adi}}"
            }
          ],
          "table": "oda_ekran_tipleri",
          "query": "INSERT INTO oda_ekran_tipleri\n(et_adi) VALUES (:P1 /* {{$_POST.et_adi}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.et_adi}}",
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