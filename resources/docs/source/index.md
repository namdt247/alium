---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://alium.vn/docs/collection.json)

<!-- END_INFO -->

#GENERAL INFO


<!-- START_32d50d09882ac6688f38a6242707c1c4 -->
## Get list Country

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/list-country?%5C=est" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/list-country"
);

let params = {
    "\": "est",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/list-country`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_32d50d09882ac6688f38a6242707c1c4 -->

<!-- START_2ef56f67f345f090d108c9d2b321a23c -->
## Get list City

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/list-city/1?%5C=eligendi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/list-city/1"
);

let params = {
    "\": "eligendi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/list-city/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `country` |  optional  | ID
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_2ef56f67f345f090d108c9d2b321a23c -->

<!-- START_391ab14d343fc30cb87be8769d969fef -->
## Get list distrist

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/list-district/1?%5C=aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/list-district/1"
);

let params = {
    "\": "aut",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/list-district/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `city` |  optional  | ID
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_391ab14d343fc30cb87be8769d969fef -->

<!-- START_4800852f6d7adeb192f0903897167dcc -->
## Get list Country

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/list-country?%5C=dolore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/list-country"
);

let params = {
    "\": "dolore",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/supplier/list-country`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_4800852f6d7adeb192f0903897167dcc -->

<!-- START_cadfcceb6015d76813b6559dec8e2e5f -->
## Get list City

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/list-city/1?%5C=error" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/list-city/1"
);

let params = {
    "\": "error",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/supplier/list-city/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `country` |  optional  | ID
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_cadfcceb6015d76813b6559dec8e2e5f -->

<!-- START_9ffc6c4a9058134826d9f2c855843e56 -->
## Get list distrist

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/list-district/1?%5C=id" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/list-district/1"
);

let params = {
    "\": "id",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/supplier/list-district/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `city` |  optional  | ID
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_9ffc6c4a9058134826d9f2c855843e56 -->

#NOTIFICATION


<!-- START_cc8fb33434ac736c24d499da90d47093 -->
## Get list Nofification demander

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/user/notify?%5C=autem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/user/notify"
);

let params = {
    "\": "autem",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Success"
}
```

### HTTP Request
`GET api/user/notify`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_cc8fb33434ac736c24d499da90d47093 -->

<!-- START_a2723a7a2fe36dc3dcaf3ce5f2ff357b -->
## Read notification

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/user/notify/read/1?%5C=qui" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/user/notify/read/1"
);

let params = {
    "\": "qui",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Success"
}
```

### HTTP Request
`GET api/user/notify/read/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_a2723a7a2fe36dc3dcaf3ce5f2ff357b -->

<!-- START_34449fbf59107952c1a2152efa43f271 -->
## Get list Nofification demander

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/notify?%5C=itaque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/notify"
);

let params = {
    "\": "itaque",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Success"
}
```

### HTTP Request
`GET api/supplier/notify`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_34449fbf59107952c1a2152efa43f271 -->

<!-- START_047ad973b723736a9407934480b04877 -->
## Read notification

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/notify/read/1?%5C=dolores" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/notify/read/1"
);

let params = {
    "\": "dolores",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Success"
}
```

### HTTP Request
`GET api/supplier/notify/read/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_047ad973b723736a9407934480b04877 -->

#SUPPLIER MANAGER INFO


<!-- START_a465377b05b8af48aa9d3197670997ca -->
## Login

> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/login?%5C=omnis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"dolorum","password":"ducimus"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/login"
);

let params = {
    "\": "omnis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "dolorum",
    "password": "ducimus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
        "info": {
            "user_id": 1,
            "user_name": "abc",
            "user_showName": "Alium"
        },
        "newSupplier": false,
        "supplierInfo": {
            "sp_id": 266,
            "sp_code": "XM2003301",
            "sp_name": "Xưởng abc",
            "sp_email": "abc@alium.vn",
            "sp_phone": null,
            "sp_banner": null
        },
        "dataSupplier": {
            "Genera info": {},
            "Business owner": {},
            "Oder process": {},
            "Order passed": [],
            "Advance info": {},
            "Service": {}
        }
    },
    "status": 200,
    "message": "Success"
}
```

### HTTP Request
`POST api/supplier/login`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | 
        `password` | string |  required  | 
    
<!-- END_a465377b05b8af48aa9d3197670997ca -->

<!-- START_385f58715661f8003b89fa2a97adb61e -->
## Get Info

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/get-info?%5C=recusandae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/get-info"
);

let params = {
    "\": "recusandae",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "supplier": {
            "sp_id": 266,
            "sp_code": "XM2003301",
            "sp_name": "Xưởng abc",
            "typeSupplier": "Không xác định",
            "qualityOrder": "Không xác định",
            "image": []
        },
        "Genera info": {
            "logo": "",
            "companyName": "Xưởng abc",
            "globalName": "",
            "businessCode": "123456",
            "businessImage": [],
            "email": "abc@alium.vn"
        },
        "Business owner": {
            "fullName": "Alium",
            "phone": "",
            "email": "",
            "address": "",
            "image": []
        },
        "Oder process": {
            "position": "",
            "fullName": "",
            "phone": "",
            "email": "",
            "address": "",
            "image": []
        },
        "Order passed": [],
        "Advance info": {
            "certificate": "",
            "factoryImage": "",
            "profile": ""
        },
        "Service": {
            "logistic": "",
            "deliver": "",
            "deliverPartner": [],
            "otherService": [],
            "produceService": []
        }
    },
    "status": 200,
    "message": "Success"
}
```

### HTTP Request
`POST api/supplier/get-info`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_385f58715661f8003b89fa2a97adb61e -->

