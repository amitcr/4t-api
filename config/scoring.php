<?php
return [
    'base_url' => getenv('SCORING_BASE_URL') ?? "http://mt-scoring-staging.us-east-1.elasticbeanstalk.com/api/v1",
    'graphql_url' => getenv('GRAPHQL_BASE_URL') ?? "http://mt-scoring-staging.us-east-1.elasticbeanstalk.com/api/v1",
    'timeout'  => getenv('SCORING_TIMEOUT') ?? 10,
    'headers'  => [
        // 'Accept'       => 'application/json',
        // 'Content-Type' => 'application/json',
        'x-api-key'    => getenv('SCORING_API_KEY') ?? '',
        'x-app-id'   => getenv('SCORING_APP_ID') ?? '',
    ],
    'retries'  => getenv('SCORING_RETRIES') ?? 2,
    'retry_delay_ms' => getenv('SCORING_RETRY_DELAY_MS') ?? 200,
];
