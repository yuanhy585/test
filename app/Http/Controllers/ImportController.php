<?php

namespace App\Http\Controllers;

use App\ImportLog;
use App\Profile;
use App\Repositories\ImportLogRepository;
use App\User;
use Gate, Auth, Redirect, Response,Excel,Storage;
use Illuminate\Http\Request;

use App\Http\Requests;

class ImportController extends Controller
{
    protected $destinationPath = "/importedFile/logs/";
    protected $import_gestion;

    public function __construct(
        ImportLogRepository $import_gestion
    )
    {
        $this->import_gestion = $import_gestion;
        $this->PATH = env('OSS_PATH','test'); //获取默认环境值，若不存在则返回第二个参数
    }

    public function importUsers()
    {
        if (Gate::denies('import_info',Auth::user()))
        {
            return Redirect::back();
        }
        $imports = ImportLog::where('type',1)->orderBy('created_at','desc')->get();
        return view('imports.users',compact('imports'));
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
        if (Gate::denies('import_info',Auth::user()))
        {
            return Redirect::back();
        }
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
                    $userData->password = isset($datum[6])?bcrypt($datum[6]):bcrypt("123456");
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

            $importLog = new ImportLog();
            $importLog->file_name = $request->file('file')->getClientOriginalName();
            $importLog->storage_name = $this->import_gestion->guid().'.'.$extension;
            $importLog->type = 1;
            $importLog->user_id = Auth::user()->id;
            $importLog->save();

            $result =  Storage::put(
                $this->PATH.$this->destinationPath.$importLog->storage_name,
                file_get_contents($request->file('file'))
            );

        }

        echo "导入成功，请查看数据库";
    }

    public function download($id)
    {
        $import = ImportLog::where('id',$id)->first();
        $file = Storage::get($this->PATH.$this->destinationPath.$import->storage_name);
        Storage::disk('local')->put($import->storage_name, $file);
        $url = storage_path().'/app/'.$import->storage_name;

        return Response::download($url);
    }

}
