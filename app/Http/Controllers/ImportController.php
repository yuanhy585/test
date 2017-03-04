<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Gate, Auth, Redirect, Response,Excel;
use Illuminate\Http\Request;

use App\Http\Requests;

class ImportController extends Controller
{
    public function importUsers()
    {
        if (Gate::denies('import_info',Auth::user()))
        {
            return Redirect::back();
        }
        return view('imports.users');
    }

    public function importExample()
    {
        if (Gate::denies('import_info',Auth::user()))
        {
            return Redirect::back();
        }
        $file = "User Info Template.xls";
        $url = storage_path() . "/app/example/" . $file;

        return Response::download($url);
    }

    public function saveUserImport(Request $request)
    {
        if ($request->hasFile('file'))
        {
            $extension = $request->file('file')->getClientOriginalExtension();
            if ($extension != 'xls' && $extension != 'xlsx')
            {
                return Redirect::back()->withInput()->withErrors(['file'=>'该文件类型不符合要求']);
            }

            $data = Excel::load($request->file('file'))->sheet(0)->toArray();

            array_shift($data);

            foreach ($data as $datum)
            {
                $userData = User::where('name',$datum[0])->first();
                if(!$userData)
                {
                    $userData = new User();
                    $userData->name = $datum[0];
                    $userData->role_id = isset($datum[1])?$datum[1]:"1";
                    $userData->status_id = isset($datum[2])?$datum[2]:"2";
                    $userData->language_id = isset($datum[3])?$datum[3]:"1";
                    $userData->organization_id = isset($datum[4])?$datum[4]:"1";
                    $userData->email = isset($datum[5])?$datum[5]:null;
                    $userData->password = isset($datum[6])?$datum[6]:"123456";
                    $userData->save();

                    $profileData = new Profile();
                    $profileData->user_id = $userData->id;
                    $profileData->real_name = isset($datum[7])?$datum[7]:null;
                    $profileData->phone = isset($datum[8])?$datum[8]:null;
                    $profileData->address = isset($datum[9])?$datum[9]:null;
                    $profileData->notes = isset($datum[10])?$datum[10]:null;
                    $profileData->save();
                }
            }
        }

        echo "导入成功，请查看数据库";
    }
}
