<?php
/**
 * KofarArziki Data - Configuration File
 * Database and application settings
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'kofar_arziki');
define('DB_USER', 'root');
define('DB_PASS', '');

// Application Settings
define('APP_NAME', 'KofarArziki Data');
define('APP_URL', 'http://localhost'); // Change to your domain on production
define('APP_TIMEZONE', 'Africa/Lagos');

// Security
define('SESSION_TIMEOUT', 3600); // 1 hour in seconds
define('PASSWORD_HASH_ALGO', PASSWORD_BCRYPT);

// Referral System
define('REFERRAL_BONUS_PER_REGISTRATION', 50.00); // Naira
define('REFERRAL_BONUS_PER_SUCCESSFUL_PURCHASE', 10.00); // Naira

// Funding
define('FUNDING_CHARGE_PERCENTAGE', 1.0); // 1%
define('FUNDING_CHARGE_CAP', 50.00); // Naira - max charge

// PalmPay Account Details
define('PALMPAY_ACCOUNT_NUMBER', '6625847565');
define('PALMPAY_ACCOUNT_NAME', 'KofarArziki Data');
define('PALMPAY_PROVIDER', 'PalmPay');

// Admin
define('ADMIN_SESSION_TIMEOUT', 7200); // 2 hours

// Environment
define('ENVIRONMENT', 'development'); // 'production' or 'development'
define('DEBUG_MODE', ENVIRONMENT === 'development');

// Error Reporting
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}

// Date/Time
date_default_timezone_set(APP_TIMEZONE);

?>