<!-- START_40aa7805cb9839a8e5f673cd710ffac6 -->
## Update Info

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/update-info?%5C=rerum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"contact","sId":14,"dataUpdate":"{\"logo\":\"\",\"companyName\":\"X\\u01b0\\u1edfng abc\",\"globalName\":\"\",\"businessCode\":\"123456\",\"businessImage\":[],\"email\":\"abc@alium.vn\",\"website\":\"\",\"address\":\"\",\"city\":\"\",\"startYear\":\"\",\"numEmployee\":\"\",\"factoryAddress\":[],\"promotionText\":\"\",\"typeOfProduct\":1,\"typeOfBusiness\":1,\"market\":\"\",\"marketName\":[],\"historyBrand\":[],\"phone\":\"0987654321\",\"licenseId\":\"112233\"}"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/update-info"
);

let params = {
    "\": "rerum",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "contact",
    "sId": 14,
    "dataUpdate": "{\"logo\":\"\",\"companyName\":\"X\\u01b0\\u1edfng abc\",\"globalName\":\"\",\"businessCode\":\"123456\",\"businessImage\":[],\"email\":\"abc@alium.vn\",\"website\":\"\",\"address\":\"\",\"city\":\"\",\"startYear\":\"\",\"numEmployee\":\"\",\"factoryAddress\":[],\"promotionText\":\"\",\"typeOfProduct\":1,\"typeOfBusiness\":1,\"market\":\"\",\"marketName\":[],\"historyBrand\":[],\"phone\":\"0987654321\",\"licenseId\":\"112233\"}"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/update-info`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  required  | type of info to update, one of [generalInfo, contact, service, advance].
        `sId` | integer |  required  | supplier ID
        `dataUpdate` | object |  required  | array of key=>value, only send if change value.
    
<!-- END_40aa7805cb9839a8e5f673cd710ffac6 -->

<!-- START_6dc4200b6d84f14ec8b730e3a3322c90 -->
## Get List Order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/list-order?page=8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/list-order"
);

let params = {
    "page": "8",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/supplier/list-order`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | Number of page (integer)

<!-- END_6dc4200b6d84f14ec8b730e3a3322c90 -->

<!-- START_538ddd220da6d382c427921b9acd28c7 -->
## Add Order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/add-order?%5C=voluptas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"unit":"est","priceUnit":10,"minQuantity":11,"color":[],"brand":[],"material":"culpa","size":"cupiditate","video":"distinctio","hide":true,"pdf_file":"totam","od_product":11,"imgId":"id"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/add-order"
);

let params = {
    "\": "voluptas",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "unit": "est",
    "priceUnit": 10,
    "minQuantity": 11,
    "color": [],
    "brand": [],
    "material": "culpa",
    "size": "cupiditate",
    "video": "distinctio",
    "hide": true,
    "pdf_file": "totam",
    "od_product": 11,
    "imgId": "id"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/add-order`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `unit` | string |  required  | Currency
        `priceUnit` | integer |  required  | price per unit
        `minQuantity` | integer |  required  | number of unit
        `color` | array |  optional  | list of color
        `brand` | array |  optional  | list of brand
        `material` | string |  optional  | 
        `size` | string |  optional  | explain size
        `video` | string |  optional  | youtube video link
        `hide` | boolean |  required  | hide/show order
        `pdf_file` | string |  optional  | optional Pdf file
        `od_product` | integer |  required  | product ID of order
        `imgId` | string |  optional  | list of image, separate by comma
    
<!-- END_538ddd220da6d382c427921b9acd28c7 -->

<!-- START_6b6260f2dfc571ac334a1b1befa0f79b -->
## Upload Image

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/upload-image?%5C=necessitatibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"file":"aut","pdf":"nemo"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/upload-image"
);

let params = {
    "\": "necessitatibus",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "file": "aut",
    "pdf": "nemo"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/upload-image`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `file` | file |  required  | File to upload
        `pdf` | file |  required  | Pdf file to upload (require at least one file image or pdf)
    
<!-- END_6b6260f2dfc571ac334a1b1befa0f79b -->

<!-- START_7bddaa5f24a65c4f642638818c8c3fb3 -->
## Upload Image Order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/upload-order-image?%5C=qui" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"file":"dolore"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/upload-order-image"
);

let params = {
    "\": "qui",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "file": "dolore"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/upload-order-image`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `file` | file |  required  | File to upload
    
<!-- END_7bddaa5f24a65c4f642638818c8c3fb3 -->

<!-- START_b7c29375cc2f348df7814e7db3d99688 -->
## Delete Image Order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/delete-image/1?%5C=blanditiis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/delete-image/1"
);

let params = {
    "\": "blanditiis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/supplier/delete-image/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `{id}` |  optional  | string required url/image_id from server when uploaded image
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_b7c29375cc2f348df7814e7db3d99688 -->

<!-- START_04808c00af586c35a7efadf04c468539 -->
## Update Order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/update-order?%5C=et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"odId":16,"dataUpdate":{},"imgId":"100,102,123","pdf_file":"delectus"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/update-order"
);

let params = {
    "\": "et",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "odId": 16,
    "dataUpdate": {},
    "imgId": "100,102,123",
    "pdf_file": "delectus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/update-order`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `odId` | integer |  required  | order id to be update
        `dataUpdate` | object |  required  | array of key=>value, send empty object if don't change value
        `imgId` | string |  optional  | list of image id if user upload new image.
        `pdf_file` | file |  optional  | pdf file if user upload file
    
<!-- END_04808c00af586c35a7efadf04c468539 -->

<!-- START_7fe264e49ccd6246233149954fa9413b -->
## Update User Info

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/edit-info?%5C=quasi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"dataUpdate":{"user_showName":"suscipit","user_phone":"exercitationem","user_city":5767.61253765,"user_address":"corrupti","user_birthday":"libero","user_gender":"dolores"},"newPassword:":"consequatur"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/edit-info"
);

