<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_SERVER": [
      {
        "type": "text",
        "name": "Authorization"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "a",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{$_SERVER.Authorization}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "jwtDecode",
        "module": "core",
        "action": "exec",
        "options": {
          "exec": "jwt/jwt-decode",
          "params": {
            "token": "{{a}}"
          }
        },
        "output": true
      }
    ]
  }
}
JSON
);
?>