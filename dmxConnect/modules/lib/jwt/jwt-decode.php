<?php
$exports = <<<'JSON'
{
  "meta": {
    "$_PARAM": [
      {
        "type": "text",
        "name": "token"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "decoder",
        "module": "jwt",
        "action": "decode",
        "options": {
          "token": "{{$_PARAM.token}}"
        },
        "outputType": "text",
        "output": true
      },
      {
        "name": "expiresIn",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{decode.payload.exp}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "userId",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{decoder.payload.sub}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "uuid",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{decoder.payload.jti}}"
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
          "value": "{{decoder.payload.phone}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "signature",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{decode.signature}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "created",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{decode.payload.nbf}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "refreshInterval",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{expiresIn-120}}"
        },
        "meta": [],
        "outputType": "time",
        "output": true
      }
    ]
  }
}
JSON;
?>