let params = {
    "\": "quasi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "dataUpdate": {
        "user_showName": "suscipit",
        "user_phone": "exercitationem",
        "user_city": 5767.61253765,
        "user_address": "corrupti",
        "user_birthday": "libero",
        "user_gender": "dolores"
    },
    "newPassword:": "consequatur"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/edit-info`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `dataUpdate` | object |  optional  | array of key=>value, don't send info if don't change value
        `dataUpdate.user_showName` | string |  optional  | 
        `dataUpdate.user_phone` | string |  optional  | 
        `dataUpdate.user_city` | number |  optional  | number of city
        `dataUpdate.user_address` | string |  optional  | 
        `dataUpdate.user_birthday` | string |  optional  | format 'yyyy/mm/dd'
        `dataUpdate.user_gender` | string |  optional  | nam/nu
        `newPassword:` | string |  optional  | if change password
    
<!-- END_7fe264e49ccd6246233149954fa9413b -->

<!-- START_4f05d2049a8c88c266bc84831a6352ae -->
## Logout

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/logout?%5C=eveniet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/logout"
);

let params = {
    "\": "eveniet",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/logout`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 

<!-- END_4f05d2049a8c88c266bc84831a6352ae -->

<!-- START_5a0f3d66dc96d9ba7cb937cf3ee4f4eb -->
## Get list customer order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/list-order-customer?%5C=voluptatem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"bid","dataUpdate":"{\"priceUnit\":\"100000\",\"timeFinish\":\"8\",\"material\":\"Cotton 70%\", \"note\":\"restore at 10\/10\/1990\"}"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/list-order-customer"
);

let params = {
    "\": "voluptatem",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "bid",
    "dataUpdate": "{\"priceUnit\":\"100000\",\"timeFinish\":\"8\",\"material\":\"Cotton 70%\", \"note\":\"restore at 10\/10\/1990\"}"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/supplier/list-order-customer`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  required  | type of info to update, one of [cancel, transport, rate, bid].
        `dataUpdate` | object |  required  | array of key=>value, only send if change value.
    
<!-- END_5a0f3d66dc96d9ba7cb937cf3ee4f4eb -->

<!-- START_f7daf6a461a964fb6eaae3dcd4967e75 -->
## Get detail customer order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/detail-order-customer?%5C=consequatur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"bid","dataUpdate":"{\"priceUnit\":\"100000\",\"timeFinish\":\"8\",\"material\":\"Cotton 70%\", \"note\":\"restore at 10\/10\/1990\"}"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/detail-order-customer"
);

let params = {
    "\": "consequatur",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "bid",
    "dataUpdate": "{\"priceUnit\":\"100000\",\"timeFinish\":\"8\",\"material\":\"Cotton 70%\", \"note\":\"restore at 10\/10\/1990\"}"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`GET api/supplier/detail-order-customer`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  required  | type of info to update, one of [cancel, transport, rate, bid].
        `dataUpdate` | object |  required  | array of key=>value, only send if change value.
    
<!-- END_f7daf6a461a964fb6eaae3dcd4967e75 -->

<!-- START_243a59b3cf84cf023cb467f0c6011ea1 -->
## Process customer order

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/process-order?%5C=molestiae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"bid","dataUpdate":"{\"priceUnit\":\"100000\",\"timeFinish\":\"8\",\"material\":\"Cotton 70%\", \"note\":\"restore at 10\/10\/1990\"}"}'

```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/process-order"
);

let params = {
    "\": "molestiae",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "bid",
    "dataUpdate": "{\"priceUnit\":\"100000\",\"timeFinish\":\"8\",\"material\":\"Cotton 70%\", \"note\":\"restore at 10\/10\/1990\"}"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "status": 200,
    "message": "Successful"
}
```

### HTTP Request
`POST api/supplier/process-order`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `\` |  optional  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `\` |  optional  | 
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  required  | type of info to update, one of [cancel, transport, rate, bid].
        `dataUpdate` | object |  required  | array of key=>value, only send if change value.
    
<!-- END_243a59b3cf84cf023cb467f0c6011ea1 -->

#general


<!-- START_2e1c96dcffcfe7e0eb58d6408f1d619e -->
## api/auth/register
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/register`


<!-- END_2e1c96dcffcfe7e0eb58d6408f1d619e -->

<!-- START_4cdcfcaf4756f0b3078ccf20cb81cc23 -->
## api/auth/register-social
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/auth/register-social" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/register-social"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/register-social`


<!-- END_4cdcfcaf4756f0b3078ccf20cb81cc23 -->

<!-- START_a925a8d22b3615f12fca79456d286859 -->
## api/auth/login
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/login`


<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_9da68c10804b0a454fb3549419d5d9f0 -->
## api/auth/login-social
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/auth/login-social" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/login-social"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/login-social`


<!-- END_9da68c10804b0a454fb3549419d5d9f0 -->

<!-- START_19ff1b6f8ce19d3c444e9b518e8f7160 -->
## api/auth/logout
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/logout`


<!-- END_19ff1b6f8ce19d3c444e9b518e8f7160 -->

<!-- START_98d3199ce15557d4baa898440152e117 -->
## api/auth/reset-password
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/auth/reset-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/reset-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 501,
    "message": "Success",
    "data": []
}
```

### HTTP Request
`GET api/auth/reset-password`


<!-- END_98d3199ce15557d4baa898440152e117 -->

<!-- START_bee4c3298d5e5aa2acddb5486921e94b -->
## api/auth/reset-password
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/auth/reset-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/reset-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/reset-password`


<!-- END_bee4c3298d5e5aa2acddb5486921e94b -->

<!-- START_85b3ab2892b2c9ce5058487fbff8ed13 -->
## api/auth/register/send-code
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/auth/register/send-code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/register/send-code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/auth/register/send-code`


<!-- END_85b3ab2892b2c9ce5058487fbff8ed13 -->

<!-- START_f3183b2482a59c99229331315d0b116b -->
## api/auth/register/verify-code
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/auth/register/verify-code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/auth/register/verify-code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/register/verify-code`


