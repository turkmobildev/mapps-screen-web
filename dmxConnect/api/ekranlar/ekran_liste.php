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
                "table": "yerleske",
                "column": "yerleske_adi"
              },
              {
                "table": "oda",
                "column": "kyo_oda_adi"
              },
              {
                "table": "oda",
                "column": "kyo_kat_bilgisi"
              },
              {
                "table": "odatipi",
                "column": "et_adi"
              },
              {
                "table": "ozellikler",
                "column": "oeo_ekran_ip"
              },
              {
                "table": "ozellikler",
                "column": "oeo_hava_durumu"
              },
              {
                "table": "ozellikler",
                "column": "oeo_ad_soyad_bilgisi"
              },
              {
                "table": "ozellikler",
                "column": "oeo_unvan_goster"
              },
              {
                "table": "oda_ekran",
                "column": "oe_oda_tip_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_ekran_renk_id"
              },
              {
                "table": "ozellikler",
                "column": "oeo_kurum_logo"
              },
              {
                "table": "ozellikler",
                "column": "oeo_durum"
              },
              {
                "table": "ozellikler",
                "column": "oeo_oda_adi_goster"
              },
              {
                "table": "oda",
                "column": "kyo_unvan"
              },
              {
                "table": "oda",
                "column": "kyo_kisi_ad_soyad"
              }
            ],
            "params": [],
            "table": {
              "name": "oda_ekran"
            },
            "joins": [
              {
                "table": "kurum_yerleskeler",
                "column": "*",
                "alias": "yerleske",
                "type": "INNER",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "yerleske",
                      "column": "yerleske_id",
                      "operator": "equal",
                      "value": {
                        "table": "oda_ekran",
                        "column": "oe_yerleske_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "yerleske_id"
              },
              {
                "table": "kurum_yerleskeler_oda",
                "column": "*",
                "alias": "oda",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "oda",
                      "column": "kyo_yerleske_id",
                      "operator": "equal",
                      "value": {
                        "table": "yerleske",
                        "column": "yerleske_id"
                      },
                      "operation": "="
                    },
                    {
                      "table": "oda",
                      "column": "kyo_id",
                      "operator": "equal",
                      "value": {
                        "table": "oda_ekran",
                        "column": "oe_oda_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "kyo_id"
              },
              {
                "table": "oda_ekran_tipleri",
                "column": "*",
                "alias": "odatipi",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "odatipi",
                      "column": "et_id",
                      "operator": "equal",
                      "value": {
                        "table": "oda_ekran",
                        "column": "oe_oda_tip_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "et_id"
              },
              {
                "table": "oda_ekran_ozellikleri",
                "column": "*",
                "alias": "ozellikler",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "ozellikler",
                      "column": "oeo_oda_id",
                      "operator": "equal",
                      "value": {
                        "table": "oda_ekran",
                        "column": "oe_oda_id"
                      },
                      "operation": "="
                    },
                    {
                      "table": "ozellikler",
                      "column": "oeo_oda_ekran_id",
                      "operator": "equal",
                      "value": {
                        "table": "oda_ekran",
                        "column": "oe_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "oeo_id"
              }
            ],
            "primary": "oe_id",
            "query": "SELECT yerleske.yerleske_adi, oda.kyo_oda_adi, oda.kyo_kat_bilgisi, odatipi.et_adi, ozellikler.oeo_ekran_ip, ozellikler.oeo_hava_durumu, ozellikler.oeo_ad_soyad_bilgisi, ozellikler.oeo_unvan_goster, oda_ekran.oe_oda_tip_id, ozellikler.oeo_ekran_renk_id, ozellikler.oeo_kurum_logo, ozellikler.oeo_durum, ozellikler.oeo_oda_adi_goster, oda.kyo_unvan, oda.kyo_kisi_ad_soyad\nFROM oda_ekran\nINNER JOIN kurum_yerleskeler AS yerleske ON yerleske.yerleske_id = oda_ekran.oe_yerleske_id LEFT JOIN kurum_yerleskeler_oda AS oda ON (oda.kyo_yerleske_id = yerleske.yerleske_id AND oda.kyo_id = oda_ekran.oe_oda_id) LEFT JOIN oda_ekran_tipleri AS odatipi ON odatipi.et_id = oda_ekran.oe_oda_tip_id LEFT JOIN oda_ekran_ozellikleri AS ozellikler ON (ozellikler.oeo_oda_id = oda_ekran.oe_oda_id AND ozellikler.oeo_oda_ekran_id = oda_ekran.oe_id)"
          }
        },
        "meta": [
          {
            "type": "text",
            "name": "yerleske_adi"
          },
          {
            "type": "text",
            "name": "kyo_oda_adi"
          },
          {
            "type": "text",
            "name": "kyo_kat_bilgisi"
          },
          {
            "type": "text",
            "name": "et_adi"
          },
          {
            "type": "text",
            "name": "oeo_ekran_ip"
          },
          {
            "type": "boolean",
            "name": "oeo_hava_durumu"
          },
          {
            "type": "boolean",
            "name": "oeo_ad_soyad_bilgisi"
          },
          {
            "type": "boolean",
            "name": "oeo_unvan_goster"
          },
          {
            "type": "number",
            "name": "oe_oda_tip_id"
          },
          {
            "type": "number",
            "name": "oeo_ekran_renk_id"
          },
          {
            "type": "boolean",
            "name": "oeo_kurum_logo"
          },
          {
            "type": "boolean",
            "name": "oeo_durum"
          },
          {
            "type": "boolean",
            "name": "oeo_oda_adi_goster"
          },
          {
            "type": "text",
            "name": "kyo_unvan"
          },
          {
            "type": "text",
            "name": "kyo_kisi_ad_soyad"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{query}}",
          "outputFields": [
            "yerleske_adi",
            "kyo_oda_adi",
            "kyo_kat_bilgisi",
            "et_adi",
            "oeo_ekran_ip",
            "oeo_hava_durumu",
            "oeo_ad_soyad_bilgisi",
            "oeo_unvan_goster",
            "oe_oda_tip_id",
            "oeo_ekran_renk_id",
            "oeo_kurum_logo",
            "oeo_oda_adi_goster",
            "kyo_unvan",
            "kyo_kisi_ad_soyad"
          ],
          "exec": {
            "steps": {
              "name": "queryRenkler",
              "module": "dbconnector",
              "action": "single",
              "options": {
                "connection": "mappsTvDB",
                "sql": {
                  "type": "SELECT",
                  "columns": [
                    {
                      "table": "oda_ekran_renk",
                      "column": "oer_id"
                    },
                    {
                      "table": "oda_ekran_renk",
                      "column": "oer_ad"
                    },
                    {
                      "table": "oda_ekran_renk",
                      "column": "oer_class"
                    }
                  ],
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{oeo_ekran_renk_id}}",
                      "test": ""
                    }
                  ],
                  "table": {
                    "name": "oda_ekran_renk"
                  },
                  "primary": "oer_id",
                  "joins": [],
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "oda_ekran_renk.oer_id",
                        "field": "oda_ekran_renk.oer_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{oeo_ekran_renk_id}}",
                        "data": {
                          "table": "oda_ekran_renk",
                          "column": "oer_id",
                          "type": "number",
                          "columnObj": {
                            "type": "increments",
                            "primary": true,
                            "nullable": false,
                            "name": "oer_id"
                          }
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "SELECT oer_id, oer_ad, oer_class\nFROM oda_ekran_renk\nWHERE oer_id = :P1 /* {{oeo_ekran_renk_id}} */"
                }
              },
              "output": true,
              "meta": [
                {
                  "type": "number",
                  "name": "oer_id"
                },
                {
                  "type": "text",
                  "name": "oer_ad"
                },
                {
                  "type": "text",
                  "name": "oer_class"
                }
              ],
              "outputType": "object"
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
            "name": "yerleske_adi",
            "type": "text"
          },
          {
            "name": "kyo_oda_adi",
            "type": "text"
          },
          {
            "name": "kyo_kat_bilgisi",
            "type": "text"
          },
          {
            "name": "et_adi",
            "type": "text"
          },
          {
            "name": "oeo_ekran_ip",
            "type": "text"
          },
          {
            "name": "oeo_hava_durumu",
            "type": "boolean"
          },
          {
            "name": "oeo_ad_soyad_bilgisi",
            "type": "boolean"
          },
          {
            "name": "oeo_unvan_goster",
            "type": "boolean"
          },
          {
            "name": "oe_oda_tip_id",
            "type": "number"
          },
          {
            "name": "oeo_ekran_renk_id",
            "type": "number"
          },
          {
            "name": "oeo_kurum_logo",
            "type": "boolean"
          },
          {
            "name": "oeo_durum",
            "type": "boolean"
          },
          {
            "name": "oeo_oda_adi_goster",
            "type": "boolean"
          },
          {
            "name": "kyo_unvan",
            "type": "text"
          },
          {
            "name": "kyo_kisi_ad_soyad",
            "type": "text"
          },
          {
            "name": "queryRenkler",
            "type": "object",
            "sub": [
              {
                "type": "number",
                "name": "oer_id"
              },
              {
                "type": "text",
                "name": "oer_ad"
              },
              {
                "type": "text",
                "name": "oer_class"
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