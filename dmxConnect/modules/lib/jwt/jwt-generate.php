<?php
$exports = <<<'JSON'
{
  "meta": {
    "$_PARAM": [
      {
        "type": "text",
        "name": "userid"
      },
      {
        "type": "text",
        "name": "phone"
      },
      {
        "type": "text",
        "name": "uuid"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "jwt",
        "module": "jwt",
        "action": "sign",
        "options": {
          "alg": "HS256",
          "iss": "TurkmobilYazilimAS",
          "sub": "{{$_PARAM.userid}}",
          "aud": "mobile",
          "jti": "{{UUID}}",
          "expiresIn": 15552000,
          "key": "netglobal",
          "claims": {
            "phone": "{{$_PARAM.phone}}",
            "uuid": "{{$_PARAM.uuid}}",
            "userid": "{{$_PARAM.userid}}"
          }
        },
        "outputType": "text",
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
}
JSON;
?>