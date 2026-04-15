<?php

/**
 * GraphQL configuration.
 *
 * Enabled flag and endpoint URLs are read from WP settings (wp_options).
 * Credentials are read from .env.
 *
 * .env keys:
 *   GRAPHQL_PROD_APP_ID      — production X-App-Id
 *   GRAPHQL_PROD_API_KEY     — production X-Api-Key
 *   GRAPHQL_STAGING_APP_ID   — staging X-App-Id
 *   GRAPHQL_STAGING_API_KEY  — staging X-Api-Key
 */
return [
    'prod_app_id'     => getenv('GRAPHQL_PROD_APP_ID')     ?: '',
    'prod_api_key'    => getenv('GRAPHQL_PROD_API_KEY')    ?: '',
    'staging_app_id'  => getenv('GRAPHQL_STAGING_APP_ID')  ?: '',
    'staging_api_key' => getenv('GRAPHQL_STAGING_API_KEY') ?: '',
];
