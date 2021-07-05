<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Currency;
use App\Http\Requests\Admin\GeneralSettingRequest;
use App\Http\Requests\Admin\EmailSettingRequest;
use App\Http\Requests\Admin\ReportSettingRequest;
use App\Http\Requests\Admin\SmsSettingRequest;
use App\Http\Requests\Admin\WhatsappSettingRequest;
use App\Http\Requests\Admin\ApiSettingRequest;

class SettingsController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_setting',['only' => [
                                                            'index',
                                                            'info_submit',
                                                            'emails_submit',
                                                            'reports_submit',
                                                            'sms_submit',
                                                            'whatsapp_submit',
                                                            'api_keys_submit'
                                                        ]]);
    }

    public function index()
    {
        //general
        $settings=setting('info');
        $currencies=Currency::all();
       
        //emails
        $emails_settings=setting('emails');

        //reports
        $reports_settings=setting('reports');

        //sms
        $sms_settings=setting('sms');

        //whatsapp
        $whatsapp_settings=setting('whatsapp');

        //api keys
        $api_keys_settings=setting('api_keys');

        return view('admin.settings.index',compact(
            'settings',
            'currencies',
            'emails_settings',
            'reports_settings',
            'sms_settings',
            'whatsapp_settings',
            'api_keys_settings'
        ));
    }


    /**
     * update settings info
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function info_submit(GeneralSettingRequest $request)
    {
        //old settings
        $old_settings=Setting::where('key','info')->first();
        $old_settings=json_decode($old_settings['value'],true);
        $settings=$request->except('logo','_token');
        
        //social links
        $settings['socials']['facebook']=$request['facebook'];
        $settings['socials']['twitter']=$request['twitter'];
        $settings['socials']['instagram']=$request['instagram'];
        $settings['socials']['youtube']=$request['youtube'];

        //update currency cache
        cache()->put('currency',$request['currency']);
    
        //update logo
        if($request->hasFile('logo'))
        {
            $logo=$request->file('logo');
            $logo->move('img','logo.png');
        }

        //update reports logo
        if($request->hasFile('reports_logo'))
        {
            $image = base64_encode(file_get_contents($request->file('reports_logo')));

            $settings['reports_logo']=$image;

            $logo=$request->file('reports_logo')->move('img','reports_logo.png');
        }
        else{
            $settings['reports_logo']=$old_settings['reports_logo'];
        }

        $info=Setting::where('key','info')->firstOrFail();
        $info->update([
            'value'=>json_encode($settings)
        ]);
       

       session()->flash('success',__('Settings Updated successfully'));

       return redirect()->route('admin.settings.index');
    }

    

    /**
     * update emails settings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emails_submit(EmailSettingRequest $request)
    {
       $settings=$request->except('_token');

       $settings['patient_code']['active']=($request->has('patient_code.active'))?true:false;
       $settings['reset_password']['active']=($request->has('reset_password.active'))?true:false;
       $settings['tests_notification']['active']=($request->has('tests_notification.active'))?true:false;

       //update setting record in database
       $emails=Setting::where('key','emails')->firstOrFail();
       $emails->update([
         'value'=>json_encode($settings)
       ]);
       
       session()->flash('success',__('Settings Updated successfully'));

       return redirect()->route('admin.settings.index');
    }

    /**
     * update reports settings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reports_submit(ReportSettingRequest $request)
    {

        $request['show_header']=($request->has('show_header'))?true:false;
        $request['show_footer']=($request->has('show_footer'))?true:false;
        $request['show_signature']=($request->has('show_signature'))?true:false;

        $settings=json_encode($request->except('_method','_token'));

        $reports=Setting::where('key','reports')->firstOrFail();
        $reports->update([
            'value'=>$settings
        ]);

        session()->flash('success',__('Settings Updated successfully'));

        return redirect()->route('admin.settings.index');
    }

    /**
     * update reports settings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sms_submit(SmsSettingRequest $request)
    {
        $settings=$request->except('_method','_token');

        $settings['patient_code']['active']=($request->has('patient_code.active'))?true:false;
        $settings['tests_notification']['active']=($request->has('tests_notification.active'))?true:false;
    
        $sms=Setting::where('key','sms')->firstOrFail();
        $sms->update([
            'value'=>$settings
        ]);

        session()->flash('success',__('Settings Updated successfully'));

        return redirect()->route('admin.settings.index');
    }

    /**
     * update whatsapp settings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function whatsapp_submit(WhatsappSettingRequest $request)
    {
        $whatsapp_settings=[];

        $whatsapp_settings['receipt']['active']=(isset($request['receipt']['active']))?true:false; 
        $whatsapp_settings['report']['active']=(isset($request['report']['active']))?true:false;    
        
        $whatsapp_settings['receipt']['message']=$request['receipt']['message'];
        $whatsapp_settings['report']['message']=$request['report']['message'];


        $whatsapp=Setting::where('key','whatsapp')->firstOrFail();
        $whatsapp->update([
            'value'=>json_encode($whatsapp_settings)
        ]);

        session()->flash('success',__('Settings Updated successfully'));

        return redirect()->route('admin.settings.index');
    }


    /**
     * update api keys settings
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function api_keys_submit(ApiSettingRequest $request)
    {
        $api_keys=[];
        $api_keys['google_map']=$request['google_map'];

        $api_keys_setting=Setting::where('key','api_keys')->firstOrFail();
        $api_keys_setting->update([
            'value'=>json_encode($api_keys)
        ]);

        session()->flash('success',__('Settings Updated successfully'));
       
        return redirect()->route('admin.settings.index');
    }
}
