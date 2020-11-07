<?php

function verifyDistance(string $origins, string $destinations)
{
  $client = service('curlrequest');

  $optionsRequest = [
    'baseURI' => 'https://maps.googleapis.com/maps/api/distancematrix/json',
    'timeout' => 3,
    'query' => [
      'origins' => $origins,
      'destinations' => $destinations,
      'language' => 'pt-BR',
      'key' => env('GOOGLE_API_KEY')
    ]
  ];

  $response = $client->get('json', $optionsRequest);
  $response = json_decode($response->getBody());

  return $response->rows[0]->elements[0];
}