<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/spa/ekran_ekle.html",
      "linkedForm": "formEkranEkle"
    },
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ],
    "$_POST": [
      {
        "type": "number",
        "fieldName": "oe_oda_id",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            }
          }
        },
        "name": "oe_oda_id"
      },
      {
        "type": "number",
        "fieldName": "oe_yerleske_id",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            }
          }
        },
        "name": "oe_yerleske_id"
      },
      {
        "type": "number",
        "fieldName": "oe_oda_tip_id",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur ."
            }
          }
        },
        "name": "oe_oda_tip_id"
      },
      {
        "type": "text",
        "fieldName": "oeo_device_no",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            }
          }
        },
        "name": "oeo_device_no"
      },
      {
        "type": "text",
        "fieldName": "oeo_ekran_ip",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur."
            },
            "core:ipv4": {
              "param": "",
              "message": "Lütfen geçerli bir IP adresi giriniz."
            }
          }
        },
        "name": "oeo_ekran_ip"
      },
      {
        "type": "boolean",
        "fieldName": "oeo_hava_durumu",
        "name": "oeo_hava_durumu"
      },
      {
        "type": "datetime",
        "fieldName": "oeo_tarih_saat",
        "name": "oeo_tarih_saat"
      },
      {
        "type": "number",
        "fieldName": "oeo_durum",
        "name": "oeo_durum"
      },
      {
        "type": "number",
        "fieldName": "oeo_ad_soyad_bilgisi",
        "name": "oeo_ad_soyad_bilgisi"
      },
      {
        "type": "boolean",
        "fieldName": "oeo_unvan_goster",
        "name": "oeo_unvan_goster"
      },
      {
        "type": "text",
        "fieldName": "ozellikRowId",
        "name": "ozellikRowId"
      },
      {
        "type": "text",
        "fieldName": "oeo_oda_adi_goster",
        "name": "oeo_oda_adi_goster"
      },
      {
        "type": "text",
        "fieldName": "oeo_kurum_logo",
        "name": "oeo_kurum_logo"
      },
      {
        "type": "text",
        "fieldName": "oeo_ekran_renk_id",
        "name": "oeo_ekran_renk_id"
      },
      {
        "type": "number",
        "name": "oeo_yerleske_id"
      },
      {
        "type": "number",
        "name": "oeo_oda_ekran_id"
      },
      {
        "type": "boolean",
        "name": "oeo_birim_adi_goster"
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
                "value": "{{$_POST.oe_oda_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.oe_yerleske_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_POST.oe_oda_tip_id}}",
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
                  "value": "{{$_POST.oe_oda_id}}",
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
                },
                {
                  "id": "oda_ekran.oe_yerleske_id",
                  "field": "oda_ekran.oe_yerleske_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.oe_yerleske_id}}",
                  "data": {
                    "table": "oda_ekran",
                    "column": "oe_yerleske_id",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "default": "",
                      "primary": false,
                      "nullable": true,
                      "name": "oe_yerleske_id"
                    }
                  },
                  "operation": "="
                },
                {
                  "id": "oda_ekran.oe_oda_tip_id",
                  "field": "oda_ekran.oe_oda_tip_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.oe_oda_tip_id}}",
                  "data": {
                    "table": "oda_ekran",
                    "column": "oe_oda_tip_id",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "default": "",
                      "primary": false,
                      "nullable": true,
                      "name": "oe_oda_tip_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT oe_oda_id, oe_yerleske_id, oe_oda_tip_id\nFROM oda_ekran\nWHERE oe_oda_id = :P1 /* {{$_POST.oe_oda_id}} */ AND oe_yerleske_id = :P2 /* {{$_POST.oe_yerleske_id}} */ AND oe_oda_tip_id = :P3 /* {{$_POST.oe_oda_tip_id}} */"
          }
        },
        "output": true,
        "meta": [
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
        "outputType": "array",
        "type": "dbconnector_select"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{query.count()==0}}",
          "then": {
            "steps": [
              {
                "name": "insertEkranEkle",
                "module": "dbupdater",
                "action": "insert",
                "options": {
                  "connection": "mappsTvDB",
                  "sql": {
                    "type": "insert",
                    "values": [
                      {
                        "table": "oda_ekran",
                        "column": "oe_oda_id",
                        "type": "number",
                        "value": "{{$_POST.oe_oda_id}}"
                      },
                      {
                        "table": "oda_ekran",
                        "column": "oe_yerleske_id",
                        "type": "number",
                        "value": "{{$_POST.oe_yerleske_id}}"
                      },
                      {
                        "table": "oda_ekran",
                        "column": "oe_oda_tip_id",
                        "type": "number",
                        "value": "{{$_POST.oe_oda_tip_id}}"
                      }
                    ],
                    "table": "oda_ekran",
                    "returning": "oe_id",
                    "query": "INSERT INTO oda_ekran\n(oe_oda_id, oe_yerleske_id, oe_oda_tip_id) VALUES (:P1 /* {{$_POST.oe_oda_id}} */, :P2 /* {{$_POST.oe_yerleske_id}} */, :P3 /* {{$_POST.oe_oda_tip_id}} */)",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.oe_oda_id}}",
                        "test": ""
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.oe_yerleske_id}}",
                        "test": ""
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.oe_oda_tip_id}}",
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
              },
              {
                "name": "",
                "module": "core",
                "action": "condition",
                "options": {
                  "if": "{{insertEkranEkle.affected}}",
                  "then": {
                    "steps": {
                      "name": "insertEkranStandartOda",
                      "module": "dbupdater",
                      "action": "insert",
                      "options": {
                        "connection": "mappsTvDB",
                        "sql": {
                          "type": "insert",
                          "values": [
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_oda_id",
                              "type": "number",
                              "value": "{{$_POST.oe_oda_id}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_oda_ekran_id",
                              "type": "number",
                              "value": "{{insertEkranEkle.identity}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_yerleske_id",
                              "type": "number",
                              "value": "{{$_POST.oe_yerleske_id}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_device_no",
                              "type": "text",
                              "value": "{{$_POST.oeo_device_no}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_ekran_ip",
                              "type": "text",
                              "value": "{{$_POST.oeo_ekran_ip}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_hava_durumu",
                              "type": "boolean",
                              "value": "{{$_POST.oeo_hava_durumu == 1 ? 0:1}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_tarih_saat",
                              "type": "datetime",
                              "value": "{{$_POST.oeo_tarih_saat == 1 ? 1:0}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_durum",
                              "type": "number",
                              "value": "{{$_POST.oeo_durum == 1 ? 1:0}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_ad_soyad_bilgisi",
                              "type": "number",
                              "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_unvan_goster",
                              "type": "boolean",
                              "value": "{{$_POST.oeo_unvan_goster}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_ekran_renk_id",
                              "type": "number",
                              "value": "{{$_POST.oeo_ekran_renk_id}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_kurum_logo",
                              "type": "boolean",
                              "value": "{{$_POST.oeo_kurum_logo == 1 ? 1 : 0}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_oda_adi_goster",
                              "type": "boolean",
                              "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}"
                            },
                            {
                              "table": "oda_ekran_ozellikleri",
                              "column": "oeo_birim_adi_goster",
                              "type": "boolean",
                              "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1:0}}"
                            }
                          ],
                          "table": "oda_ekran_ozellikleri",
                          "returning": "oeo_id",
                          "query": "INSERT INTO oda_ekran_ozellikleri\n(oeo_oda_id, oeo_oda_ekran_id, oeo_yerleske_id, oeo_device_no, oeo_ekran_ip, oeo_hava_durumu, oeo_tarih_saat, oeo_durum, oeo_ad_soyad_bilgisi, oeo_unvan_goster, oeo_ekran_renk_id, oeo_kurum_logo, oeo_oda_adi_goster, oeo_birim_adi_goster) VALUES (:P1 /* {{$_POST.oe_oda_id}} */, :P2 /* {{insertEkranEkle.identity}} */, :P3 /* {{$_POST.oe_yerleske_id}} */, :P4 /* {{$_POST.oeo_device_no}} */, :P5 /* {{$_POST.oeo_ekran_ip}} */, :P6 /* {{$_POST.oeo_hava_durumu == 1 ? 0:1}} */, :P7 /* {{$_POST.oeo_tarih_saat == 1 ? 1:0}} */, :P8 /* {{$_POST.oeo_durum == 1 ? 1:0}} */, :P9 /* {{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}} */, :P10 /* {{$_POST.oeo_unvan_goster}} */, :P11 /* {{$_POST.oeo_ekran_renk_id}} */, :P12 /* {{$_POST.oeo_kurum_logo == 1 ? 1 : 0}} */, :P13 /* {{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}} */, :P14 /* {{$_POST.oeo_birim_adi_goster == 1 ? 1:0}} */)",
                          "params": [
                            {
                              "name": ":P1",
                              "type": "expression",
                              "value": "{{$_POST.oe_oda_id}}",
                              "test": ""
                            },
                            {
                              "name": ":P2",
                              "type": "expression",
                              "value": "{{insertEkranEkle.identity}}",
                              "test": ""
                            },
                            {
                              "name": ":P3",
                              "type": "expression",
                              "value": "{{$_POST.oe_yerleske_id}}",
                              "test": ""
                            },
                            {
                              "name": ":P4",
                              "type": "expression",
                              "value": "{{$_POST.oeo_device_no}}",
                              "test": ""
                            },
                            {
                              "name": ":P5",
                              "type": "expression",
                              "value": "{{$_POST.oeo_ekran_ip}}",
                              "test": ""
                            },
                            {
                              "name": ":P6",
                              "type": "expression",
                              "value": "{{$_POST.oeo_hava_durumu == 1 ? 0:1}}",
                              "test": ""
                            },
                            {
                              "name": ":P7",
                              "type": "expression",
                              "value": "{{$_POST.oeo_tarih_saat == 1 ? 1:0}}",
                              "test": ""
                            },
                            {
                              "name": ":P8",
                              "type": "expression",
                              "value": "{{$_POST.oeo_durum == 1 ? 1:0}}",
                              "test": ""
                            },
                            {
                              "name": ":P9",
                              "type": "expression",
                              "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}}",
                              "test": ""
                            },
                            {
                              "name": ":P10",
                              "type": "expression",
                              "value": "{{$_POST.oeo_unvan_goster}}",
                              "test": ""
                            },
                            {
                              "name": ":P11",
                              "type": "expression",
                              "value": "{{$_POST.oeo_ekran_renk_id}}",
                              "test": ""
                            },
                            {
                              "name": ":P12",
                              "type": "expression",
                              "value": "{{$_POST.oeo_kurum_logo == 1 ? 1 : 0}}",
                              "test": ""
                            },
                            {
                              "name": ":P13",
                              "type": "expression",
                              "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}",
                              "test": ""
                            },
                            {
                              "name": ":P14",
                              "type": "expression",
                              "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1:0}}",
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
                },
                "outputType": "boolean"
              }
            ]
          },
          "else": {
            "steps": [
              {
                "name": "update",
                "module": "dbupdater",
                "action": "update",
                "options": {
                  "connection": "mappsTvDB",
                  "sql": {
                    "type": "update",
                    "values": [
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_oda_adi_goster",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_device_no",
                        "type": "text",
                        "value": "{{$_POST.oeo_device_no}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_ekran_ip",
                        "type": "text",
                        "value": "{{$_POST.oeo_ekran_ip}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_yerleske_id",
                        "type": "number",
                        "value": "{{$_POST.oe_yerleske_id}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_ekran_renk_id",
                        "type": "number",
                        "value": "{{$_POST.oeo_ekran_renk_id}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_unvan_goster",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_unvan_goster == 1 ? 1 : 0}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_durum",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_durum == 1 ? 1 : 0}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_kurum_logo",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_kurum_logo ==1 ? 1 : 0}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_ad_soyad_bilgisi",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1 : 0}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_tarih_saat",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_tarih_saat == 1 ? 1 : 0}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_hava_durumu",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_hava_durumu == 1 ? 1 : 0}}"
                      },
                      {
                        "table": "oda_ekran_ozellikleri",
                        "column": "oeo_birim_adi_goster",
                        "type": "boolean",
                        "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1 : 0}}"
                      }
                    ],
                    "table": "oda_ekran_ozellikleri",
                    "wheres": {
                      "condition": "AND",
                      "rules": [
                        {
                          "id": "oeo_id",
                          "field": "oeo_id",
                          "type": "double",
                          "operator": "equal",
                          "value": "{{$_POST.ozellikRowId}}",
                          "data": {
                            "column": "oeo_id"
                          },
                          "operation": "="
                        }
                      ],
                      "conditional": null,
                      "valid": true
                    },
                    "returning": "oeo_id",
                    "query": "UPDATE oda_ekran_ozellikleri\nSET oeo_oda_adi_goster = :P1 /* {{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}} */, oeo_device_no = :P2 /* {{$_POST.oeo_device_no}} */, oeo_ekran_ip = :P3 /* {{$_POST.oeo_ekran_ip}} */, oeo_yerleske_id = :P4 /* {{$_POST.oe_yerleske_id}} */, oeo_ekran_renk_id = :P5 /* {{$_POST.oeo_ekran_renk_id}} */, oeo_unvan_goster = :P6 /* {{$_POST.oeo_unvan_goster == 1 ? 1 : 0}} */, oeo_durum = :P7 /* {{$_POST.oeo_durum == 1 ? 1 : 0}} */, oeo_kurum_logo = :P8 /* {{$_POST.oeo_kurum_logo ==1 ? 1 : 0}} */, oeo_ad_soyad_bilgisi = :P9 /* {{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1 : 0}} */, oeo_tarih_saat = :P10 /* {{$_POST.oeo_tarih_saat == 1 ? 1 : 0}} */, oeo_hava_durumu = :P11 /* {{$_POST.oeo_hava_durumu == 1 ? 1 : 0}} */, oeo_birim_adi_goster = :P12 /* {{$_POST.oeo_birim_adi_goster == 1 ? 1 : 0}} */\nWHERE oeo_id = :P13 /* {{$_POST.ozellikRowId}} */",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.oeo_device_no}}",
                        "test": ""
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.oeo_ekran_ip}}",
                        "test": ""
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{$_POST.oe_yerleske_id}}",
                        "test": ""
                      },
                      {
                        "name": ":P5",
                        "type": "expression",
                        "value": "{{$_POST.oeo_ekran_renk_id}}",
                        "test": ""
                      },
                      {
                        "name": ":P6",
                        "type": "expression",
                        "value": "{{$_POST.oeo_unvan_goster == 1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "name": ":P7",
                        "type": "expression",
                        "value": "{{$_POST.oeo_durum == 1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "name": ":P8",
                        "type": "expression",
                        "value": "{{$_POST.oeo_kurum_logo ==1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "name": ":P9",
                        "type": "expression",
                        "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "name": ":P10",
                        "type": "expression",
                        "value": "{{$_POST.oeo_tarih_saat == 1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "name": ":P11",
                        "type": "expression",
                        "value": "{{$_POST.oeo_hava_durumu == 1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "name": ":P12",
                        "type": "expression",
                        "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1 : 0}}",
                        "test": ""
                      },
                      {
                        "operator": "equal",
                        "type": "expression",
                        "name": ":P13",
                        "value": "{{$_POST.ozellikRowId}}",
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
              },
              {
                "name": "",
                "module": "core",
                "action": "condition",
                "options": {
                  "if": "{{update.affected==false}}",
                  "then": {
                    "steps": [
                      {
                        "name": "query1",
                        "module": "dbconnector",
                        "action": "select",
                        "options": {
                          "connection": "mappsTvDB",
                          "sql": {
                            "type": "SELECT",
                            "columns": [
                              {
                                "table": "oda_ekran_ozellikleri",
                                "column": "oeo_id"
                              }
                            ],
                            "params": [
                              {
                                "operator": "equal",
                                "type": "expression",
                                "name": ":P1",
                                "value": "{{$_POST.ozellikRowId}}",
                                "test": ""
                              }
                            ],
                            "table": {
                              "name": "oda_ekran_ozellikleri"
                            },
                            "primary": "oeo_id",
                            "joins": [],
                            "wheres": {
                              "condition": "AND",
                              "rules": [
                                {
                                  "id": "oda_ekran_ozellikleri.oeo_id",
                                  "field": "oda_ekran_ozellikleri.oeo_id",
                                  "type": "double",
                                  "operator": "equal",
                                  "value": "{{$_POST.ozellikRowId}}",
                                  "data": {
                                    "table": "oda_ekran_ozellikleri",
                                    "column": "oeo_id",
                                    "type": "number",
                                    "columnObj": {
                                      "type": "increments",
                                      "primary": true,
                                      "nullable": false,
                                      "name": "oeo_id"
                                    }
                                  },
                                  "operation": "="
                                }
                              ],
                              "conditional": null,
                              "valid": true
                            },
                            "query": "SELECT oeo_id\nFROM oda_ekran_ozellikleri\nWHERE oeo_id = :P1 /* {{$_POST.ozellikRowId}} */"
                          }
                        },
                        "output": true,
                        "meta": [
                          {
                            "type": "number",
                            "name": "oeo_id"
                          }
                        ],
                        "outputType": "array"
                      },
                      {
                        "name": "",
                        "module": "core",
                        "action": "condition",
                        "options": {
                          "if": "{{query1.count()==0}}",
                          "then": {
                            "steps": {
                              "name": "insert",
                              "module": "dbupdater",
                              "action": "insert",
                              "options": {
                                "connection": "mappsTvDB",
                                "sql": {
                                  "type": "insert",
                                  "values": [
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_yerleske_id",
                                      "type": "number",
                                      "value": "{{$_POST.oe_yerleske_id}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_device_no",
                                      "type": "text",
                                      "value": "{{$_POST.oeo_device_no}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_ekran_ip",
                                      "type": "text",
                                      "value": "{{$_POST.oeo_ekran_ip}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_unvan_goster",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_unvan_goster == 1 ? 1 :0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_ekran_renk_id",
                                      "type": "number",
                                      "value": "{{$_POST.oeo_ekran_renk_id}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_hava_durumu",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_hava_durumu == 1 ? 1 :0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_kurum_logo",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_kurum_logo == 1 ? 1 : 0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_tarih_saat",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_tarih_saat == 1 ? 1 : 0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_oda_adi_goster",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_birim_adi_goster",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1:0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_ad_soyad_bilgisi",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_durum",
                                      "type": "boolean",
                                      "value": "{{$_POST.oeo_durum == 1 ? 1 : 0}}"
                                    },
                                    {
                                      "table": "oda_ekran_ozellikleri",
                                      "column": "oeo_oda_id",
                                      "type": "number",
                                      "value": "{{$_POST.oe_oda_id}}"
                                    }
                                  ],
                                  "table": "oda_ekran_ozellikleri",
                                  "returning": "oeo_id",
                                  "query": "INSERT INTO oda_ekran_ozellikleri\n(oeo_yerleske_id, oeo_device_no, oeo_ekran_ip, oeo_unvan_goster, oeo_ekran_renk_id, oeo_hava_durumu, oeo_kurum_logo, oeo_tarih_saat, oeo_oda_adi_goster, oeo_birim_adi_goster, oeo_ad_soyad_bilgisi, oeo_durum, oeo_oda_id) VALUES (:P1 /* {{$_POST.oe_yerleske_id}} */, :P2 /* {{$_POST.oeo_device_no}} */, :P3 /* {{$_POST.oeo_ekran_ip}} */, :P4 /* {{$_POST.oeo_unvan_goster == 1 ? 1 :0}} */, :P5 /* {{$_POST.oeo_ekran_renk_id}} */, :P6 /* {{$_POST.oeo_hava_durumu == 1 ? 1 :0}} */, :P7 /* {{$_POST.oeo_kurum_logo == 1 ? 1 : 0}} */, :P8 /* {{$_POST.oeo_tarih_saat == 1 ? 1 : 0}} */, :P9 /* {{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}} */, :P10 /* {{$_POST.oeo_birim_adi_goster == 1 ? 1:0}} */, :P11 /* {{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}} */, :P12 /* {{$_POST.oeo_durum == 1 ? 1 : 0}} */, :P13 /* {{$_POST.oe_oda_id}} */)",
                                  "params": [
                                    {
                                      "name": ":P1",
                                      "type": "expression",
                                      "value": "{{$_POST.oe_yerleske_id}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P2",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_device_no}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P3",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_ekran_ip}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P4",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_unvan_goster == 1 ? 1 :0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P5",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_ekran_renk_id}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P6",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_hava_durumu == 1 ? 1 :0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P7",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_kurum_logo == 1 ? 1 : 0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P8",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_tarih_saat == 1 ? 1 : 0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P9",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_oda_adi_goster == 1 ? 1 : 0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P10",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_birim_adi_goster == 1 ? 1:0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P11",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_ad_soyad_bilgisi == 1 ? 1:0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P12",
                                      "type": "expression",
                                      "value": "{{$_POST.oeo_durum == 1 ? 1 : 0}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P13",
                                      "type": "expression",
                                      "value": "{{$_POST.oe_oda_id}}",
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
                        },
                        "outputType": "boolean"
                      }
                    ]
                  }
                },
                "outputType": "boolean"
              }
            ]
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