<?php
require('../../../../dmxConnectLib/dmxConnect.php');


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
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "phone"
      },
      {
        "type": "text",
        "name": "password"
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
                "table": "oda_kullanicilar",
                "column": "ok_id"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.phone.trim()}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.password.trim().sha256('netglobal')}}",
                "test": ""
              }
            ],
            "table": {
              "name": "oda_kullanicilar"
            },
            "primary": "ok_id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "oda_kullanicilar.ok_telefon",
                  "field": "oda_kullanicilar.ok_telefon",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.phone.trim()}}",
                  "data": {
                    "table": "oda_kullanicilar",
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
                  "operation": "=",
                  "table": "oda_kullanicilar"
                },
                {
                  "id": "oda_kullanicilar.ok_sifre",
                  "field": "oda_kullanicilar.ok_sifre",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.password.trim().sha256('netglobal')}}",
                  "data": {
                    "table": "oda_kullanicilar",
                    "column": "ok_sifre",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 255,
                      "primary": false,
                      "nullable": true,
                      "name": "ok_sifre"
                    }
                  },
                  "operation": "=",
                  "table": "oda_kullanicilar"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT ok_id\nFROM oda_kullanicilar\nWHERE ok_telefon = :P1 /* {{$_POST.phone.trim()}} */ AND ok_sifre = :P2 /* {{$_POST.password.trim().sha256('netglobal')}} */"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "ok_id"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{!query}}",
          "then": {
            "steps": [
              {
                "name": "insert",
                "module": "dbupdater",
                "action": "insert",
                "options": {
                  "connection": "mappsTvDB",
                  "sql": {
                    "type": "insert",
                    "values": [
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_telefon",
                        "type": "text",
                        "value": "{{$_POST.phone.trim()}}"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_sifre",
                        "type": "text",
                        "value": "{{$_POST.password.sha256('netglobal')}}"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_tip",
                        "type": "number",
                        "value": "0"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_durum",
                        "type": "number",
                        "value": "1"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_olusturulma",
                        "type": "datetime",
                        "value": "{{NOW}}"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_uuid",
                        "type": "text",
                        "value": "{{UUID}}"
                      }
                    ],
                    "table": "oda_kullanicilar",
                    "returning": "ok_id",
                    "query": "INSERT INTO oda_kullanicilar\n(ok_telefon, ok_sifre, ok_tip, ok_durum, ok_olusturulma, ok_uuid) VALUES (:P1 /* {{$_POST.phone.trim()}} */, :P2 /* {{$_POST.password.sha256('netglobal')}} */, '0', '1', :P3 /* {{NOW}} */, :P4 /* {{UUID}} */)",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.phone.trim()}}",
                        "test": ""
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.password.sha256('netglobal')}}",
                        "test": ""
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{NOW}}",
                        "test": ""
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{UUID}}",
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
                  "if": "{{insert.affected}}",
                  "then": {
                    "steps": [
                      {
                        "name": "generate",
                        "module": "jwt",
                        "action": "sign",
                        "options": {
                          "alg": "HS256",
                          "key": "netglobal",
                          "claims": {
                            "phone": "{{$_POST.phone}}",
                            "userid": "{{insert.identity}}",
                            "uuid": "{{UUID}}"
                          },
                          "jti": "{{UUID}}",
                          "aud": "mobile",
                          "expiresIn": 15552000,
                          "sub": "{{insert.identity}}",
                          "iss": "TurkmobilYazilimAS"
                        },
                        "outputType": "text"
                      },
                      {
                        "name": "",
                        "module": "core",
                        "action": "condition",
                        "options": {
                          "if": "{{generate}}",
                          "then": {
                            "steps": {
                              "name": "insert1",
                              "module": "dbupdater",
                              "action": "insert",
                              "options": {
                                "connection": "mappsTvDB",
                                "sql": {
                                  "type": "insert",
                                  "values": [
                                    {
                                      "table": "tokens",
                                      "column": "user_id",
                                      "type": "number",
                                      "value": "{{insert.identity}}"
                                    },
                                    {
                                      "table": "tokens",
                                      "column": "token",
                                      "type": "text",
                                      "value": "{{generate}}"
                                    },
                                    {
                                      "table": "tokens",
                                      "column": "created_at",
                                      "type": "datetime",
                                      "value": "{{NOW}}"
                                    }
                                  ],
                                  "table": "tokens",
                                  "returning": "id",
                                  "query": "INSERT INTO tokens\n(user_id, token, created_at) VALUES (:P1 /* {{insert.identity}} */, :P2 /* {{generate}} */, :P3 /* {{NOW}} */)",
                                  "params": [
                                    {
                                      "name": ":P1",
                                      "type": "expression",
                                      "value": "{{insert.identity}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P2",
                                      "type": "expression",
                                      "value": "{{generate}}",
                                      "test": ""
                                    },
                                    {
                                      "name": ":P3",
                                      "type": "expression",
                                      "value": "{{NOW}}",
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
          },
          "else": {
            "steps": {
              "name": "response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 403,
                "data": "forbidden"
              },
              "output": true
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