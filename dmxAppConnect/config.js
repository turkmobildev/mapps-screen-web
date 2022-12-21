dmx.config({
  "mainpages": {
    "data_viewKullanicilar": {
      "meta": [
        {
          "type": "number",
          "name": "kullanici_id"
        },
        {
          "type": "text",
          "name": "kullanici_adi_soyadi"
        },
        {
          "type": "text",
          "name": "kullanici_unvan"
        },
        {
          "type": "text",
          "name": "kullanici_telefon"
        },
        {
          "type": "text",
          "name": "kullanici_eposta"
        },
        {
          "type": "datetime",
          "name": "kullanici_olusturulma_tarihi"
        },
        {
          "type": "number",
          "name": "kullanici_durum"
        },
        {
          "type": "number",
          "name": "kullanici_tipi"
        },
        {
          "type": "text",
          "name": "kullanici_foto_url"
        }
      ],
      "outputType": "array"
    },
    "query": [
      {
        "type": "text",
        "name": "page"
      }
    ],
    "sessionStorage": [
      {
        "type": "text",
        "name": "offset"
      }
    ],
    "tableRepeat1": {
      "meta": [
        {
          "type": "number",
          "name": "kullanici_id"
        },
        {
          "type": "text",
          "name": "kullanici_adi_soyadi"
        },
        {
          "type": "text",
          "name": "kullanici_unvan"
        },
        {
          "type": "text",
          "name": "kullanici_telefon"
        },
        {
          "type": "text",
          "name": "kullanici_eposta"
        },
        {
          "type": "datetime",
          "name": "kullanici_olusturulma_tarihi"
        },
        {
          "type": "number",
          "name": "kullanici_durum"
        },
        {
          "type": "number",
          "name": "kullanici_tipi"
        },
        {
          "type": "text",
          "name": "kullanici_foto_url"
        }
      ],
      "outputType": "array"
    }
  },
  "ekranlar": {
    "repeat_ekranlar": {
      "meta": [
        {
          "type": "number",
          "name": "ekran_id"
        },
        {
          "type": "text",
          "name": "ekran_tag"
        },
        {
          "type": "text",
          "name": "ekran_device_id"
        },
        {
          "type": "number",
          "name": "ekran_yerleske_id"
        },
        {
          "type": "number",
          "name": "ekran_oda_id"
        },
        {
          "type": "text",
          "name": "ekran_ip"
        }
      ],
      "outputType": "array"
    }
  },
  "yerleskeler": {
    "tableRepeat1": {
      "meta": [
        {
          "name": "yerleske_id",
          "type": "number"
        },
        {
          "name": "yerleske_adi",
          "type": "text"
        },
        {
          "name": "queryOdalar",
          "type": "array",
          "sub": [
            {
              "type": "number",
              "name": "kyo_id"
            },
            {
              "type": "text",
              "name": "kyo_kat_bilgisi"
            },
            {
              "type": "text",
              "name": "kyo_oda_adi"
            },
            {
              "type": "number",
              "name": "kyo_oda_tip"
            },
            {
              "type": "number",
              "name": "kyo_ekran_tipi"
            }
          ]
        }
      ],
      "outputType": "array"
    },
    "repeat1": {
      "meta": [
        {
          "type": "number",
          "name": "ot_oda_id"
        },
        {
          "type": "text",
          "name": "ot_oda_tip_adi"
        },
        {
          "type": "number",
          "name": "ot_ky_id"
        }
      ],
      "outputType": "array"
    },
    "repeat2": {
      "meta": [
        {
          "type": "number",
          "name": "et_id"
        },
        {
          "type": "text",
          "name": "et_adi"
        }
      ],
      "outputType": "array"
    }
  },
  "odalar": {
    "repeat1": {
      "meta": [
        {
          "name": "yerleske_id",
          "type": "number"
        },
        {
          "name": "yerleske_adi",
          "type": "text"
        },
        {
          "name": "queryOdalar",
          "type": "array",
          "sub": [
            {
              "type": "number",
              "name": "kyo_id"
            },
            {
              "type": "number",
              "name": "kyo_yerleske_id"
            },
            {
              "type": "text",
              "name": "kyo_kat_bilgisi"
            },
            {
              "type": "text",
              "name": "kyo_oda_adi"
            },
            {
              "type": "number",
              "name": "kyo_oda_tip"
            },
            {
              "type": "number",
              "name": "kyo_ekran_tipi"
            }
          ]
        }
      ],
      "outputType": "array"
    },
    "repeat2": {
      "meta": [
        {
          "type": "number",
          "name": "kyo_id"
        },
        {
          "type": "number",
          "name": "kyo_yerleske_id"
        },
        {
          "type": "text",
          "name": "kyo_kat_bilgisi"
        },
        {
          "type": "text",
          "name": "kyo_oda_adi"
        },
        {
          "type": "number",
          "name": "kyo_oda_tip"
        },
        {
          "type": "number",
          "name": "kyo_ekran_tipi"
        }
      ],
      "outputType": "array"
    }
  }
});
