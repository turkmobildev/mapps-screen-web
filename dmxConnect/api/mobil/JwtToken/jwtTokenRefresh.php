<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "token"
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
      "name": "decode",
      "module": "jwt",
      "action": "decode",
      "options": {
        "token": "{{$_SERVER.HTTP_MAPPS_AUTHORIZATION}}"
      },
      "outputType": "text",
      "output": true
    }
  }
}
JSON
);
?>