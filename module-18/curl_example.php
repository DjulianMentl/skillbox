<?php

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://catfact.ninja/fact');
curl_setopt($curl, CURLOPT_HTTPGET, 1);
curl_setopt($curl, CURLOPT_PORT, 443);
echo curl_exec($curl);