<!-- END_f3183b2482a59c99229331315d0b116b -->

<!-- START_86e0ac5d4f8ce9853bc22fd08f2a0109 -->
## api/products
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Success",
    "data": {
        "feature": [],
        "product": [
            {
                "cate_id": 1,
                "cate_name": "Quần áo",
                "cate_value": "Quần áo",
                "cate_code": null,
                "cate_parent": 0,
                "cate_alias": "quan-ao",
                "cate_size": null,
                "cate_featureImg": null,
                "cate_status": 1,
                "cate_order": 0,
                "created_at": "2019-09-26 12:41:11",
                "updated_at": "2019-09-26 12:41:11",
                "product": [
                    {
                        "prd_id": 1,
                        "prd_name": "Áo sơ mi & Áo cánh",
                        "prd_alias": "ao-so-mi-ao-canh",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:41:56",
                        "updated_at": "2019-09-26 12:41:56",
                        "image": [
                            {
                                "img_id": 4,
                                "img_product": 1,
                                "img_src": "\/product\/ao-so-mi_476515222.jpg",
                                "img_name": "Áo sơ mi & Áo cánh 4",
                                "img_alias": "ao-so-mi-ao-canh-4",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:41:55",
                                "updated_at": "2019-09-26 12:41:56"
                            }
                        ],
                        "translations": [
                            {
                                "id": 1,
                                "product_prd_id": 1,
                                "prd_name": "Áo sơ mi & Áo cánh",
                                "prd_alias": "ao-so-mi-ao-canh",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 2,
                        "prd_name": "Áo phông & Áo polo",
                        "prd_alias": "ao-phong-ao-polo",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:42:36",
                        "updated_at": "2019-09-26 12:42:36",
                        "image": [
                            {
                                "img_id": 5,
                                "img_product": 2,
                                "img_src": "\/product\/2-4_0027_aopolo_476526476.png",
                                "img_name": "Áo phông & Áo polo 5",
                                "img_alias": "ao-phong-ao-polo-5",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:42:06",
                                "updated_at": "2019-09-26 12:42:36"
                            }
                        ],
                        "translations": [
                            {
                                "id": 2,
                                "product_prd_id": 2,
                                "prd_name": "Áo phông & Áo polo",
                                "prd_alias": "ao-phong-ao-polo",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 3,
                        "prd_name": "Áo liền quần",
                        "prd_alias": "ao-lien-quan",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:42:52",
                        "updated_at": "2019-09-26 12:42:52",
                        "image": [
                            {
                                "img_id": 6,
                                "img_product": 3,
                                "img_src": "\/product\/2-4_0026_aolienquan_476571163.png",
                                "img_name": "Áo liền quần 6",
                                "img_alias": "ao-lien-quan-6",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:42:51",
                                "updated_at": "2019-09-26 12:42:52"
                            }
                        ],
                        "translations": [
                            {
                                "id": 3,
                                "product_prd_id": 3,
                                "prd_name": "Áo liền quần",
                                "prd_alias": "ao-lien-quan",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 4,
                        "prd_name": "Áo khoác",
                        "prd_alias": "ao-khoac",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:43:57",
                        "updated_at": "2019-09-26 12:43:57",
                        "image": [
                            {
                                "img_id": 8,
                                "img_product": 4,
                                "img_src": "\/product\/2-4_0025_aokhoac.png",
                                "img_name": "Áo khoác 8",
                                "img_alias": "ao-khoac-8",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:43:55",
                                "updated_at": "2019-09-26 12:43:57"
                            }
                        ],
                        "translations": [
                            {
                                "id": 4,
                                "product_prd_id": 4,
                                "prd_name": "Áo khoác",
                                "prd_alias": "ao-khoac",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 5,
                        "prd_name": "Áo nỉ len & Hoodie",
                        "prd_alias": "ao-ni-len-hoodie",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:44:11",
                        "updated_at": "2019-09-26 12:44:11",
                        "image": [
                            {
                                "img_id": 9,
                                "img_product": 5,
                                "img_src": "\/product\/2-4_0024_hoodie_476650383.png",
                                "img_name": "Áo nỉ len & Hoodie 9",
                                "img_alias": "ao-ni-len-hoodie-9",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:44:10",
                                "updated_at": "2019-09-26 12:44:11"
                            }
                        ],
                        "translations": [
                            {
                                "id": 5,
                                "product_prd_id": 5,
                                "prd_name": "Áo nỉ len & Hoodie",
                                "prd_alias": "ao-ni-len-hoodie",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 6,
                        "prd_name": "Áo khoác len mỏng",
                        "prd_alias": "ao-khoac-len-mong",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:44:26",
                        "updated_at": "2019-09-26 12:44:26",
                        "image": [
                            {
                                "img_id": 10,
                                "img_product": 6,
                                "img_src": "\/product\/2-4_0023_aokhoaclen_476664143.png",
                                "img_name": "Áo khoác len mỏng 10",
                                "img_alias": "ao-khoac-len-mong-10",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:44:24",
                                "updated_at": "2019-09-26 12:44:26"
                            }
                        ],
                        "translations": [
                            {
                                "id": 6,
                                "product_prd_id": 6,
                                "prd_name": "Áo khoác len mỏng",
                                "prd_alias": "ao-khoac-len-mong",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 7,
                        "prd_name": "Áo vest",
                        "prd_alias": "ao-vest",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:44:39",
                        "updated_at": "2019-09-26 12:44:39",
                        "image": [
                            {
                                "img_id": 11,
                                "img_product": 7,
                                "img_src": "\/product\/2-4_0022_vest_476676921.png",
                                "img_name": "Áo vest 11",
                                "img_alias": "ao-vest-11",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:44:36",
                                "updated_at": "2019-09-26 12:44:39"
                            }
                        ],
                        "translations": [
                            {
                                "id": 7,
                                "product_prd_id": 7,
                                "prd_name": "Áo vest",
                                "prd_alias": "ao-vest",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 8,
                        "prd_name": "Quần dài",
                        "prd_alias": "quan-dai",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:44:50",
                        "updated_at": "2019-09-26 12:44:50",
                        "image": [
                            {
                                "img_id": 12,
                                "img_product": 8,
                                "img_src": "\/product\/2-4_0021_quandai_476689498.png",
                                "img_name": "Quần dài 12",
                                "img_alias": "quan-dai-12",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:44:49",
                                "updated_at": "2019-09-26 12:44:50"
                            }
                        ],
                        "translations": [
                            {
                                "id": 8,
                                "product_prd_id": 8,
                                "prd_name": "Quần dài",
                                "prd_alias": "quan-dai",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 9,
                        "prd_name": "Quần ngắn",
                        "prd_alias": "quan-ngan",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:45:01",
                        "updated_at": "2019-09-26 12:45:01",
                        "image": [
                            {
                                "img_id": 13,
                                "img_product": 9,
                                "img_src": "\/product\/2-4_0020_quanngan_476700397.png",
                                "img_name": "Quần ngắn 13",
                                "img_alias": "quan-ngan-13",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:45:00",
                                "updated_at": "2019-09-26 12:45:01"
                            }
                        ],
                        "translations": [
                            {
                                "id": 9,
                                "product_prd_id": 9,
                                "prd_name": "Quần ngắn",
                                "prd_alias": "quan-ngan",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 10,
                        "prd_name": "Váy liền",
                        "prd_alias": "vay-lien",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:45:13",
                        "updated_at": "2019-09-26 12:45:13",
                        "image": [
                            {
                                "img_id": 14,
                                "img_product": 10,
                                "img_src": "\/product\/vay-lien_476712765.jpg",
                                "img_name": "Váy liền 14",
                                "img_alias": "vay-lien-14",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:45:12",
                                "updated_at": "2019-09-26 12:45:13"
                            }
                        ],
                        "translations": [
                            {
                                "id": 10,
                                "product_prd_id": 10,
                                "prd_name": "Váy liền",
                                "prd_alias": "vay-lien",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 11,
                        "prd_name": "Chân váy",
                        "prd_alias": "chan-vay",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:45:22",
                        "updated_at": "2019-09-26 12:45:22",
                        "image": [
                            {
                                "img_id": 15,
                                "img_product": 11,
                                "img_src": "\/product\/2-4_0018_chanvay_476720920.png",
                                "img_name": "Chân váy 15",
                                "img_alias": "chan-vay-15",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:45:20",
                                "updated_at": "2019-09-26 12:45:22"
                            }
                        ],
                        "translations": [
                            {
                                "id": 11,
                                "product_prd_id": 11,
                                "prd_name": "Chân váy",
                                "prd_alias": "chan-vay",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 12,
                        "prd_name": "Hàng dệt kim & Đan móc",
                        "prd_alias": "hang-det-kim-dan-moc",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:45:44",
                        "updated_at": "2019-09-26 12:45:44",
                        "image": [
                            {
                                "img_id": 16,
                                "img_product": 12,
                                "img_src": "\/product\/dan-moc_476742978.jpg",
                                "img_name": "Hàng dệt kim & Đan móc 16",
                                "img_alias": "hang-det-kim-dan-moc-16",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:45:42",
                                "updated_at": "2019-09-26 12:45:44"
                            }
                        ],
                        "translations": [
                            {
                                "id": 12,
                                "product_prd_id": 12,
                                "prd_name": "Hàng dệt kim & Đan móc",
                                "prd_alias": "hang-det-kim-dan-moc",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 13,
                        "prd_name": "Vải bò",
                        "prd_alias": "vai-bo",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:45:56",
                        "updated_at": "2019-10-07 17:39:09",
                        "image": [
                            {
                                "img_id": 17,
                                "img_product": 13,
                                "img_src": "\/product\/2-4_0016_dobo_476755491.png",
                                "img_name": "Vải bò 17",
                                "img_alias": "vai-bo-17",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:45:55",
                                "updated_at": "2019-09-26 12:45:56"
                            }
                        ],
                        "translations": [
                            {
                                "id": 13,
                                "product_prd_id": 13,
                                "prd_name": "Vải bò",
                                "prd_alias": "vai-bo",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 14,
                        "prd_name": "Đồ lót",
                        "prd_alias": "do-lot",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:46:05",
                        "updated_at": "2019-09-26 12:46:05",
                        "image": [
                            {
                                "img_id": 18,
                                "img_product": 14,
                                "img_src": "\/product\/2-4_0015_dolot_476764188.png",
                                "img_name": "Đồ lót 18",
                                "img_alias": "do-lot-18",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:46:04",
                                "updated_at": "2019-09-26 12:46:05"
                            }
                        ],
                        "translations": [
                            {
                                "id": 14,
                                "product_prd_id": 14,
                                "prd_name": "Đồ lót",
                                "prd_alias": "do-lot",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 15,
                        "prd_name": "Quần áo ngủ",
                        "prd_alias": "quan-ao-ngu",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:46:16",
                        "updated_at": "2019-09-26 12:46:16",
                        "image": [
                            {
                                "img_id": 19,
                                "img_product": 15,
                                "img_src": "\/product\/2-4_0014_quanaongu_476775131.png",
                                "img_name": "Quần áo ngủ 19",
                                "img_alias": "quan-ao-ngu-19",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:46:15",
                                "updated_at": "2019-09-26 12:46:16"
                            }
                        ],
                        "translations": [
                            {
                                "id": 15,
                                "product_prd_id": 15,
                                "prd_name": "Quần áo ngủ",
                                "prd_alias": "quan-ao-ngu",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 16,
                        "prd_name": "Đồ thể thao",
                        "prd_alias": "do-the-thao",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:46:24",
                        "updated_at": "2019-09-26 12:46:24",
                        "image": [
                            {
                                "img_id": 20,
                                "img_product": 16,
                                "img_src": "\/product\/2-4_0013_dothethao_476782875.png",
                                "img_name": "Đồ thể thao 20",
                                "img_alias": "do-the-thao-20",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:46:22",
                                "updated_at": "2019-09-26 12:46:24"
                            }
                        ],
                        "translations": [
                            {
                                "id": 16,
                                "product_prd_id": 16,
                                "prd_name": "Đồ thể thao",
                                "prd_alias": "do-the-thao",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 17,
                        "prd_name": "Đồ ngoại cỡ",
                        "prd_alias": "do-ngoai-co",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:46:38",
                        "updated_at": "2019-09-26 12:46:38",
                        "image": [
                            {
                                "img_id": 21,
                                "img_product": 17,
                                "img_src": "\/product\/ngoai-co.jpg",
                                "img_name": "Đồ ngoại cỡ 21",
                                "img_alias": "do-ngoai-co-21",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:46:36",
                                "updated_at": "2019-09-26 12:46:38"
                            }
                        ],
                        "translations": [
                            {
                                "id": 17,
                                "product_prd_id": 17,
                                "prd_name": "Đồ ngoại cỡ",
                                "prd_alias": "do-ngoai-co",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 18,
                        "prd_name": "Đồ bầu",
                        "prd_alias": "do-bau",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:46:47",
                        "updated_at": "2019-09-26 12:46:47",
                        "image": [
                            {
                                "img_id": 32,
                                "img_product": 18,
                                "img_src": "\/product\/do-bau.jpg",
                                "img_name": "Đồ bầu 32",
                                "img_alias": "do-bau-32",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-10-07 16:32:29",
                                "updated_at": "2019-10-07 16:32:32"
                            }
                        ],
                        "translations": [
                            {
                                "id": 18,
                                "product_prd_id": 18,
                                "prd_name": "Đồ bầu",
                                "prd_alias": "do-bau",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 41,
                        "prd_name": "Đồng phục",
                        "prd_alias": "dong-phuc",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 1,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-10-09 16:37:15",
                        "updated_at": "2019-10-09 16:37:15",
                        "image": [
                            {
                                "img_id": 39,
                                "img_product": 41,
                                "img_src": "\/product\/dong-phuc.jpg",
                                "img_name": "Đồng phục 39",
                                "img_alias": "dong-phuc-39",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-10-09 16:37:07",
                                "updated_at": "2019-10-09 16:37:15"
                            }
                        ],
                        "translations": [
                            {
                                "id": 41,
                                "product_prd_id": 41,
                                "prd_name": "Đồng phục",
                                "prd_alias": "dong-phuc",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    }
                ],
                "translations": [
                    {
                        "id": 1,
                        "cate_product_cate_id": 1,
                        "cate_value": "Quần áo",
                        "cate_alias": "quan-ao",
                        "cate_size": "",
                        "locale": "vi"
                    }
                ]
            },
            {
                "cate_id": 2,
                "cate_name": "Đồ trẻ em",
                "cate_value": "Đồ trẻ em",
                "cate_code": null,
                "cate_parent": 0,
                "cate_alias": "do-tre-em",
                "cate_size": null,
                "cate_featureImg": null,
                "cate_status": 1,
                "cate_order": 0,
                "created_at": "2019-09-26 12:41:38",
                "updated_at": "2019-09-26 12:41:38",
                "product": [
                    {
                        "prd_id": 19,
                        "prd_name": "Sơ sinh (0-9 tháng)",
                        "prd_alias": "so-sinh-0-9-thang",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 2,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:47:01",
                        "updated_at": "2019-09-26 12:47:01",
                        "image": [
                            {
                                "img_id": 33,
                                "img_product": 19,
                                "img_src": "\/product\/so-sinh_440772178.jpg",
                                "img_name": "Sơ sinh (0-9 tháng) 33",
                                "img_alias": "so-sinh-0-9-thang-33",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-10-07 16:32:52",
                                "updated_at": "2019-10-07 16:32:54"
                            }
                        ],
                        "translations": [
                            {
                                "id": 19,
                                "product_prd_id": 19,
                                "prd_name": "Sơ sinh (0-9 tháng)",
                                "prd_alias": "so-sinh-0-9-thang",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 20,
                        "prd_name": "4 tháng - 4 tuổi",
                        "prd_alias": "4-thang-4-tuoi",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 2,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:47:13",
                        "updated_at": "2019-09-26 12:47:13",
                        "image": [
                            {
                                "img_id": 34,
                                "img_product": 20,
                                "img_src": "\/product\/2-4_0009_4t14t_440940245.png",
                                "img_name": "4 tháng - 4 tuổi 34",
                                "img_alias": "4-thang-4-tuoi-34",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-10-07 16:35:40",
                                "updated_at": "2019-10-07 16:35:42"
                            }
                        ],
                        "translations": [
                            {
                                "id": 20,
                                "product_prd_id": 20,
                                "prd_name": "4 tháng - 4 tuổi",
                                "prd_alias": "4-thang-4-tuoi",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 21,
                        "prd_name": "1.5  tuổi - 10 tuổi",
                        "prd_alias": "15-tuoi-10-tuoi",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 2,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:47:30",
                        "updated_at": "2019-09-26 12:47:30",
                        "image": [
                            {
                                "img_id": 35,
                                "img_product": 21,
                                "img_src": "\/product\/2-4_0008_15t10t_440960941.png",
                                "img_name": "1.5  tuổi - 10 tuổi 35",
                                "img_alias": "15-tuoi-10-tuoi-35",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-10-07 16:36:00",
                                "updated_at": "2019-10-07 16:36:30"
                            }
                        ],
                        "translations": [
                            {
                                "id": 21,
                                "product_prd_id": 21,
                                "prd_name": "1.5  tuổi - 10 tuổi",
                                "prd_alias": "15-tuoi-10-tuoi",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 22,
                        "prd_name": "8 tuổi - 14+ tuổi",
                        "prd_alias": "8-tuoi-14-tuoi",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 2,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:47:49",
                        "updated_at": "2019-09-26 12:47:49",
                        "image": [
                            {
                                "img_id": 36,
                                "img_product": 22,
                                "img_src": "\/product\/2-4_0007_8t14t_441008533.png",
                                "img_name": "8 tuổi - 14+ tuổi 36",
                                "img_alias": "8-tuoi-14-tuoi-36",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-10-07 16:36:48",
                                "updated_at": "2019-10-07 16:36:50"
                            }
                        ],
                        "translations": [
                            {
                                "id": 22,
                                "product_prd_id": 22,
                                "prd_name": "8 tuổi - 14+ tuổi",
                                "prd_alias": "8-tuoi-14-tuoi",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    }
                ],
                "translations": [
                    {
                        "id": 2,
                        "cate_product_cate_id": 2,
                        "cate_value": "Đồ trẻ em",
                        "cate_alias": "do-tre-em",
                        "cate_size": "",
                        "locale": "vi"
                    }
                ]
            },
            {
                "cate_id": 3,
                "cate_name": "Đồ khác",
                "cate_value": "Đồ khác",
                "cate_code": null,
                "cate_parent": 0,
                "cate_alias": "do-khac",
                "cate_size": null,
                "cate_featureImg": null,
                "cate_status": 1,
                "cate_order": 0,
                "created_at": "2019-09-26 12:41:42",
                "updated_at": "2019-09-26 12:41:42",
                "product": [
                    {
                        "prd_id": 24,
                        "prd_name": "Tất",
                        "prd_alias": "tat",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 3,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:53:26",
                        "updated_at": "2019-09-26 12:53:26",
                        "image": [
                            {
                                "img_id": 27,
                                "img_product": 24,
                                "img_src": "\/product\/2-4_0006_tat_477202231.png",
                                "img_name": "Tất 27",
                                "img_alias": "tat-27",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:53:22",
                                "updated_at": "2019-09-26 12:53:26"
                            }
                        ],
                        "translations": [
                            {
                                "id": 24,
                                "product_prd_id": 24,
                                "prd_name": "Tất",
                                "prd_alias": "tat",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 25,
                        "prd_name": "Đồ da",
                        "prd_alias": "do-da",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 3,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:53:49",
                        "updated_at": "2019-09-26 12:53:49",
                        "image": [
                            {
                                "img_id": 28,
                                "img_product": 25,
                                "img_src": "\/product\/2-4_0005_doda_477227457.png",
                                "img_name": "Đồ da 28",
                                "img_alias": "do-da-28",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:53:47",
                                "updated_at": "2019-09-26 12:53:49"
                            }
                        ],
                        "translations": [
                            {
                                "id": 25,
                                "product_prd_id": 25,
                                "prd_name": "Đồ da",
                                "prd_alias": "do-da",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 26,
                        "prd_name": "Chăn ga gối đệm",
                        "prd_alias": "chan-ga-goi-dem",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 3,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:53:57",
                        "updated_at": "2019-09-26 12:53:57",
                        "image": [
                            {
                                "img_id": 29,
                                "img_product": 26,
                                "img_src": "\/product\/2-4_0004_changa_477236492.png",
                                "img_name": "Chăn ga gối đệm 29",
                                "img_alias": "chan-ga-goi-dem-29",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:53:56",
                                "updated_at": "2019-09-26 12:53:57"
                            }
                        ],
                        "translations": [
                            {
                                "id": 26,
                                "product_prd_id": 26,
                                "prd_name": "Chăn ga gối đệm",
                                "prd_alias": "chan-ga-goi-dem",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    },
                    {
                        "prd_id": 28,
                        "prd_name": "Túi",
                        "prd_alias": "tui",
                        "prd_sapo": null,
                        "prd_SKU": null,
                        "prd_des": null,
                        "prd_spec": null,
                        "prd_price": null,
                        "prd_priceNow": -1,
                        "prd_quantity": 1,
                        "prd_code": null,
                        "prd_sold": 0,
                        "prd_view": 0,
                        "prd_cate": 3,
                        "prd_type": 1,
                        "prd_tag": "",
                        "prd_status": 1,
                        "prd_order": 0,
                        "prd_promote": 0,
                        "prd_featureImg": null,
                        "prd_createdBy": 12,
                        "created_at": "2019-09-26 12:54:55",
                        "updated_at": "2019-09-26 12:54:55",
                        "image": [
                            {
                                "img_id": 31,
                                "img_product": 28,
                                "img_src": "\/product\/227dedf94f6ea830f17f_477293320.jpg",
                                "img_name": "Túi 31",
                                "img_alias": "tui-31",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-09-26 12:54:53",
                                "updated_at": "2019-09-26 12:54:55"
                            }
                        ],
                        "translations": [
                            {
                                "id": 28,
                                "product_prd_id": 28,
                                "prd_name": "Túi",
                                "prd_alias": "tui",
                                "prd_sapo": null,
                                "prd_des": null,
                                "prd_spec": null,
                                "locale": "vi"
                            }
                        ]
                    }
                ],
                "translations": [
                    {
                        "id": 3,
                        "cate_product_cate_id": 3,
                        "cate_value": "Đồ khác",
                        "cate_alias": "do-khac",
                        "cate_size": "",
                        "locale": "vi"
                    }
                ]
            }
        ]
    }
}
```

### HTTP Request
`GET api/products`


<!-- END_86e0ac5d4f8ce9853bc22fd08f2a0109 -->

<!-- START_3b2036eb29070e60706eae0d46302fc9 -->
## api/supplier/detail/{id}
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/supplier/detail/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/detail/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Success",
    "data": {
        "supplier": {
            "sp_id": 1,
            "sp_code": "XM1910041",
            "sp_name": "BA Alium",
            "sp_alias": "ba-alium",
            "sp_user": 0,
            "sp_manager": "0",
            "sp_email": "abc@gmail.com",
            "sp_phone": "123456789",
            "sp_banner": null,
            "sp_avatar": null,
            "sp_location": "123 abc",
            "sp_locationId": null,
            "sp_city": 2,
            "sp_minQuantity": 100,
            "sp_maxQuantity": 10000,
            "sp_numEmployee": 100,
            "sp_archive": null,
            "sp_qualityOrder": 1,
            "sp_licenseId": 1,
            "sp_businessLicense": "1",
            "sp_point": 0,
            "sp_rate": 0,
            "sp_numRate": 0,
            "sp_init": null,
            "sp_otherProduct": null,
            "sp_image": null,
            "sp_service": null,
            "sp_type": 1,
            "sp_status": 1,
            "sp_createdBy": 0,
            "created_at": "2019-10-04 12:21:05",
            "updated_at": "2019-10-04 12:21:05",
            "typeSupplier": "Nhận gia công cắt - may - hoàn thiện",
            "qualityOrder": "Hàng trung bình",
            "image": [],
            "city": {
                "city_id": 2,
                "city_code": "HN",
                "city_name": "Hà Nội",
                "city_alias": "",
                "city_country": 245,
                "city_order": 2,
                "city_status": 1,
                "created_at": null,
                "updated_at": null
            }
        },
        "rate": []
    }
}
```

### HTTP Request
`GET api/supplier/detail/{id}`


<!-- END_3b2036eb29070e60706eae0d46302fc9 -->

<!-- START_b6867f3b2cf72d2224c6dc7ee797e109 -->
## api/static-content
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/static-content" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/static-content"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Success",
    "data": {
        "alias": null,
        "config": {
            "id": 1,
            "name": "0.1.1-alpha",
            "title": "Phiên bản",
            "icon": ""
        }
    }
}
```

### HTTP Request
`GET api/static-content`


<!-- END_b6867f3b2cf72d2224c6dc7ee797e109 -->

<!-- START_adac9e88740374a336aed72c417ac24b -->
## api/user/info
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/user/info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/user/info"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 203,
    "message": "Token is required",
    "data": []
}
```

### HTTP Request
`GET api/user/info`


<!-- END_adac9e88740374a336aed72c417ac24b -->

<!-- START_72b90abec8b2584f33ab57648a653280 -->
## api/user/edit
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/user/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/user/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/edit`


<!-- END_72b90abec8b2584f33ab57648a653280 -->

<!-- START_5bc148cfbe1dc47418893254e6befee9 -->
## api/user/change-pass
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/user/change-pass" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/user/change-pass"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/change-pass`


<!-- END_5bc148cfbe1dc47418893254e6befee9 -->

<!-- START_ad53309211664c06e130f49e92eb0a00 -->
## api/orders/rate
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/orders/rate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/orders/rate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/orders/rate`


<!-- END_ad53309211664c06e130f49e92eb0a00 -->

<!-- START_f8c780578b4f7f72b21b9d8bf035fb91 -->
## api/orders/upload-image
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/orders/upload-image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/orders/upload-image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/orders/upload-image`


<!-- END_f8c780578b4f7f72b21b9d8bf035fb91 -->

<!-- START_b10e4a4a5a5c72152f1faf222bf00490 -->
## api/orders/reorder/{code}
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/orders/reorder/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/orders/reorder/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 203,
    "message": "Token is required",
    "data": []
}
```

### HTTP Request
`GET api/orders/reorder/{code}`


<!-- END_b10e4a4a5a5c72152f1faf222bf00490 -->

<!-- START_f9301c03a9281c0847565f96e6f723de -->
## api/orders
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 203,
    "message": "Token is required",
    "data": []
}
```

### HTTP Request
`GET api/orders`


<!-- END_f9301c03a9281c0847565f96e6f723de -->

<!-- START_285c87403b6cfdebe26bc357f22e870f -->
## api/orders
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/orders`


<!-- END_285c87403b6cfdebe26bc357f22e870f -->

<!-- START_7e6be1b9dd04564a7b1298dd260f3183 -->
## api/orders/{order}
> Example request:

```bash
curl -X GET \
    -G "https://alium.vn/api/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 203,
    "message": "Token is required",
    "data": []
}
```

### HTTP Request
`GET api/orders/{order}`


<!-- END_7e6be1b9dd04564a7b1298dd260f3183 -->

<!-- START_37f7b8cec13991c44b134bb2186e9d1e -->
## api/orders/{order}
> Example request:

```bash
curl -X PUT \
    "https://alium.vn/api/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/orders/{order}`

`PATCH api/orders/{order}`


<!-- END_37f7b8cec13991c44b134bb2186e9d1e -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## api/logout
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

<!-- START_cadad8c9a7cbcb11ced37c6856fbbc6a -->
## api/feedback
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/feedback" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/feedback"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/feedback`


<!-- END_cadad8c9a7cbcb11ced37c6856fbbc6a -->

<!-- START_b45b029043764422619d50b713d6b2dd -->
## api/supplier/register
> Example request:

```bash
curl -X POST \
    "https://alium.vn/api/supplier/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://alium.vn/api/supplier/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/supplier/register`


<!-- END_b45b029043764422619d50b713d6b2dd -->


