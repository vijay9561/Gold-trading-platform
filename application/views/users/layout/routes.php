<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method 
*/
// Page Redirect URL
$route['default_controller'] = 'Users_controller';
$route['contactus'] = 'users_controller/contactus';  
$route['register']='Users_controller/reister'; 
$route['login']='Users_controller/login'; 
$route['resest_password']='Users_controller/resest_password';
$route['kyc-verfication']='Users_controller/kyc_verfication';
$route['transaction-history']='Users_controller/transaction_history';
$route['addresses-details']='Users_controller/addresses';
$route['buy-glod']='Users_controller/buy_glod';
$route['buy_invoice']='Users_controller/mypdf'; 
$route['deposit-and-withdraw']='Users_controller/deposit_and_witdraw';
$route['my-profile']='Users_controller/my_profile';
$route['buy_trades_pdf']='Users_controller/buy_trades_pdf';
$route['sell_trades_pdf']='Users_controller/sell_trades_pdf';
$route['faq']='Users_controller/faq';
$route['Limit_Trade']='Users_controller/Limit_Trade';
$route['My-Referral']='Users_controller/my_referral';
$route['view_referral_income']='Users_controller/view_referral_income';
$route['privacy-policy']='Users_controller/privacy_policy';
$route['refund-policy']='Users_controller/refund_policy';
$route['terms-of-use']='Users_controller/terms_of_use';
$route['contact-us']='Users_controller/contact_us';
$route['gold-fixed-deposit']='Users_controller/gold_fixed_deposit';
$route['gold-fixed-deposit']='Users_controller/gold_fixed_deposit';
$route['fd-daily-earning-payout']='Users_controller/fd_daily_earning_payout';
// End URL


// Api url
$route['live_api_rates_glod1']='Api_Controller/live_api_rates_glod';
$route['users_registration']='Api_Controller/users_registration';
$route['verify_otp_password']='Api_Controller/verify_otp_password'; 
$route['login_users']='Api_Controller/login_users';
$route['Logout']='Api_Controller/Logout'; 
$route['reset_password_users']='Api_Controller/reset_password_users';
$route['reset_password']='Api_Controller/reset_password';
$route['buy_gold_calculator']='Api_Controller/buy_gold_calculator'; 
$route['get_live_rate_buy_calculator']='Api_Controller/get_live_rate_buy_calculator';
$route['add_new_addresses']='Api_Controller/add_new_addresses';
$route['deleted_addresses']='Api_Controller/deleted_addresses';
$route['purchase_gold']='Api_Controller/purchase_gold';
$route['thank_you_payment_recived']='Api_Controller/thank_you_payment_recived';
$route['procced_gold_buy_payment']='Api_Controller/procced_gold_buy_payment';
$route['buy_trade_post']='Api_Controller/buy_trade_post';
$route['sell_trade_post']='Api_Controller/sell_trade_post';
$route['cancel_buy_orders']='Api_Controller/cancel_buy_orders';
$route['cancel_sell_orders']='Api_Controller/cancel_sell_orders';
$route['get_live_rate_sell_calculator']='Api_Controller/get_live_rate_sell_calculator';
$route['get_gram_rates_fetch_ajax']='Api_Controller/get_gram_rates_fetch_ajax';
$route['fixed_deposit_gold_investement']='Api_Controller/fixed_deposit_gold_investement';

$route['limit_get_live_rate_buy_calculator']='Api_Controller/limit_get_live_rate_buy_calculator';
$route['limit_get_live_rate_sell_calculator']='Api_Controller/limit_get_live_rate_sell_calculator';
$route['sell_trade_post_limit']='Api_Controller/sell_trade_post_limit';
$route['buy_trade_post_limit']='Api_Controller/buy_trade_post_limit';
$route['withdraw_inr_amount']='Api_Controller/withdraw_inr_amount';
$route['nft_inr_amount_deposit']='Api_Controller/nft_inr_amount_deposit';
// Cron Link
$route['cron_for_buy_trades1']='Api_Controller/cron_for_buy_trades';
$route['cron_for_sell_trades1']='Api_Controller/cron_for_sell_trades';

$route['daily_payout_cron_generation']='Api_Controller/daily_payout_cron_generation';
$route['monthly_payout_cron_generation_payout']='Api_Controller/monthly_payout_cron_generation_payout';
/*end api creation in parent side*/

/*ADMIN URL*/

$route['admin-login']='SupportController/support_login';
$route['support-user-logout']='SupportController/support_user_logout';
$route['support-dashboard']='SupportController/support_dasboard'; 
$route['buy_trade_history']='SupportController/buy_trade_history';
$route['sell_trade_admin']='SupportController/sell_trade_admin';
$route['admin_deposit_history']='SupportController/admin_deposit_history';
$route['admin_users_history']='SupportController/admin_users_history';
$route['kyc_users_list']='Shoppingwallet/kyc_users_list';
$route['admin_change_password']='SupportController/admin_change_password';
$route['admin_withdraw_history']='SupportController/admin_withdraw_history';
$route['add_new_product_admin']='SupportController/add_new_product_admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
