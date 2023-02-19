<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
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
        "name": "HTTP_AUTHORIZATION",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "verify",
        "module": "jwt",
        "action": "verify",
        "options": {
          "token": "{{HTTP_AUTHORIZATION}}",
          "key": "netglobal",
          "throw": true
        },
        "outputType": "text",
        "output": false
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{verify!=null?true:false}}",
          "then": {
            "steps": {
              "name": "Verify",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "{{verify}}"
              },
              "meta": [],
              "outputType": "text",
              "output": true
            }
          },
          "else": {
            "steps": {
              "name": "Verify",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": false
              },
              "meta": [],
              "outputType": "boolean",
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