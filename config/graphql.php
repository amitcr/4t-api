<?php
return [
    'url'     => getenv('GRAPHQL_BASE_URL') ?: 'http://mt-scoring-staging.us-east-1.elasticbeanstalk.com/graphql',
    'headers' => [
        'Content-Type' => 'application/json',
        'x-api-key'    => getenv('GRAPHQL_API_KEY') ?: getenv('SCORING_API_KEY') ?: '',
        'x-app-id'     => getenv('GRAPHQL_APP_ID') ?: getenv('SCORING_APP_ID') ?: '',
    ],
    'enabled' => getenv('GRAPHQL_ENABLED') === 'true',
];
