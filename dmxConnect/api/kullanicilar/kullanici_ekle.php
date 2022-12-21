<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/spa/main.html",
      "linkedForm": "modalKullaniciEkleForm"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "modalEditUserFirstName",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur ."
            }
          }
        },
        "name": "modalEditUserFirstName"
      },
      {
        "type": "text",
        "fieldName": "modalEditUserPassword",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur ."
            },
            "core:minlength": {
              "param": "8",
              "message": "Lütfen en az  {0} karakter uzunluğunda bir şifre belirleyin."
            }
          }
        },
        "name": "modalEditUserPassword"
      },
      {
        "type": "text",
        "fieldName": "modalEditUserEmail",
        "name": "modalEditUserEmail"
      },
      {
        "type": "text",
        "fieldName": "modalEditUserPhone",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur ."
            }
          }
        },
        "name": "modalEditUserPhone"
      },
      {
        "type": "text",
        "fieldName": "modalEditUserStatus",
        "options": {
          "rules": {
            "core:required": {
              "param": "",
              "message": "Bu alan zorunludur ."
            }
          }
        },
        "name": "modalEditUserStatus"
      },
      {
        "type": "text",
        "fieldName": "modalKullaniciUnvan",
        "name": "modalKullaniciUnvan"
      },
      {
        "type": "text",
        "fieldName": "kullanici_tipi",
        "name": "kullanici_tipi"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "queryCheck",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "kullanicilar",
                "column": "ok_telefon"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.modalEditUserPhone}}",
                "test": ""
              }
            ],
            "table": {
              "name": "oda_kullanicilar",
              "alias": "kullanicilar"
            },
            "primary": "ok_id",
            "joins": [],
            "query": "SELECT ok_telefon\nFROM oda_kullanicilar AS kullanicilar\nWHERE ok_telefon = :P1 /* {{$_POST.modalEditUserPhone}} */",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "kullanicilar.ok_telefon",
                  "field": "kullanicilar.ok_telefon",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.modalEditUserPhone}}",
                  "data": {
                    "table": "kullanicilar",
                    "column": "ok_telefon",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 12,
                      "primary": false,
                      "nullable": true,
                      "name": "ok_telefon"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "output": true,
        "meta": [
          {
            "type": "text",
            "name": "ok_telefon"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{queryCheck.kullanici_telefon}}",
          "then": {
            "steps": {
              "name": "response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 600,
                "data": "found"
              }
            }
          },
          "else": {
            "steps": {
              "name": "insertKullanici",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "mappsTvDB",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_ad_soyad",
                      "type": "text",
                      "value": "{{$_POST.modalEditUserFirstName}}"
                    },
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_tip",
                      "type": "number",
                      "value": "{{$_POST.kullanici_tipi ? 1 : 0}}"
                    },
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_unvan",
                      "type": "text",
                      "value": "{{$_POST.modalKullaniciUnvan}}"
                    },
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_telefon",
                      "type": "text",
                      "value": "{{$_POST.modalEditUserPhone}}"
                    },
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_eposta",
                      "type": "text",
                      "value": "{{$_POST.modalEditUserEmail}}"
                    },
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_sifre",
                      "type": "text",
                      "value": "{{$_POST.modalEditUserPassword.md5('TURKMOBIL')}}"
                    },
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_olusturulma",
                      "type": "datetime",
                      "value": "{{NOW}}"
                    },
                    {
                      "table": "oda_kullanicilar",
                      "column": "ok_durum",
                      "type": "number",
                      "value": "{{$_POST.modalEditUserStatus ? 1 : 0}}"
                    }
                  ],
                  "table": "oda_kullanicilar",
                  "returning": "ok_id",
                  "query": "INSERT INTO oda_kullanicilar\n(ok_ad_soyad, ok_tip, ok_unvan, ok_telefon, ok_eposta, ok_sifre, ok_olusturulma, ok_durum) VALUES (:P1 /* {{$_POST.modalEditUserFirstName}} */, :P2 /* {{$_POST.kullanici_tipi ? 1 : 0}} */, :P3 /* {{$_POST.modalKullaniciUnvan}} */, :P4 /* {{$_POST.modalEditUserPhone}} */, :P5 /* {{$_POST.modalEditUserEmail}} */, :P6 /* {{$_POST.modalEditUserPassword.md5('TURKMOBIL')}} */, :P7 /* {{NOW}} */, :P8 /* {{$_POST.modalEditUserStatus ? 1 : 0}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.modalEditUserFirstName}}",
                      "test": ""
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$_POST.kullanici_tipi ? 1 : 0}}",
                      "test": ""
                    },
                    {
                      "name": ":P3",
                      "type": "expression",
                      "value": "{{$_POST.modalKullaniciUnvan}}",
                      "test": ""
                    },
                    {
                      "name": ":P4",
                      "type": "expression",
                      "value": "{{$_POST.modalEditUserPhone}}",
                      "test": ""
                    },
                    {
                      "name": ":P5",
                      "type": "expression",
                      "value": "{{$_POST.modalEditUserEmail}}",
                      "test": ""
                    },
                    {
                      "name": ":P6",
                      "type": "expression",
                      "value": "{{$_POST.modalEditUserPassword.md5('TURKMOBIL')}}",
                      "test": ""
                    },
                    {
                      "name": ":P7",
                      "type": "expression",
                      "value": "{{NOW}}",
                      "test": ""
                    },
                    {
                      "name": ":P8",
                      "type": "expression",
                      "value": "{{$_POST.modalEditUserStatus ? 1 : 0}}",
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
}
JSON
);
?>