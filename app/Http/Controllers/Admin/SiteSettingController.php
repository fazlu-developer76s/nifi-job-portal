<?php



namespace App\Http\Controllers\Admin;



use Auth;

use DB;

use Input;

use File;

use Carbon\Carbon;

use ImgUploader;

use Redirect;

use App\Country;

use App\CountryDetail;

use App\SiteSetting;

use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DataTables;

use App\Http\Requests\SiteSettingFormRequest;

use App\Http\Controllers\Controller;

use App\Helpers\DataArrayHelper;



class SiteSettingController extends Controller

{



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        //

    }


    public function updateNotification(Request $request)
    {
        $updateValue = $request->input('update_value');
        $rowId = $request->input('row_id');
        $type = $request->input('type');
        $id = $request->input('id');
    
        $query = DB::table('notification_settings')->where('id', $rowId)->where('type', $type);
    
        if (!$id) {
            $query->update([
                'whatsapp_notify' => $updateValue,
                'email_notify' => $updateValue,
                'sms_notify' => $updateValue,
            ]);
        } else {
            $query->update([$id => $updateValue]);
        }
    
        return response()->json('200 OK');
    }
    public function testKeySms(Request $request)
    {
  
        $get_site_setting = DB::table('site_settings')->where('id', 1272)->get()[0];
        $get_sms_setting = DB::table('sms_settings')->where('id', $request->template_id)->get()[0];
       
        $mobileNo = $request->mobile_number; 
        $userId = $get_site_setting->sms_user_id;
        $password = $get_site_setting->sms_password;
        $senderID = $get_sms_setting->sender_id;
        $entityID = $get_sms_setting->template_name;
        $templateID = $get_sms_setting->template_id;
        $msg = $get_sms_setting->template_content;
        $url = $get_site_setting->sms_url_type;
        $params = [
            'UserID' => $userId,
            'Password' => $password,
            'SenderID' => $senderID,
            'Phno' => $mobileNo,
            'Msg' => $msg,
            'EntityID' => $entityID,
            'TemplateID' => $templateID,
        ];
        try {
            $response = Http::asForm()->get($url, $params);
            Log::info('SMS API Response', [$response->body()]);
            if ($response->successful()) {
                echo json_encode('200 OK');die;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send OTP',
                    'error' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Error sending SMS: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function fetchsmsSetting(Request $request)
    {

        $get_sms_setting = DB::table('sms_settings')->where('id', $request->template_id)->get()[0];

        echo json_encode($get_sms_setting);
    }


    public function editSiteSetting()

    {

        $id = 1272;
        $countries = DataArrayHelper::defaultCountriesArray();
        $currency_codes = CountryDetail::select('countries_details.code')->orderBy('countries_details.code')->pluck('countries_details.code', 'countries_details.code')->toArray();

        $mail_drivers = [

            'smtp' => 'SMTP'

        ];
        $siteSetting = SiteSetting::findOrFail($id);
        $sms_setting = DB::table('sms_settings')->where('status', 2)->get();
        $template = DB::table('sms_settings')->where('status', 1)->get();
        $employer_noti = DB::table('notification_settings')->where('type',1)->get();
        $candidate_noti = DB::table('notification_settings')->where('type',2)->get();
       
        return view('admin.site_setting.edit')
            ->with('siteSetting', $siteSetting)
            ->with('mail_drivers', $mail_drivers)
            ->with('countries', $countries)
            ->with('currency_codes', $currency_codes)
            ->with('sms_setting', $sms_setting)
            ->with('template', $template)
            ->with('employer_noti', $employer_noti)
            ->with('candidate_noti', $candidate_noti);
    }



    public function updateSiteSetting(SiteSettingFormRequest $request)

    {

        $id = 1272;

        $siteSetting = SiteSetting::findOrFail($id);

        if ($request->hasFile('image')) {

            $this->deleteSiteSettingImage($id);

            $image_name = $request->input('site_name');

            $fileName = ImgUploader::UploadImage('sitesetting_images', $request->file('image'), $image_name);

            $siteSetting->site_logo = $fileName;
        }

        if ($request->hasFile('favicon')) {

            $file = $request->file('favicon');

            $file->move(public_path(), 'favicon.ico');
        }

        $siteSetting->site_name = $request->input('site_name');

        $siteSetting->site_slogan = $request->input('site_slogan');

        $siteSetting->site_phone_primary = $request->input('site_phone_primary');

        $siteSetting->site_phone_secondary = $request->input('site_phone_secondary');

        $siteSetting->mail_from_address = $request->input('mail_from_address');

        $siteSetting->mail_from_name = $request->input('mail_from_name');

        $siteSetting->mail_to_address = $request->input('mail_to_address');

        $siteSetting->mail_to_name = $request->input('mail_to_name');


        $siteSetting->is_payu_active = $request->input('is_payu_active');
        $siteSetting->payu_money_key = $request->input('payu_money_key');
        $siteSetting->payu_money_mode = $request->input('payu_money_mode');
        $siteSetting->salt = $request->input('salt');

        $siteSetting->default_country_id = $request->input('default_country_id');

        $siteSetting->country_specific_site = $request->input('country_specific_site');

        $siteSetting->default_currency_code = $request->input('default_currency_code');

        $siteSetting->site_street_address = $request->input('site_street_address');

        $siteSetting->site_google_map = $request->input('site_google_map');

        $siteSetting->mail_driver = $request->input('mail_driver');

        $siteSetting->mail_host = $request->input('mail_host');

        $siteSetting->mail_port = $request->input('mail_port');

        $siteSetting->mail_encryption = $request->input('mail_encryption');

        $siteSetting->mail_username = $request->input('mail_username');

        $siteSetting->mail_password = $request->input('mail_password');

        $siteSetting->mail_sendmail = $request->input('mail_sendmail');

        $siteSetting->mail_pretend = $request->input('mail_pretend');

        $siteSetting->mailgun_domain = $request->input('mailgun_domain');

        $siteSetting->mailgun_secret = $request->input('mailgun_secret');

        $siteSetting->mandrill_secret = $request->input('mandrill_secret');

        $siteSetting->sparkpost_secret = $request->input('sparkpost_secret');

        $siteSetting->ses_key = $request->input('ses_key');

        $siteSetting->ses_secret = $request->input('ses_secret');

        $siteSetting->ses_region = $request->input('ses_region');

        $siteSetting->facebook_address = $request->input('facebook_address');

        $siteSetting->twitter_address = $request->input('twitter_address');

        $siteSetting->google_plus_address = $request->input('google_plus_address');

        $siteSetting->youtube_address = $request->input('youtube_address');

        $siteSetting->instagram_address = $request->input('instagram_address');

        $siteSetting->pinterest_address = $request->input('pinterest_address');

        $siteSetting->linkedin_address = $request->input('linkedin_address');

        $siteSetting->tumblr_address = $request->input('tumblr_address');

        $siteSetting->flickr_address = $request->input('flickr_address');

        $siteSetting->index_page_below_top_employes_ad = $request->input('index_page_below_top_employes_ad');

        $siteSetting->above_footer_ad = $request->input('above_footer_ad');

        $siteSetting->dashboard_page_ad = $request->input('dashboard_page_ad');

        $siteSetting->cms_page_ad = $request->input('cms_page_ad');

        $siteSetting->listing_page_vertical_ad = $request->input('listing_page_vertical_ad');

        $siteSetting->listing_page_horizontal_ad = $request->input('listing_page_horizontal_ad');

        $siteSetting->nocaptcha_sitekey = $request->input('nocaptcha_sitekey');

        $siteSetting->nocaptcha_secret = $request->input('nocaptcha_secret');

        $siteSetting->facebook_app_id = $request->input('facebook_app_id');

        $siteSetting->facebeek_app_secret = $request->input('facebeek_app_secret');

        $siteSetting->google_app_id = $request->input('google_app_id');

        $siteSetting->google_app_secret = $request->input('google_app_secret');

        $siteSetting->twitter_app_id = $request->input('twitter_app_id');

        $siteSetting->twitter_app_secret = $request->input('twitter_app_secret');

        $siteSetting->paypal_account = $request->input('paypal_account');

        $siteSetting->paypal_client_id = $request->input('paypal_client_id');

        $siteSetting->paypal_secret = $request->input('paypal_secret');

        $siteSetting->paypal_live_sandbox = $request->input('paypal_live_sandbox');

        $siteSetting->stripe_key = $request->input('stripe_key');

        $siteSetting->stripe_secret = $request->input('stripe_secret');

        $siteSetting->is_paypal_active = $request->input('is_paypal_active');

        $siteSetting->is_stripe_active = $request->input('is_stripe_active');

        $siteSetting->nifi_payment_key = $request->input('nifi_payment_key');

        $siteSetting->nifi_payment_secret = $request->input('nifi_payment_secret');


        $siteSetting->is_nifi_payment_active = $request->input('is_nifi_payment_active');


        $siteSetting->is_jobseeker_package_active = $request->input('is_jobseeker_package_active');

        $siteSetting->is_company_package_active = $request->input('is_company_package_active');

        $siteSetting->is_slider_active = $request->input('is_slider_active');

        // $siteSetting->mailchimp_api_key = $request->input('mailchimp_api_key');

        // $siteSetting->mailchimp_list_name = $request->input('mailchimp_list_name');

        // $siteSetting->mailchimp_list_id = $request->input('mailchimp_list_id');

        $siteSetting->ganalytics = $request->input('ganalytics');

        $siteSetting->google_tag_manager_for_head = $request->input('google_tag_manager_for_head');

        $siteSetting->google_tag_manager_for_body = $request->input('google_tag_manager_for_body');

        $siteSetting->username_jobg8 = $request->input('username_jobg8');

        $siteSetting->password_jobg8 = $request->input('password_jobg8');

        $siteSetting->accountnumber_jobg8 = $request->input('accountnumber_jobg8');
        $siteSetting->live_chat = $request->input('live_chat');
        $siteSetting->sms_provider_name = $request->input('sms_provider_name');
        $siteSetting->sms_url_type = $request->input('sms_url_type');
        $siteSetting->sms_user_id = $request->input('sms_user_id');
        $siteSetting->sms_password = $request->input('sms_password');

        $siteSetting->update();


        if ($request->template_title_id && $request->template_name != '' && $request->template_id != '' && $request->template_content != '' && $request->sender_id != '') {
            DB::table('sms_settings')
                ->where('id', $request->template_title_id) // Specify the record to update
                ->update([
                    'template_id' => $request->template_id,
                    'template_name' => $request->template_name,
                    'sender_id' => $request->sender_id,
                    'template_content' => $request->template_content,
                    'status' => $request->template_status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
        flash('Site Setting has been updated!')->success();

        return \Redirect::route('edit.site.setting');
    }



    private function deleteSiteSettingImage($id)

    {

        try {

            $siteSetting = SiteSetting::findOrFail($id);

            $image = $siteSetting->image;

            if (!empty($image)) {

                File::delete(ImgUploader::real_public_path() . 'sitesetting_images/thumb/' . $image);

                File::delete(ImgUploader::real_public_path() . 'sitesetting_images/mid/' . $image);

                File::delete(ImgUploader::real_public_path() . 'sitesetting_images/' . $image);
            }

            return 'ok';
        } catch (ModelNotFoundException $e) {

            return 'notok';
        }
    }
}
