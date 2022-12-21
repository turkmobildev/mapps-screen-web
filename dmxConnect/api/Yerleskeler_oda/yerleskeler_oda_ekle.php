<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "kyo_yerleske_id"
      },
      {
        "type": "text",
        "name": "kyo_kat_bilgisi"
      },
      {
        "type": "text",
        "name": "kyo_oda_adi"
      },
      {
        "type": "number",
        "name": "kyo_oda_tip"
      },
      {
        "type": "number",
        "name": "kyo_ekran_tipi"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insertYerleskeOdaEkle",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "mappsTvDB",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_yerleske_id",
              "type": "number",
              "value": "{{$_POST.kyo_yerleske_id}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_kat_bilgisi",
              "type": "text",
              "value": "{{$_POST.kyo_kat_bilgisi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_oda_adi",
              "type": "text",
              "value": "{{$_POST.kyo_oda_adi}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_oda_tip",
              "type": "number",
              "value": "{{$_POST.kyo_oda_tip}}"
            },
            {
              "table": "kurum_yerleskeler_oda",
              "column": "kyo_ekran_tipi",
              "type": "number",
              "value": "{{$_POST.kyo_ekran_tipi}}"
            }
          ],
          "table": "kurum_yerleskeler_oda",
          "returning": "kyo_id",
          "query": "INSERT INTO kurum_yerleskeler_oda\n(kyo_yerleske_id, kyo_kat_bilgisi, kyo_oda_adi, kyo_oda_tip, kyo_ekran_tipi) VALUES (:P1 /* {{$_POST.kyo_yerleske_id}} */, :P2 /* {{$_POST.kyo_kat_bilgisi}} */, :P3 /* {{$_POST.kyo_oda_adi}} */, :P4 /* {{$_POST.kyo_oda_tip}} */, :P5 /* {{$_POST.kyo_ekran_tipi}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.kyo_yerleske_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.kyo_kat_bilgisi}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.kyo_oda_adi}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.kyo_oda_tip}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.kyo_ekran_tipi}}",
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