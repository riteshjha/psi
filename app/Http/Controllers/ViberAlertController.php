<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AlertSetting;
use App\Models\Raw;
use Session;

class ViberAlertController extends Controller
{
    public function setting()
    {
        $expiry = AlertSetting::where('schedule_title', 'card expiry')->first();
        $one = AlertSetting::where('schedule_title', 'before one day')->first();
        $three = AlertSetting::where('schedule_title', 'before three hours')->first();
        $arrival = AlertSetting::where('schedule_title', 'arrival confirmation')->first();
        return view('viber.alert_setting')->withExpiry($expiry)->withOne($one)->withThree($three)->withArrival($arrival);
    }

    public function storeSetting(Request $request)
    {
//        dd($request->all());
        $expiryInt = $request->expiryInt;
        $expiryType = $request->expiryType;
        $beforeOneInt = $request->beforeOneInt;
        $beforeOneType = $request->beforeOneType;
        $beforeOneCount = $request->beforeOneCount;
        $beforeThreeInt = $request->beforeThreeInt;
        $beforeThreeType = $request->beforeThreeType;
        $beforeThreeCount = $request->beforeThreeCount;
        $arrivalInt = $request->arrivalInt;
        $arrivalType = $request->arrivalType;
        $arrivalCount = $request->arrivalCount;
//            dd($expiryInt);

        $expiry = AlertSetting::firstOrNew([
            'schedule_title' => 'card expiry'
        ]);

        $expiry->schedule_title = 'card expiry';
        $expiry->interval_value = $expiryInt;
        $expiry->interval_types = $expiryType;
        $expiry->interval_endpoint = null;
        $expiry->medium = 'viber';
        $expiry->save();


        $beforeOne = AlertSetting::firstOrNew([
            'schedule_title' => 'before one day'
        ]);
        $beforeOne->schedule_title = 'before one day';
        $beforeOne->interval_value = $beforeOneInt;
        $beforeOne->interval_types = $beforeOneType;
        $beforeOne->interval_endpoint = $beforeOneCount;
        $beforeOne->medium = 'viber';
        $beforeOne->save();

        $beforeThree = AlertSetting::firstOrNew([
            'schedule_title' => 'before three hours'
        ]);

        $beforeThree->schedule_title = 'before three hours';
        $beforeThree->interval_value = $beforeThreeInt;
        $beforeThree->interval_types = $beforeThreeType;
        $beforeThree->interval_endpoint = $beforeThreeCount;
        $beforeThree->medium = 'viber';
        $beforeThree->save();

        $arrival = AlertSetting::firstOrNew([
            'schedule_title' => 'arrival confirmation'
        ]);
        $arrival->schedule_title = 'arrival confirmation';
        $arrival->interval_value = $arrivalInt;
        $arrival->interval_types = $arrivalType;
        $arrival->interval_endpoint = $arrivalCount;
        $arrival->medium = 'viber';
        $arrival->save();

        Session::flash('success', trans('employee.Settingsuccessfullysaved!'));
        return redirect()->route('viberAlert');

    }

    public function sendAlert()
    {
        $employees = Raw::getEmployeeForAlert();

        foreach ($employees as $employee) {
            $sender['sender_type'] = 'psi_number';
            $sender['sender_identity'] = $employee->staff_no;
            $sender['sender_message'] = 'alert message';
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://hrms.jp/viber_send_msg",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $sender,
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        }
//        dd($employees);
    }
}
