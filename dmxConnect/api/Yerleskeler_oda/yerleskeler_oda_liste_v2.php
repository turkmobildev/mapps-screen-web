<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "key"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_yerleske_id"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_id"
              },
              {
                "table": "yerleskeler",
                "column": "yerleske_adi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_kat_bilgisi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_oda_adi"
              },
              {
                "table": "odatipi",
                "column": "ot_oda_tip_adi"
              },
              {
                "table": "odatipi",
                "column": "ot_oda_id",
                "alias": "tipid"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_unvan"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_birim_adi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_oda_adi"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "kyo_kisi_ad_soyad"
              }
            ],
            "params": [
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.key}}",
                "test": ""
              },
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.key}}",
                "test": ""
              },
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_GET.key}}",
                "test": ""
              }
            ],
            "table": {
              "name": "kurum_yerleskeler_oda"
            },
            "joins": [
              {
                "table": "oda_tipleri",
                "column": "*",
                "alias": "odatipi",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "odatipi",
                      "column": "ot_oda_id",
                      "operator": "equal",
                      "value": {
                        "table": "kurum_yerleskeler_oda",
                        "column": "kyo_oda_tip"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "ot_oda_id"
              },
              {
                "table": "kurum_yerleskeler",
                "column": "*",
                "alias": "yerleskeler",
                "type": "INNER",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "yerleskeler",
                      "column": "yerleske_id",
                      "operator": "equal",
                      "value": {
                        "table": "kurum_yerleskeler_oda",
                        "column": "kyo_yerleske_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "yerleske_id"
              }
            ],
            "query": "SELECT kurum_yerleskeler_oda.kyo_yerleske_id, kurum_yerleskeler_oda.kyo_id, yerleskeler.yerleske_adi, kurum_yerleskeler_oda.kyo_kat_bilgisi, kurum_yerleskeler_oda.kyo_oda_adi, odatipi.ot_oda_tip_adi, odatipi.ot_oda_id AS tipid, kurum_yerleskeler_oda.kyo_unvan, kurum_yerleskeler_oda.kyo_birim_adi, kurum_yerleskeler_oda.kyo_oda_adi, kurum_yerleskeler_oda.kyo_kisi_ad_soyad\nFROM kurum_yerleskeler_oda\nLEFT JOIN oda_tipleri AS odatipi ON odatipi.ot_oda_id = kurum_yerleskeler_oda.kyo_oda_tip INNER JOIN kurum_yerleskeler AS yerleskeler ON yerleskeler.yerleske_id = kurum_yerleskeler_oda.kyo_yerleske_id\nWHERE kurum_yerleskeler_oda.kyo_kat_bilgisi LIKE :P1 /* {{$_GET.key}} */ OR kurum_yerleskeler_oda.kyo_oda_adi LIKE :P2 /* {{$_GET.key}} */ OR kurum_yerleskeler_oda.kyo_birim_adi LIKE :P3 /* {{$_GET.key}} */",
            "primary": "kyo_id",
            "wheres": {
              "condition": "OR",
              "rules": [
                {
                  "id": "kurum_yerleskeler_oda.kyo_kat_bilgisi",
                  "field": "kurum_yerleskeler_oda.kyo_kat_bilgisi",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.key}}",
                  "data": {
                    "table": "kurum_yerleskeler_oda",
                    "column": "kyo_kat_bilgisi",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 255,
                      "primary": false,
                      "nullable": true,
                      "name": "kyo_kat_bilgisi"
                    }
                  },
                  "operation": "LIKE"
                },
                {
                  "id": "kurum_yerleskeler_oda.kyo_oda_adi",
                  "field": "kurum_yerleskeler_oda.kyo_oda_adi",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.key}}",
                  "data": {
                    "table": "kurum_yerleskeler_oda",
                    "column": "kyo_oda_adi",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 255,
                      "primary": false,
                      "nullable": true,
                      "name": "kyo_oda_adi"
                    }
                  },
                  "operation": "LIKE"
                },
                {
                  "id": "kurum_yerleskeler_oda.kyo_birim_adi",
                  "field": "kurum_yerleskeler_oda.kyo_birim_adi",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.key}}",
                  "data": {
                    "table": "kurum_yerleskeler_oda",
                    "column": "kyo_birim_adi",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 255,
                      "primary": false,
                      "nullable": true,
                      "name": "kyo_birim_adi"
                    }
                  },
                  "operation": "LIKE"
                }
              ],
              "conditional": "{{$_GET.key}}",
              "valid": true
            }
          }
        },
        "output": false,
        "meta": [
          {
            "type": "number",
            "name": "kyo_yerleske_id"
          },
          {
            "type": "number",
            "name": "kyo_id"
          },
          {
            "type": "text",
            "name": "yerleske_adi"
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
            "type": "text",
            "name": "ot_oda_tip_adi"
          },
          {
            "type": "number",
            "name": "tipid"
          },
          {
            "type": "text",
            "name": "kyo_unvan"
          },
          {
            "type": "text",
            "name": "kyo_birim_adi"
          },
          {
            "type": "text",
            "name": "kyo_kisi_ad_soyad"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "adet",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{query.count().default(0)}}"
        },
        "meta": [
          {
            "name": "kyo_yerleske_id",
            "type": "number"
          },
          {
            "name": "kyo_id",
            "type": "number"
          },
          {
            "name": "yerleske_adi",
            "type": "text"
          },
          {
            "name": "kyo_kat_bilgisi",
            "type": "text"
          },
          {
            "name": "kyo_oda_adi",
            "type": "text"
          },
          {
            "name": "ot_oda_tip_adi",
            "type": "text"
          },
          {
            "name": "tipid",
            "type": "number"
          },
          {
            "name": "kyo_unvan",
            "type": "text"
          },
          {
            "name": "kyo_birim_adi",
            "type": "text"
          },
          {
            "name": "kyo_kisi_ad_soyad",
            "type": "text"
          }
        ],
        "outputType": "text",
        "output": true
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{query}}",
          "outputFields": [
            "kyo_yerleske_id",
            "kyo_id",
            "yerleske_adi",
            "kyo_kat_bilgisi",
            "kyo_oda_adi",
            "ot_oda_tip_adi",
            "tipid",
            "kyo_unvan",
            "kyo_birim_adi",
            "kyo_kisi_ad_soyad"
          ],
          "exec": {
            "steps": {
              "name": "queryEkranlar",
              "module": "dbconnector",
              "action": "select",
              "options": {
                "connection": "mappsTvDB",
                "sql": {
                  "type": "SELECT",
                  "columns": [
                    {
                      "table": "oda_ekran",
                      "column": "oe_id"
                    },
                    {
                      "table": "oda_ekran",
                      "column": "oe_oda_id"
                    },
                    {
                      "table": "oda_ekran",
                      "column": "oe_yerleske_id"
                    },
                    {
                      "table": "oda_ekran",
                      "column": "oe_oda_tip_id"
                    }
                  ],
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{kyo_id}}",
                      "test": ""
                    }
                  ],
                  "table": {
                    "name": "oda_ekran"
                  },
                  "primary": "oe_id",
                  "joins": [],
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "oda_ekran.oe_oda_id",
                        "field": "oda_ekran.oe_oda_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{kyo_id}}",
                        "data": {
                          "table": "oda_ekran",
                          "column": "oe_oda_id",
                          "type": "number",
                          "columnObj": {
                            "type": "integer",
                            "default": "",
                            "primary": false,
                            "nullable": true,
                            "name": "oe_oda_id"
                          }
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "SELECT oe_id, oe_oda_id, oe_yerleske_id, oe_oda_tip_id\nFROM oda_ekran\nWHERE oe_oda_id = :P1 /* {{kyo_id}} */"
                }
              },
              "output": true,
              "meta": [
                {
                  "type": "number",
                  "name": "oe_id"
                },
                {
                  "type": "number",
                  "name": "oe_oda_id"
                },
                {
                  "type": "number",
                  "name": "oe_yerleske_id"
                },
                {
                  "type": "number",
                  "name": "oe_oda_tip_id"
                }
              ],
              "outputType": "array"
            }
          }
        },
        "output": true,
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
          {
            "name": "kyo_yerleske_id",
            "type": "number"
          },
          {
            "name": "kyo_id",
            "type": "number"
          },
          {
            "name": "yerleske_adi",
            "type": "text"
          },
          {
            "name": "kyo_kat_bilgisi",
            "type": "text"
          },
          {
            "name": "kyo_oda_adi",
            "type": "text"
          },
          {
            "name": "ot_oda_tip_adi",
            "type": "text"
          },
          {
            "name": "tipid",
            "type": "number"
          },
          {
            "name": "kyo_unvan",
            "type": "text"
          },
          {
            "name": "kyo_birim_adi",
            "type": "text"
          },
          {
            "name": "kyo_kisi_ad_soyad",
            "type": "text"
          },
          {
            "name": "queryEkranlar",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "oe_id"
              },
              {
                "type": "number",
                "name": "oe_oda_id"
              },
              {
                "type": "number",
                "name": "oe_yerleske_id"
              },
              {
                "type": "number",
                "name": "oe_oda_tip_id"
              }
            ]
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>