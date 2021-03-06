<?php

namespace App\Http\Controllers\Tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tables\NotificationsController;
use App\Http\Requests\MyProfileValidation;
use App\Http\Requests\PostRegularJobAddValidation;
use App\Http\Requests\PostRegularJobEditValidation;
use App\Http\Requests\QuickJobRequestAddValidation;
use App\Provider;
use App\QuickListing;
use App\RegularListing;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProvidersController extends Controller
{
    public function providerList()
    {
        return User::where('type', 2)->get();
    }

    public function providerSingle(Request $request, $id)
    {
        $provider = Provider::where('user_id', $id)->first();
        if (empty($provider))
            return "Empty";
        else 
            return $provider;
    }
    
    public function providerAdd(Request $request)
    {
        $randomPassword = $this->random_strings(8);
        $password = Hash::make($randomPassword);

        $provider = User::where('email', $request->email_address)->count();

        if ($provider > 0) {
            return "Exist";
        }

        $user = new User;
        $user->email = $request->email_address;
        $user->type = 2;
        $user->password = $password;
        $user->password_raw = $randomPassword;
        $user->name = $request->business_name;

        try {

            if ($user->save()) {
                $request->merge(['user_id' => $user->id]);
            }
    
            Provider::insert($request->all());
            
            NotificationsController::createAccount($request->email_address, $request->email_address, $randomPassword, $request->business_name);
    
            return "Success";

        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return "Failed";
        }

    }

    public function providerEdit(Request $request)
    {
        try {
            Provider::where('id', $request->id)->update($request->all());

            $provider = Provider::find($request->id);
            $business_name = $request->business_name;

            User::where('id', $provider->user_id)->update(['name' => $business_name]);

            return "Success";
        } catch (\Throwable $th) {
            Log::debug($th);
            return "Failed";
        }
    }

    public function providerDelete(Request $request)
    {
        try {
            $user = User::find($request->id);
            Provider::where('user_id', $user->id)->update(['is_delete' => 1]);
            User::where('id', $request->id)->update(['is_delete' => 1]);
            NotificationsController::disableAccount($user->email, $user->name);
            return "Success";
        } catch (\Throwable $th) {
            Log::debug($th);
            return "Failed";
        }
    }

    public function providerEnable(Request $request)
    {
        $user = User::find($request->id);

        $randomPassword = $this->random_strings(8);
        $password = Hash::make($randomPassword);

        $sendUser = NotificationsController::reactivateAccount($user->email, $randomPassword, $user->name);

        $userUpdate = User::where('id', $request->id)->update([
            'is_delete' => 0,
            'password' => $password,
            'password_raw' => $randomPassword
        ]);
        $providerUpdate = Provider::where('user_id', $request->id)->update([
            'is_delete' => 0
        ]);
        
        return 'Success';
    }

    public function myProfileUpdate(MyProfileValidation $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        if (!is_null($request->image_upload)) {
            // $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            // request()->image_upload->move(public_path('images'), $imageName);
            // $request->merge(['image' => $imageName]);

            $file = $request->file('image_upload');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $imageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$name;

            $request->merge(['image' => $imageName]);

            User::where('id', $user_id)->update([
                'name' => $request->business_name,
                'image' => $imageName
            ]);
        }

        User::where('id', $user_id)->update([
            'name' => $request->business_name
        ]);

        $update = Provider::where('id', $request->id)->update($request->except('_token', 'image_upload'));
        
        if ($update) {
            return redirect()->back()->with('message', 'Updated successfully!');
        }
    }

    public function quickJobRequestAdd(QuickJobRequestAddValidation $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        $request->merge(['user_id' => $user_id]);
        $save = QuickListing::insert($request->except('_token'));
        if ($save) {
            return redirect()->route('quick-job-listing')->with('message', 'Job has been posted!');
        }
    }

    public function postJobAdd(PostRegularJobAddValidation $request)
    {
        if (!is_null($request->image_upload)) {
            // $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            // request()->image_upload->move(public_path('images'), $imageName);
            // $request->merge(['image' => $imageName]);

            $file = $request->file('image_upload');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $imageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$name;

            $request->merge(['image' => $imageName]);
        }

        if (!is_null($request->dti)) {
            // $dtiImageName = time().'.'.request()->dti->getClientOriginalExtension();
            // request()->dti->move(public_path('images'), $dtiImageName);
            // $request->merge(['dti_permit' => $dtiImageName]);

            $fileDTI = $request->file('dti');
            $dtiname = time() . '.' . $fileDTI->getClientOriginalExtension();
            $fileDTIPath = 'uploads/' . $dtiname;
            Storage::disk('s3')->put($fileDTIPath, file_get_contents($fileDTI));
            $dtiImageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$dtiname;

            $request->merge(['dti_permit' => $dtiImageName]);
        }

        $user_id = Auth::guard('web')->user()->id;
        $request->merge(['user_id' => $user_id]);

        try {
            RegularListing::insert($request->except('_token', 'image_upload', 'dti'));
            return redirect()->route('job-listing')->with('message', 'Job has been posted successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('job-listing')->with('error', $th->getMessage());
        }

    }

    public function postJobEdit(PostRegularJobEditValidation $request)
    {   
        if (!is_null($request->image_upload)) {
            // $imageName = time().'.'.request()->image_upload->getClientOriginalExtension();
            // request()->image_upload->move(public_path('images'), $imageName);
            // $request->merge(['image' => $imageName]);

            $file = $request->file('image_upload');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $imageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$name;

            $request->merge(['image' => $imageName]);
        }

        if (!is_null($request->dti)) {
            // $dtiImageName = time().'.'.request()->dti->getClientOriginalExtension();
            // request()->dti->move(public_path('images'), $dtiImageName);
            // $request->merge(['dti_permit' => $dtiImageName]);

            $fileDTI = $request->file('dti');
            $dtiname = time() . '.' . $fileDTI->getClientOriginalExtension();
            $fileDTIPath = 'uploads/' . $dtiname;
            Storage::disk('s3')->put($fileDTIPath, file_get_contents($fileDTI));
            $dtiImageName = 'https://sample-bucket-gss.s3-ap-northeast-1.amazonaws.com/uploads/'.$dtiname;

            $request->merge(['dti_permit' => $dtiImageName]);
        }

        $user_id = Auth::guard('web')->user()->id;
        $request->merge(['user_id' => $user_id]);

        try {
            RegularListing::where('id', $request->id)->update($request->except('_token', 'image_upload', 'dti', '_method'));
            return redirect()->route('job-listing-single', ['id' => $request->id])->with('message', 'Job has been posted successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('job-listing-single', ['id' => $request->id])->with('error', $th->getMessage());
        }
    }

    public function random_strings($length_of_string) 
    { 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),  
                        0, $length_of_string); 
    }

}
