<?php 
// config/app.php
return [
    'env' => getenv('APP_ENV') ?? 'local',
    'email' => getenv('APP_EMAIL') ?? '',
    'app_logo' => getenv('APP_LOGO') ?? '',
    'stats_sheet_id' => getenv('STATS_SHEET_ID') ?? '',
    'direct_codes' => getenv('DIRECT_CODES') ?? [],
    'mailjet_mini_list_id' => getenv('MAILJET_MINI_LIST_ID') ?? [],
    // Hours to hold a report job whose chart images are missing before retrying. Default 6.
    'report_hold_hours' => (int) (getenv('REPORT_HOLD_HOURS') ?: 6),
];
