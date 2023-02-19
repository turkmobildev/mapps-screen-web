<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
    "steps": {
      "name": "",
      "module": "core",
      "action": "condition",
      "options": {
        "if": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}",
        "then": {
          "steps": [
            "lib/jwt/jwt-decode",
            {
              "name": "userid",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "{{userId}}"
              },
              "meta": [],
              "outputType": "text",
              "output": true
            },
            {
              "name": "phone",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "{{phone}}"
              },
              "meta": [],
              "outputType": "text",
              "output": true
            },
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
                      "table": "tokens",
                      "column": "user_id"
                    }
                  ],
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}",
                      "test": ""
                    },
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P2",
                      "value": "{{userId}}",
                      "test": ""
                    }
                  ],
                  "table": {
                    "name": "tokens"
                  },
                  "primary": "id",
                  "joins": [],
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "tokens.token",
                        "field": "tokens.token",
                        "type": "string",
                        "operator": "equal",
                        "value": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}",
                        "data": {
                          "table": "tokens",
                          "column": "token",
                          "type": "text",
                          "columnObj": {
                            "type": "string",
                            "maxLength": 255,
                            "primary": false,
                            "nullable": false,
                            "name": "token"
                          }
                        },
                        "operation": "="
                      },
                      {
                        "id": "tokens.user_id",
                        "field": "tokens.user_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{userId}}",
                        "data": {
                          "table": "tokens",
                          "column": "user_id",
                          "type": "number",
                          "columnObj": {
                            "type": "reference",
                            "primary": false,
                            "nullable": false,
                            "references": "ok_id",
                            "inTable": "oda_kullanicilar",
                            "referenceType": "integer",
                            "onUpdate": "RESTRICT",
                            "onDelete": "CASCADE",
                            "name": "user_id"
                          }
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "SELECT user_id\nFROM tokens\nWHERE token = :P1 /* {{$_SERVER.HTTP_MAPPS_AUTHORIZATION}} */ AND user_id = :P2 /* {{userId}} */"
                }
              },
              "output": true,
              "meta": [
                {
                  "type": "number",
                  "name": "user_id"
                }
              ],
              "outputType": "object"
            },
            {
              "name": "",
              "module": "core",
              "action": "condition",
              "options": {
                "if": "{{query}}",
                "then": {
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
                              "table": "oda_kullanicilar",
                              "column": "ok_sifre",
                              "type": "text",
                              "value": "{{$_POST.password.sha256('netglobal')}}"
                            }
                          ],
                          "table": "oda_kullanicilar",
                          "wheres": {
                            "condition": "AND",
                            "rules": [
                              {
                                "id": "ok_id",
                                "field": "ok_id",
                                "type": "double",
                                "operator": "equal",
                                "value": "{{userId}}",
                                "data": {
                                  "column": "ok_id"
                                },
                                "operation": "="
                              }
                            ],
                            "conditional": null,
                            "valid": true
                          },
                          "returning": "ok_id",
                          "query": "UPDATE oda_kullanicilar\nSET ok_sifre = :P1 /* {{$_POST.password.sha256('netglobal')}} */\nWHERE ok_id = :P2 /* {{userId}} */",
                          "params": [
                            {
                              "name": ":P1",
                              "type": "expression",
                              "value": "{{$_POST.password.sha256('netglobal')}}",
                              "test": ""
                            },
                            {
                              "operator": "equal",
                              "type": "expression",
                              "name": ":P2",
                              "value": "{{userId}}",
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
                      ]
                    },
                    {
                      "name": "",
                      "module": "core",
                      "action": "condition",
                      "options": {
                        "if": "{{update.affected}}",
                        "then": {
                          "steps": {
                            "name": "response",
                            "module": "core",
                            "action": "response",
                            "options": {
                              "status": 200,
                              "data": "OK"
                            },
                            "output": true
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
      "outputType": "boolean",
      "output": false
    }
  }
}
JSON
);
?>