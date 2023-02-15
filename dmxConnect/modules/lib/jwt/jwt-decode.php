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
      "name": "decode",
      "module": "jwt",
      "action": "decode",
      "options": {
        "token": "{{$_PARAM.token}}"
      },
      "outputType": "text"
    }
  }
}
JSON;
?>