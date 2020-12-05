<?php
session_start();

use App\Controllers\Location as ControllersLocation;
use App\Core\Route;
use App\Models\Location;
use App\Models\User;

require_once '../vendor/autoload.php';

define('APP_NAME', 'BTC');
define('APP_URL', 'http://tridex.test/');
define('ASSETS', APP_URL.'public/assets/');
define('HOME', '/');
define('ABOUT', '/page/about');
define('SIGNUP', '/user/create');
define('SIGNIN', '/user/signin');
define('FORGOT_PASSWORD', '/user/forgotpassword');
define('RESET_PASSWORD', '/user/resetpassword');
define('PROFILE', '/user/profile');
define('DASHBOARD', '/user/dashboard');

define('REFERRALS', '/user/referrals');
define('ACTIVE_MEMBERS', '/user/activemembers');
define('MODERATORS', '/user/moderators');
define('INACTIVE_MEMBERS', '/user/inactivemembers');
define('BONUS', '/user/bonus');
if (isset($_SESSION['email'])) {
    if (User::isMember() || User::isModerator()) {
        define('ACTIVE_INVESTMENT', '/user/investment/active');
        define('PENDING_INVESTMENT', '/user/investment/pending');
        define('COMPLETED_INVESTMENT', '/user/investment/completed');
/************************************************************************************/
        define('WALLET', '/user/wallet');
/************************************************************************************/
        define('PENDING_WITHDRAWAL', '/user/withdrawal/pending');
        define('COMPLETED_WITHDRAWAL', '/user/withdrawal/completed');
        define('DEPOSIT', 'http://pay.btc.test?');
    } elseif (User::isAdmin()) {
        define('VIEW_USER', '/user/details/');
        define('ACTIVE_INVESTMENT', '/investment/active');
        define('PENDING_INVESTMENT', '/investment/pending');
        define('COMPLETED_INVESTMENT', '/investment/completed');
/************************************************************************************/
        define('PENDING_WITHDRAWAL', '/withdrawal/pending');
        define('COMPLETED_WITHDRAWAL', '/withdrawal/completed');
/************************************************************************************/
        define('WALLET', '/wallet/all');
    }
}

/************************************************************************************/

echo Route::init();
