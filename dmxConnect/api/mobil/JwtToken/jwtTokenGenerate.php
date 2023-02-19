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
    ],
    "$_SERVER": [
      {
        "type": "text",
        "name": "HTTP_MAPPS_AUTHORIZATION"
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
                },
                {
                  "id": "oda_kullanicilar.ok_durum",
                  "field": "oda_kullanicilar.ok_durum",
                  "type": "double",
                  "operator": "equal",
                  "value": 1,
                  "data": {
                    "table": "oda_kullanicilar",
                    "column": "ok_durum",
                    "type": "number",
                    "columnObj": {
                      "type": "integer",
                      "default": "1",
                      "primary": false,
                      "nullable": false,
                      "name": "ok_durum"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT ok_telefon, ok_sifre, ok_id\nFROM oda_kullanicilar\nWHERE ok_telefon = :P1 /* {{$_POST.phone}} */ AND ok_sifre = :P2 /* {{$_POST.password.sha256('netglobal')}} */ AND ok_durum = 1"
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
        "name": "uuid",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{UUID}}"
        },
        "meta": [],
        "outputType": "text"
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
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_uuid",
                        "type": "text",
                        "value": "{{uuid}}"
                      },
                      {
                        "table": "oda_kullanicilar",
                        "column": "ok_olusturulma",
                        "type": "datetime",
                        "value": "{{TIMESTAMP}}"
                      }
                    ],
                    "table": "oda_kullanicilar",
                    "returning": "ok_id",
                    "query": "INSERT INTO oda_kullanicilar\n(ok_telefon, ok_sifre, ok_tip, ok_durum, ok_uuid, ok_olusturulma) VALUES (:P1 /* {{$_POST.phone}} */, :P2 /* {{$_POST.password.sha256('netglobal')}} */, '1', '1', :P3 /* {{uuid}} */, :P4 /* {{TIMESTAMP}} */)",
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
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{uuid}}",
                        "test": ""
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{TIMESTAMP}}",
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
                          "expiresIn": 15552000,
                          "key": "netglobal",
                          "jti": "{{UUID}}",
                          "claims": {
                            "phone": "{{$_POST.phone}}",
                            "uuid": "{{uuid}}",
                            "userid": "{{query.ok_id}}"
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
                              },
                              {
                                "table": "tokens",
                                "column": "created_at",
                                "type": "datetime",
                                "value": "{{TIMESTAMP}}"
                              }
                            ],
                            "table": "tokens",
                            "returning": "id",
                            "query": "INSERT INTO tokens\n(user_id, token, created_at) VALUES (:P1 /* {{insert.identity}} */, :P2 /* {{jwt}} */, :P3 /* {{TIMESTAMP}} */)",
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
                              },
                              {
                                "name": ":P3",
                                "type": "expression",
                                "value": "{{TIMESTAMP}}",
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