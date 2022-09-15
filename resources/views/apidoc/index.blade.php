<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="/docs/css/style.css" />
    <script src="/docs/js/all.js"></script>


          <script>
        $(function() {
            setupLanguages(["bash","javascript"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="/docs/images/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/docs/images/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="bash">bash</a>
                                  <a href="#" data-language-name="javascript">javascript</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
                    <ul class="toc-footer">
                                  <li><a href='https://alium.vn'>Documentation Powered Alium Dev Team</a></li>
                            </ul>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>Info</h1>
<p>Welcome to the generated API reference.
<a href="{{ route("apidoc.json") }}">Get Postman Collection</a></p>
<!-- END_INFO -->
<h1>SUPPLIER MANAGER INFO</h1>
<!-- START_7fe264e49ccd6246233149954fa9413b -->
<h2>APIs for update user info in supplier app</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/edit-info?%5C=nulla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"dataUpdate:":{},"dataUpdate":{"user_showName":"sunt","user_phone":"aut","user_city":11820686.9271982,"user_address":"qui","user_birthday":"odio","user_gender":"perspiciatis"},"newPassword:":"veniam"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/edit-info"
);

let params = {
    "\": "nulla",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "dataUpdate:": {},
    "dataUpdate": {
        "user_showName": "sunt",
        "user_phone": "aut",
        "user_city": 11820686.9271982,
        "user_address": "qui",
        "user_birthday": "odio",
        "user_gender": "perspiciatis"
    },
    "newPassword:": "veniam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "status": 200,
    "message": "Successful"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/edit-info</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>\</code></td>
<td>optional</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>\</code></td>
<td>optional</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>dataUpdate:</code></td>
<td>object</td>
<td>optional</td>
<td>array of key=&gt;value, don't send info if don't change value</td>
</tr>
<tr>
<td><code>dataUpdate.user_showName</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>dataUpdate.user_phone</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>dataUpdate.user_city</code></td>
<td>number</td>
<td>optional</td>
<td>number of city</td>
</tr>
<tr>
<td><code>dataUpdate.user_address</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>dataUpdate.user_birthday</code></td>
<td>string</td>
<td>optional</td>
<td>format 'mm/dd/yyyy'</td>
</tr>
<tr>
<td><code>dataUpdate.user_gender</code></td>
<td>string</td>
<td>optional</td>
<td>nam/nu</td>
</tr>
<tr>
<td><code>newPassword:</code></td>
<td>string</td>
<td>optional</td>
<td>if change password</td>
</tr>
</tbody>
</table>
<!-- END_7fe264e49ccd6246233149954fa9413b -->
<h1>UPDATE SUPPLIER PROFILE</h1>
<!-- START_b7c29375cc2f348df7814e7db3d99688 -->
<h2>APIs for delete image in order of supplier</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/supplier/delete-image/1?%5C=quo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/delete-image/1"
);

let params = {
    "\": "quo",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "status": 200,
    "message": "Successful"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/supplier/delete-image/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>\</code></td>
<td>optional</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>\</code></td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_b7c29375cc2f348df7814e7db3d99688 -->
<h1>general</h1>
<!-- START_2e1c96dcffcfe7e0eb58d6408f1d619e -->
<h2>api/auth/register</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/auth/register</code></p>
<!-- END_2e1c96dcffcfe7e0eb58d6408f1d619e -->
<!-- START_a925a8d22b3615f12fca79456d286859 -->
<h2>api/auth/login</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/auth/login</code></p>
<!-- END_a925a8d22b3615f12fca79456d286859 -->
<!-- START_9da68c10804b0a454fb3549419d5d9f0 -->
<h2>api/auth/login-social</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/auth/login-social" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/auth/login-social</code></p>
<!-- END_9da68c10804b0a454fb3549419d5d9f0 -->
<!-- START_19ff1b6f8ce19d3c444e9b518e8f7160 -->
<h2>api/auth/logout</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/auth/logout</code></p>
<!-- END_19ff1b6f8ce19d3c444e9b518e8f7160 -->
<!-- START_98d3199ce15557d4baa898440152e117 -->
<h2>api/auth/reset-password</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/auth/reset-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 501,
    "message": "Success",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/auth/reset-password</code></p>
<!-- END_98d3199ce15557d4baa898440152e117 -->
<!-- START_bee4c3298d5e5aa2acddb5486921e94b -->
<h2>api/auth/reset-password</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/auth/reset-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/auth/reset-password</code></p>
<!-- END_bee4c3298d5e5aa2acddb5486921e94b -->
<!-- START_85b3ab2892b2c9ce5058487fbff8ed13 -->
<h2>api/auth/register/send-code</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/auth/register/send-code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/auth/register/send-code</code></p>
<!-- END_85b3ab2892b2c9ce5058487fbff8ed13 -->
<!-- START_f3183b2482a59c99229331315d0b116b -->
<h2>api/auth/register/verify-code</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/auth/register/verify-code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/auth/register/verify-code</code></p>
<!-- END_f3183b2482a59c99229331315d0b116b -->
<!-- START_86e0ac5d4f8ce9853bc22fd08f2a0109 -->
<h2>api/products</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
                        "prd_name": "Áo sơ mi &amp; Áo cánh",
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
                                "img_name": "Áo sơ mi &amp; Áo cánh 4",
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
                                "prd_name": "Áo sơ mi &amp; Áo cánh",
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
                        "prd_name": "Áo phông &amp; Áo polo",
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
                                "img_name": "Áo phông &amp; Áo polo 5",
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
                                "prd_name": "Áo phông &amp; Áo polo",
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
                        "prd_name": "Áo nỉ len &amp; Hoodie",
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
                                "img_name": "Áo nỉ len &amp; Hoodie 9",
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
                                "prd_name": "Áo nỉ len &amp; Hoodie",
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
                        "prd_name": "Hàng dệt kim &amp; Đan móc",
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
                                "img_name": "Hàng dệt kim &amp; Đan móc 16",
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
                                "prd_name": "Hàng dệt kim &amp; Đan móc",
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
                    },
                    {
                        "prd_id": 44,
                        "prd_name": "Áo dài",
                        "prd_alias": "ao-dai",
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
                        "created_at": "2019-11-09 08:11:59",
                        "updated_at": "2019-11-09 08:11:59",
                        "image": [
                            {
                                "img_id": 40,
                                "img_product": 44,
                                "img_src": "\/product\/ao-dai.jpg",
                                "img_name": "Áo dài 40",
                                "img_alias": "ao-dai-40",
                                "img_status": 1,
                                "img_shape": 0,
                                "created_at": "2019-11-09 08:11:56",
                                "updated_at": "2019-11-09 08:11:59"
                            }
                        ],
                        "translations": [
                            {
                                "id": 44,
                                "product_prd_id": 44,
                                "prd_name": "Áo dài",
                                "prd_alias": "ao-dai",
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
                        "cate_size": null,
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
                        "cate_size": null,
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
                    },
                    {
                        "prd_id": 45,
                        "prd_name": "Đồ Khác",
                        "prd_alias": "do-khac",
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
                        "prd_createdBy": 27,
                        "created_at": "2019-11-11 11:50:35",
                        "updated_at": "2019-11-11 11:50:35",
                        "image": [],
                        "translations": [
                            {
                                "id": 45,
                                "product_prd_id": 45,
                                "prd_name": "Đồ Khác",
                                "prd_alias": "do-khac",
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
                        "cate_size": null,
                        "locale": "vi"
                    }
                ]
            }
        ]
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/products</code></p>
<!-- END_86e0ac5d4f8ce9853bc22fd08f2a0109 -->
<!-- START_3b2036eb29070e60706eae0d46302fc9 -->
<h2>api/supplier/detail/{id}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/supplier/detail/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 200,
    "message": "Success",
    "data": {
        "supplier": {
            "sp_id": 1,
            "sp_code": "XM1909261",
            "sp_name": "xuong test",
            "sp_alias": "xuong-test",
            "sp_user": 0,
            "sp_manager": null,
            "sp_email": "111@alium.vn",
            "sp_phone": "1111111111",
            "sp_banner": null,
            "sp_avatar": "supplier\/feature\/anh-xuong-_shndk190081.jpg",
            "sp_location": "111@alium.vn",
            "sp_locationId": null,
            "sp_city": 1,
            "sp_minQuantity": 50,
            "sp_maxQuantity": 1000,
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
            "sp_image": "product\/anh-xuong-_shndk190082.jpg",
            "sp_service": null,
            "sp_type": 1,
            "sp_status": 1,
            "sp_createdBy": 0,
            "created_at": "2019-09-26 14:15:26",
            "updated_at": "2019-09-26 14:15:26",
            "typeSupplier": "Nhận gia công cắt - may - hoàn thiện",
            "qualityOrder": "Hàng trung bình",
            "image": [
                "product\/anh-xuong-_shndk190082.jpg"
            ],
            "city": {
                "city_id": 1,
                "city_code": "SG",
                "city_name": "Hồ Chí Minh",
                "city_alias": "",
                "city_country": 245,
                "city_order": 1,
                "city_status": 1,
                "created_at": null,
                "updated_at": null
            }
        },
        "rate": []
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/supplier/detail/{id}</code></p>
<!-- END_3b2036eb29070e60706eae0d46302fc9 -->
<!-- START_b6867f3b2cf72d2224c6dc7ee797e109 -->
<h2>api/static-content</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/static-content" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/static-content</code></p>
<!-- END_b6867f3b2cf72d2224c6dc7ee797e109 -->
<!-- START_adac9e88740374a336aed72c417ac24b -->
<h2>api/user/info</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/user/info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/user/info</code></p>
<!-- END_adac9e88740374a336aed72c417ac24b -->
<!-- START_72b90abec8b2584f33ab57648a653280 -->
<h2>api/user/edit</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/user/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/user/edit</code></p>
<!-- END_72b90abec8b2584f33ab57648a653280 -->
<!-- START_cc8fb33434ac736c24d499da90d47093 -->
<h2>api/user/notify</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/user/notify" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/user/notify"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/user/notify</code></p>
<!-- END_cc8fb33434ac736c24d499da90d47093 -->
<!-- START_a2723a7a2fe36dc3dcaf3ce5f2ff357b -->
<h2>api/user/notify/read/{id}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/user/notify/read/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/user/notify/read/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/user/notify/read/{id}</code></p>
<!-- END_a2723a7a2fe36dc3dcaf3ce5f2ff357b -->
<!-- START_5bc148cfbe1dc47418893254e6befee9 -->
<h2>api/user/change-pass</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/user/change-pass" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/user/change-pass</code></p>
<!-- END_5bc148cfbe1dc47418893254e6befee9 -->
<!-- START_ad53309211664c06e130f49e92eb0a00 -->
<h2>api/orders/rate</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/orders/rate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/orders/rate</code></p>
<!-- END_ad53309211664c06e130f49e92eb0a00 -->
<!-- START_f8c780578b4f7f72b21b9d8bf035fb91 -->
<h2>api/orders/upload-image</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/orders/upload-image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/orders/upload-image</code></p>
<!-- END_f8c780578b4f7f72b21b9d8bf035fb91 -->
<!-- START_b10e4a4a5a5c72152f1faf222bf00490 -->
<h2>api/orders/reorder/{code}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/orders/reorder/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/orders/reorder/{code}</code></p>
<!-- END_b10e4a4a5a5c72152f1faf222bf00490 -->
<!-- START_f9301c03a9281c0847565f96e6f723de -->
<h2>api/orders</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/orders</code></p>
<!-- END_f9301c03a9281c0847565f96e6f723de -->
<!-- START_285c87403b6cfdebe26bc357f22e870f -->
<h2>api/orders</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/orders</code></p>
<!-- END_285c87403b6cfdebe26bc357f22e870f -->
<!-- START_7e6be1b9dd04564a7b1298dd260f3183 -->
<h2>api/orders/{order}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/orders/{order}</code></p>
<!-- END_7e6be1b9dd04564a7b1298dd260f3183 -->
<!-- START_37f7b8cec13991c44b134bb2186e9d1e -->
<h2>api/orders/{order}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://alium.vn/api/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/orders/{order}</code></p>
<p><code>PATCH api/orders/{order}</code></p>
<!-- END_37f7b8cec13991c44b134bb2186e9d1e -->
<!-- START_61739f3220a224b34228600649230ad1 -->
<h2>api/logout</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/logout</code></p>
<!-- END_61739f3220a224b34228600649230ad1 -->
<!-- START_32d50d09882ac6688f38a6242707c1c4 -->
<h2>api/list-country</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/list-country" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/list-country"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/list-country</code></p>
<!-- END_32d50d09882ac6688f38a6242707c1c4 -->
<!-- START_2ef56f67f345f090d108c9d2b321a23c -->
<h2>api/list-city/{id}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/list-city/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/list-city/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/list-city/{id}</code></p>
<!-- END_2ef56f67f345f090d108c9d2b321a23c -->
<!-- START_391ab14d343fc30cb87be8769d969fef -->
<h2>api/list-district/{id}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/list-district/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/list-district/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/list-district/{id}</code></p>
<!-- END_391ab14d343fc30cb87be8769d969fef -->
<!-- START_cadad8c9a7cbcb11ced37c6856fbbc6a -->
<h2>api/feedback</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/feedback" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/feedback</code></p>
<!-- END_cadad8c9a7cbcb11ced37c6856fbbc6a -->
<!-- START_a465377b05b8af48aa9d3197670997ca -->
<h2>api/supplier/login</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/login</code></p>
<!-- END_a465377b05b8af48aa9d3197670997ca -->
<!-- START_b45b029043764422619d50b713d6b2dd -->
<h2>api/supplier/register</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/register</code></p>
<!-- END_b45b029043764422619d50b713d6b2dd -->
<!-- START_385f58715661f8003b89fa2a97adb61e -->
<h2>api/supplier/get-info</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/get-info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/get-info"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/get-info</code></p>
<!-- END_385f58715661f8003b89fa2a97adb61e -->
<!-- START_40aa7805cb9839a8e5f673cd710ffac6 -->
<h2>api/supplier/update-info</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/update-info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/update-info"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/update-info</code></p>
<!-- END_40aa7805cb9839a8e5f673cd710ffac6 -->
<!-- START_6dc4200b6d84f14ec8b730e3a3322c90 -->
<h2>api/supplier/list-order</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://alium.vn/api/supplier/list-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/list-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "status": 203,
    "message": "Token is required",
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/supplier/list-order</code></p>
<!-- END_6dc4200b6d84f14ec8b730e3a3322c90 -->
<!-- START_538ddd220da6d382c427921b9acd28c7 -->
<h2>api/supplier/add-order</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/add-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/add-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/add-order</code></p>
<!-- END_538ddd220da6d382c427921b9acd28c7 -->
<!-- START_6b6260f2dfc571ac334a1b1befa0f79b -->
<h2>api/supplier/upload-image</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/upload-image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/upload-image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/upload-image</code></p>
<!-- END_6b6260f2dfc571ac334a1b1befa0f79b -->
<!-- START_04808c00af586c35a7efadf04c468539 -->
<h2>api/supplier/update-order</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/update-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/update-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/update-order</code></p>
<!-- END_04808c00af586c35a7efadf04c468539 -->
<!-- START_4f05d2049a8c88c266bc84831a6352ae -->
<h2>api/supplier/logout</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://alium.vn/api/supplier/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://alium.vn/api/supplier/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/supplier/logout</code></p>
<!-- END_4f05d2049a8c88c266bc84831a6352ae -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                              </div>
                </div>
    </div>
  </body>
</html>