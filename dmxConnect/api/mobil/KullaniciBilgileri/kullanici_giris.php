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
                "column": "ok_id"
              },
              {
                "table": "oda_kullanicilar",
                "column": "ok_durum"
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
            "query": "SELECT ok_id, ok_durum\nFROM oda_kullanicilar\nWHERE ok_telefon = :P1 /* {{$_POST.phone}} */ AND ok_sifre = :P2 /* {{$_POST.password.sha256('netglobal')}} */"
          }
        },
        "meta": [
          {
            "type": "number",
            "name": "ok_id"
          },
          {
            "type": "number",
            "name": "ok_durum"
          }
        ],
        "outputType": "object",
        "output": false
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
                "name": "queryGetToken",
                "module": "dbconnector",
                "action": "single",
                "options": {
                  "connection": "mappsTvDB",
                  "sql": {
                    "type": "SELECT",
                    "columns": [
                      {
                        "table": "tokens",
                        "column": "token"
                      },
                      {
                        "table": "tokens",
                        "column": "id"
                      }
                    ],
                    "params": [
                      {
                        "operator": "equal",
                        "type": "expression",
                        "name": ":P1",
                        "value": "{{query.ok_id}}",
                        "test": "7"
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
                          "id": "tokens.user_id",
                          "field": "tokens.user_id",
                          "type": "double",
                          "operator": "equal",
                          "value": "{{query.ok_id}}",
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
                    "query": "SELECT token, id\nFROM tokens\nWHERE user_id = :P1 /* {{query.ok_id}} */"
                  }
                },
                "meta": [
                  {
                    "type": "text",
                    "name": "token"
                  },
                  {
                    "type": "number",
                    "name": "id"
                  }
                ],
                "outputType": "object",
                "output": false
              },
              {
                "name": "verify",
                "module": "jwt",
                "action": "verify",
                "options": {
                  "token": "{{queryGetToken.token}}",
                  "key": "netglobal"
                },
                "outputType": "text",
                "output": false
              },
              {
                "name": "",
                "module": "core",
                "action": "condition",
                "options": {
                  "if": "{{verify==null}}",
                  "then": {
                    "steps": {
                      "name": "response",
                      "module": "core",
                      "action": "response",
                      "options": {
                        "status": 401,
                        "data": "unauthorized"
                      }
                    }
                  },
                  "else": {
                    "steps": {
                      "name": "",
                      "module": "core",
                      "action": "condition",
                      "options": {
                        "if": "{{query.ok_durum==1}}",
                        "then": {
                          "steps": [
                            {
                              "name": "tokenGecerlilik",
                              "module": "core",
                              "action": "setvalue",
                              "options": {
                                "value": "{{verify.exp>NOW?true:false}}"
                              },
                              "meta": [],
                              "outputType": "text",
                              "output": false
                            },
                            {
                              "name": "",
                              "module": "core",
                              "action": "condition",
                              "options": {
                                "if": "{{tokenGecerlilik}}",
                                "then": {
                                  "steps": [
                                    {
                                      "name": "",
                                      "module": "core",
                                      "action": "condition",
                                      "options": {
                                        "if": "{{verify.sub}}",
                                        "then": {
                                          "steps": [
                                            {
                                              "name": "userid",
                                              "module": "core",
                                              "action": "setvalue",
                                              "options": {
                                                "value": "{{query.ok_id}}"
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
                                                "value": "{{$_POST.phone}}"
                                              },
                                              "meta": [],
                                              "outputType": "text",
                                              "output": true
                                            },
                                            {
                                              "name": "token",
                                              "module": "core",
                                              "action": "setvalue",
                                              "options": {
                                                "value": "{{queryGetToken.token}}"
                                              },
                                              "meta": [],
                                              "outputType": "text",
                                              "output": true
                                            },
                                            {
                                              "name": "durum",
                                              "module": "core",
                                              "action": "setvalue",
                                              "options": {
                                                "value": "{{query.ok_durum}}"
                                              },
                                              "meta": [],
                                              "outputType": "text",
                                              "output": true
                                            }
                                          ]
                                        }
                                      },
                                      "outputType": "boolean"
                                    },
                                    {
                                      "name": "",
                                      "module": "core",
                                      "action": "condition",
                                      "options": {
                                        "if": "{{!verify.sub}}",
                                        "then": {
                                          "steps": [
                                            {
                                              "name": "updateJWT",
                                              "module": "jwt",
                                              "action": "sign",
                                              "options": {
                                                "alg": "RS256",
                                                "iss": "TurkmobilYazilimAS",
                                                "sub": "{{query.ok_id}}",
                                                "jti": "{{UUID}}",
                                                "expiresIn": 15552000,
                                                "aud": "mobile",
                                                "key": "netglobal",
                                                "claims": {
                                                  "phone": "{{$_POST.phone.trim()}}"
                                                }
                                              },
                                              "outputType": "text",
                                              "output": false
                                            },
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
                                                      "table": "tokens",
                                                      "column": "token",
                                                      "type": "text",
                                                      "value": "{{updateJWT}}"
                                                    },
                                                    {
                                                      "table": "tokens",
                                                      "column": "created_at",
                                                      "type": "datetime",
                                                      "value": "{{TIMESTAMP}}"
                                                    }
                                                  ],
                                                  "table": "tokens",
                                                  "wheres": {
                                                    "condition": "AND",
                                                    "rules": [
                                                      {
                                                        "id": "user_id",
                                                        "field": "user_id",
                                                        "type": "double",
                                                        "operator": "equal",
                                                        "value": "{{query.ok_id}}",
                                                        "data": {
                                                          "column": "user_id"
                                                        },
                                                        "operation": "="
                                                      }
                                                    ],
                                                    "conditional": null,
                                                    "valid": true
                                                  },
                                                  "returning": "id",
                                                  "query": "UPDATE tokens\nSET token = :P1 /* {{updateJWT}} */, created_at = :P2 /* {{TIMESTAMP}} */\nWHERE user_id = :P3 /* {{query.ok_id}} */",
                                                  "params": [
                                                    {
                                                      "name": ":P1",
                                                      "type": "expression",
                                                      "value": "{{updateJWT}}",
                                                      "test": ""
                                                    },
                                                    {
                                                      "name": ":P2",
                                                      "type": "expression",
                                                      "value": "{{TIMESTAMP}}",
                                                      "test": ""
                                                    },
                                                    {
                                                      "operator": "equal",
                                                      "type": "expression",
                                                      "name": ":P3",
                                                      "value": "{{query.ok_id}}",
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
                                              "name": "userid",
                                              "module": "core",
                                              "action": "setvalue",
                                              "options": {
                                                "value": "{{query.ok_id}}"
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
                                                "value": "{{$_POST.phone}}"
                                              },
                                              "meta": [],
                                              "outputType": "text",
                                              "output": true
                                            },
                                            {
                                              "name": "token",
                                              "module": "core",
                                              "action": "setvalue",
                                              "options": {
                                                "value": "{{updateJWT}}"
                                              },
                                              "meta": [],
                                              "outputType": "text",
                                              "output": true
                                            },
                                            {
                                              "name": "durum",
                                              "module": "core",
                                              "action": "setvalue",
                                              "options": {
                                                "value": "{{query.ok_durum}}"
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
                              "status": 403,
                              "data": "forbidden"
                            }
                          }
                        }
                      },
                      "outputType": "boolean"
                    }
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
                "data": "unauthorized"
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