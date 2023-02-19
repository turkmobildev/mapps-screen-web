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
    "steps": {
      "name": "verify",
      "module": "jwt",
      "action": "verify",
      "options": {
        "token": "{{$_PARAM.token}}",
        "key": "netglobal",
        "throw": true
      },
      "outputType": "text",
      "output": true
    }
  }
}
JSON;
?>