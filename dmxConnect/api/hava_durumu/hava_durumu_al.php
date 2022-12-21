<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "apiGetWeather",
  "module": "api",
  "action": "send",
  "options": {
    "url": "http://api.weatherapi.com/v1/current.json?key=615c57ef38514572901170254221812&q=Mersin",
    "params": {
      "appid": "b1a581fa4f6fcd95bcef2fa67a50d1f0",
      "lat": "36.7958736",
      "lon": "34.6251786"
    },
    "schema": [
      {
        "type": "object",
        "name": "data",
        "sub": [
          {
            "type": "object",
            "name": "location",
            "sub": [
              {
                "type": "text",
                "name": "name"
              },
              {
                "type": "text",
                "name": "region"
              },
              {
                "type": "text",
                "name": "country"
              },
              {
                "type": "number",
                "name": "lat"
              },
              {
                "type": "number",
                "name": "lon"
              },
              {
                "type": "text",
                "name": "tz_id"
              },
              {
                "type": "number",
                "name": "localtime_epoch"
              },
              {
                "type": "text",
                "name": "localtime"
              }
            ]
          },
          {
            "type": "object",
            "name": "current",
            "sub": [
              {
                "type": "number",
                "name": "last_updated_epoch"
              },
              {
                "type": "text",
                "name": "last_updated"
              },
              {
                "type": "number",
                "name": "temp_c"
              },
              {
                "type": "number",
                "name": "temp_f"
              },
              {
                "type": "number",
                "name": "is_day"
              },
              {
                "type": "object",
                "name": "condition",
                "sub": [
                  {
                    "type": "text",
                    "name": "text"
                  },
                  {
                    "type": "text",
                    "name": "icon"
                  },
                  {
                    "type": "number",
                    "name": "code"
                  }
                ]
              },
              {
                "type": "number",
                "name": "wind_mph"
              },
              {
                "type": "number",
                "name": "wind_kph"
              },
              {
                "type": "number",
                "name": "wind_degree"
              },
              {
                "type": "text",
                "name": "wind_dir"
              },
              {
                "type": "number",
                "name": "pressure_mb"
              },
              {
                "type": "number",
                "name": "pressure_in"
              },
              {
                "type": "number",
                "name": "precip_mm"
              },
              {
                "type": "number",
                "name": "precip_in"
              },
              {
                "type": "number",
                "name": "humidity"
              },
              {
                "type": "number",
                "name": "cloud"
              },
              {
                "type": "number",
                "name": "feelslike_c"
              },
              {
                "type": "number",
                "name": "feelslike_f"
              },
              {
                "type": "number",
                "name": "vis_km"
              },
              {
                "type": "number",
                "name": "vis_miles"
              },
              {
                "type": "number",
                "name": "uv"
              },
              {
                "type": "number",
                "name": "gust_mph"
              },
              {
                "type": "number",
                "name": "gust_kph"
              }
            ]
          }
        ]
      },
      {
        "type": "object",
        "name": "headers",
        "sub": [
          {
            "type": "text",
            "name": "cache-control"
          },
          {
            "type": "text",
            "name": "cdn-cache"
          },
          {
            "type": "text",
            "name": "cdn-cachedat"
          },
          {
            "type": "text",
            "name": "cdn-edgestorageid"
          },
          {
            "type": "text",
            "name": "cdn-proxyver"
          },
          {
            "type": "text",
            "name": "cdn-pullzone"
          },
          {
            "type": "text",
            "name": "cdn-requestcountrycode"
          },
          {
            "type": "text",
            "name": "cdn-requestid"
          },
          {
            "type": "text",
            "name": "cdn-requestpullcode"
          },
          {
            "type": "text",
            "name": "cdn-requestpullsuccess"
          },
          {
            "type": "text",
            "name": "cdn-status"
          },
          {
            "type": "text",
            "name": "cdn-uid"
          },
          {
            "type": "text",
            "name": "connection"
          },
          {
            "type": "text",
            "name": "content-encoding"
          },
          {
            "type": "text",
            "name": "content-type"
          },
          {
            "type": "text",
            "name": "date"
          },
          {
            "type": "text",
            "name": "server"
          },
          {
            "type": "text",
            "name": "transfer-encoding"
          },
          {
            "type": "text",
            "name": "vary"
          }
        ]
      }
    ]
  },
  "output": true,
  "meta": [
    {
      "type": "object",
      "name": "data",
      "sub": [
        {
          "type": "object",
          "name": "location",
          "sub": [
            {
              "type": "text",
              "name": "name"
            },
            {
              "type": "text",
              "name": "region"
            },
            {
              "type": "text",
              "name": "country"
            },
            {
              "type": "number",
              "name": "lat"
            },
            {
              "type": "number",
              "name": "lon"
            },
            {
              "type": "text",
              "name": "tz_id"
            },
            {
              "type": "number",
              "name": "localtime_epoch"
            },
            {
              "type": "text",
              "name": "localtime"
            }
          ]
        },
        {
          "type": "object",
          "name": "current",
          "sub": [
            {
              "type": "number",
              "name": "last_updated_epoch"
            },
            {
              "type": "text",
              "name": "last_updated"
            },
            {
              "type": "number",
              "name": "temp_c"
            },
            {
              "type": "number",
              "name": "temp_f"
            },
            {
              "type": "number",
              "name": "is_day"
            },
            {
              "type": "object",
              "name": "condition",
              "sub": [
                {
                  "type": "text",
                  "name": "text"
                },
                {
                  "type": "text",
                  "name": "icon"
                },
                {
                  "type": "number",
                  "name": "code"
                }
              ]
            },
            {
              "type": "number",
              "name": "wind_mph"
            },
            {
              "type": "number",
              "name": "wind_kph"
            },
            {
              "type": "number",
              "name": "wind_degree"
            },
            {
              "type": "text",
              "name": "wind_dir"
            },
            {
              "type": "number",
              "name": "pressure_mb"
            },
            {
              "type": "number",
              "name": "pressure_in"
            },
            {
              "type": "number",
              "name": "precip_mm"
            },
            {
              "type": "number",
              "name": "precip_in"
            },
            {
              "type": "number",
              "name": "humidity"
            },
            {
              "type": "number",
              "name": "cloud"
            },
            {
              "type": "number",
              "name": "feelslike_c"
            },
            {
              "type": "number",
              "name": "feelslike_f"
            },
            {
              "type": "number",
              "name": "vis_km"
            },
            {
              "type": "number",
              "name": "vis_miles"
            },
            {
              "type": "number",
              "name": "uv"
            },
            {
              "type": "number",
              "name": "gust_mph"
            },
            {
              "type": "number",
              "name": "gust_kph"
            }
          ]
        }
      ]
    },
    {
      "type": "object",
      "name": "headers",
      "sub": [
        {
          "type": "text",
          "name": "cache-control"
        },
        {
          "type": "text",
          "name": "cdn-cache"
        },
        {
          "type": "text",
          "name": "cdn-cachedat"
        },
        {
          "type": "text",
          "name": "cdn-edgestorageid"
        },
        {
          "type": "text",
          "name": "cdn-proxyver"
        },
        {
          "type": "text",
          "name": "cdn-pullzone"
        },
        {
          "type": "text",
          "name": "cdn-requestcountrycode"
        },
        {
          "type": "text",
          "name": "cdn-requestid"
        },
        {
          "type": "text",
          "name": "cdn-requestpullcode"
        },
        {
          "type": "text",
          "name": "cdn-requestpullsuccess"
        },
        {
          "type": "text",
          "name": "cdn-status"
        },
        {
          "type": "text",
          "name": "cdn-uid"
        },
        {
          "type": "text",
          "name": "connection"
        },
        {
          "type": "text",
          "name": "content-encoding"
        },
        {
          "type": "text",
          "name": "content-type"
        },
        {
          "type": "text",
          "name": "date"
        },
        {
          "type": "text",
          "name": "server"
        },
        {
          "type": "text",
          "name": "transfer-encoding"
        },
        {
          "type": "text",
          "name": "vary"
        }
      ]
    }
  ],
  "outputType": "object"
}
JSON
);
?>