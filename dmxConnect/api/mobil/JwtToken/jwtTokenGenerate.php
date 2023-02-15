<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
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
        "action": "single",
        "options": {
          "connection": "mappsTvDB",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "oda_kullanicilar",
                "column": "ok_telefon"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_sifre"
              },
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
                "value": "{{$_POST.phone}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.password.sha256('netglobal')}}",
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
                  "value": "{{$_POST.phone}}",
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
                  "operation": "="
                },
                {
                  "id": "oda_kullanicilar.ok_sifre",
                  "field": "oda_kullanicilar.ok_sifre",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.password.sha256('netglobal')}}",
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
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT ok_telefon, ok_sifre, ok_id\nFROM oda_kullanicilar\nWHERE ok_telefon = :P1 /* {{$_POST.phone}} */ AND ok_sifre = :P2 /* {{$_POST.password.sha256('netglobal')}} */"
          }
        },
        "meta": [
          {
            "type": "text",
            "name": "ok_telefon"
          },
          {
            "type": "text",
            "name": "ok_sifre"
          },
          {
            "type": "number",
            "name": "ok_id"
          }
        ],
        "outputType": "object"
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
                        "value": "{{$_POST.phone}}"
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
                        "value": "1",
                        "condition": "0 User 1 Admin"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_durum",
                        "type": "number",
                        "value": "1",
                        "condition": "0 Pasif 1 Aktif"
                      }
                    ],
                    "table": "oda_kullanicilar",
                    "returning": "ok_id",
                    "query": "INSERT INTO oda_kullanicilar\n(ok_telefon, ok_sifre, ok_tip, ok_durum) VALUES (:P1 /* {{$_POST.phone}} */, :P2 /* {{$_POST.password.sha256('netglobal')}} */, '1', '1')",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.phone}}",
                        "test": ""
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.password.sha256('netglobal')}}",
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
                        "name": "jwt",
                        "module": "jwt",
                        "action": "sign",
                        "options": {
                          "alg": "HS256",
                          "iss": "TurkmobilYazilimAS",
                          "expiresIn": 60000,
                          "key": "netglobal",
                          "jti": "{{UUID}}",
                          "claims": {
                            "phone": "{{$_POST.phone}}"
                          },
                          "sub": "{{insert.identity}}",
                          "aud": "mobile"
                        },
                        "outputType": "text",
                        "output": false
                      },
                      {
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
                                "value": "{{jwt}}"
                              }
                            ],
                            "table": "tokens",
                            "returning": "id",
                            "query": "INSERT INTO tokens\n(user_id, token) VALUES (:P1 /* {{insert.identity}} */, :P2 /* {{jwt}} */)",
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
                                "value": "{{jwt}}",
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
                          "if": "{{insert1.affected}}",
                          "then": {
                            "steps": [
                              {
                                "name": "phone",
                                "module": "core",
                                "action": "setvalue",
                                "options": {
                                  "value": "{{$_POST.phone}}"
                                },
                                "meta": [],
                                "outputType": "text",
                                "output": true
                              },
                              {
                                "name": "userid",
                                "module": "core",
                                "action": "setvalue",
                                "options": {
                                  "value": "{{insert.identity}}"
                                },
                                "meta": [],
                                "outputType": "number",
                                "output": true
                              },
                              {
                                "name": "token",
                                "module": "core",
                                "action": "setvalue",
                                "options": {
                                  "value": "{{jwt}}"
                                },
                                "meta": [],
                                "outputType": "text",
                                "output": true
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
          },
          "else": {
            "steps": {
              "name": "response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 401,
                "data": "Unauthorized"
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