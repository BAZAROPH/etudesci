<?php

namespace App\Http\Controllers;

use SplFileObject;
use SplTempFileObject;
use App\Mail\CustomsEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    //

    public function send_customs_emails_to_users_list(Request $request){
        $request->validate([
            'file' => 'required',
            'code' => 'required',
            'object' => 'required',
        ]);
        $csvfile = $request->file;
        $file = new SplFileObject($csvfile);
        $file->setFlags(SplTempFileObject::READ_CSV);
        $data = [];
        $firstname_index = $lastname_index = $email_index = $phone_index = null;
        foreach ($file as $index=>$row) {
            foreach ($row as $subindex => $value) {
                # code...
                if($value == 'firstname'){
                    $firstname_index = $subindex;
                }
                if($value == 'lastname'){
                    $lastname_index = $subindex;
                }
                if($value == 'email'){
                    $email_index = $subindex;
                }
                if($value == 'phone'){
                    $phone_index = $subindex;
                }
            }
            if($index > 0){
                array_push($data, [
                    'firstname' => isset($row[$firstname_index]) ? $row[$firstname_index] : null,
                    'lastname' => isset($row[$lastname_index]) ? $row[$lastname_index] : null,
                    'email' => isset($row[$email_index]) ? $row[$email_index] : null,
                    'phone' => isset($row[$phone_index]) ? $row[$phone_index] : null,
                ]);
            }

            foreach ($data as $key => $value) {
                $code = $request->code;
                $code = str_replace('data_firstname', $value['firstname'], $code);
                $code = str_replace('data_lastname', $value['lastname'], $code);
                $code = str_replace('data_email', $value['email'], $code);
                $code = str_replace('data_phone', $value['phone'], $code);
                if(!is_null($value['email'])){
                    Mail::to($value['email'])->send(new CustomsEmails($code, $request->object));
                }
            }
        }
        return redirect()->back();
    }
}
