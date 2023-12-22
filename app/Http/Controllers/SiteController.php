<?php

namespace App\Http\Controllers;
use App\Models\teacher;
use App\Models\User;
use App\Models\work\EducationalInstitutionWork;
use App\Models\work\UserWork;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
class SiteController extends Controller
{
    //get формы подтверждения
    public function table_process(Request $request, $id, $teacher_id){
        if(!$request->hasValidSignature()){
            abort(403, "Время сеанса истекло");
        }
        $data = Http::get("http://127.0.0.1:8001/api/show_students/{$id}");
        $data = json_decode($data, true);
        $number = count($data['data']);
        $countries = $data['countries'];
        return view('welcome')->with('record', $data)->with('number', $number)->with('id_t', $id)->with('teacher_id',$teacher_id)
                              ->with('countries',$countries)->with('num_count',count($countries));
    }
    //Post формы подтверждения
    public function registerPost(Request $request, $id, $teacher_id){
        $number = 3;
        $data = Http::get("http://127.0.0.1:8001/api/students/{$id}");
        $data = json_decode($data, true);
        $data_id = $data["data"];
        $num = $data["num"];
        for($i = 0; $i < $num; $i++) {
            $num2 = $number - 1;
            $num3 = $number - 2;
            $checkbox_ovz = $request->input("checkbox{$num2}");
            if($checkbox_ovz == "on"){
                $ovz = 1;
            }
            else {
                $ovz = 0;
            }
            $country = $request->input("checkbox{$num3}");
            if ($request->input("checkbox{$number}") == "on"){
                $data = Http::get("http://127.0.0.1:8001/api/register_students",
                [
                    'ovz' => $ovz,
                    'country' => $country,
                    'id' => $data_id[$i],
                    'flag' => 1,
                    'teacher_id' => $teacher_id
                ]);
            }
            else {
                $data =  Http::get("http://127.0.0.1:8001/api/register_students",
                [
                    'ovz' => $ovz,
                    'country' => $country,
                    'id' => $data_id[$i],
                    'flag' => 0,
                    'teacher_id' => $teacher_id
                ]);
            }
            $number = $number + 3;
        }
        return redirect(route('main'));
    }
    public function main(){
        return view('main');
    }


    //POST формы регистрации учителя
    public function giveurl(Request $request){
        $teacher = teacher::create([
            'name' => $request->phone_number,
            'surname' => $request->email,
            'patronymic' => Hash::make($request->password),
            'position' => 2,
            'url_id' => 2,
        ]);
        $url = URL::temporarySignedRoute('table.process', now()->addSeconds(1000), ['id' => $id_school, 'teacher_id' => $teacher_id]);
        return Redirect::to($url);
    }


    // GET формы регистрации учителя
    public function giveurl_get(Request $request){
        if(!$request->hasValidSignature()){
            abort(403, "Время сеанса истекло");
        }

        $schools = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-schools/1")->body());
        $municipalities = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-municipalities/1")->body());

        return view('giveurl', ['schools' => $schools, 'municipalities' => $municipalities]);
    }

    // Зависимый список школ
    public function dropdownSchools(Request $request)
    {
        if($request->has('municipality_id')){

            $educational = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-schools/1/".$request->municipality_id)->body());

            return ['success' => true, 'data' => $educational];
        }
    }
}
