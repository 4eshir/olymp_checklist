<?php

namespace App\Http\Controllers;
use App\Models\dbUrl;
use App\Models\students;
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
    public function table_process(Request $request, $target_id, $subject_id){
        if(!($request->session()->get('mun') == $target_id && $request->session()->get('sub') == $subject_id)){
            abort(403, "В доступе отказано");
        }
        /*$data = Http::get("http://127.0.0.1:8001/api/show_students/{$id}");
        $data = json_decode($data, true);
        $number = count($data['data']);
        $countries = $data['countries'];
        return view('welcome')->with('record', $data)->with('number', $number)->with('id_t', $id)->with('teacher_id',$teacher_id)
                              ->with('countries',$countries)->with('num_count',count($countries));*/

        $data = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-entries/1/".$target_id."/".$subject_id)->body());

        return view('welcome', ['data' => $data, '']);
    }
    //Post формы подтверждения
    public function registerPost(Request $request){
        /*$number = 3;
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
        }*/

        $data = [];
        for ($i = 0; $i < count($_POST["ids"]); $i++)
        {
            $data[] = [$_POST["ids"][$i], $_POST["citizenship"][$i], $_POST["disabled"][$i], $_POST["status"][$i]];

            $student = students::create([
                //'teacher_id' => ,
                'olympiad_entry_id' => $_POST["ids"][$i],
                'citizenship_id' => $_POST["citizenship"][$i],
                'ovz' => $_POST["disabled"][$i],
                'status' => $_POST["status"][$i],
            ]);

        }


        $res = Http::post(getenv('STUDENT_URL')."/api/check-students", [
            'data' => $data
        ]);

        dbUrl::where('id', $request->session()->pull('url_id'))->update(['state' => 0]);

        return redirect(route('main'));
    }

    public function main(){
        return view('main');
    }


    //POST формы регистрации учителя
    public function giveurl(Request $request){

        $parsedUrl = parse_url($request->header('Referer'));    // получаем ссылку откуда пришел запрос
        $query = isset($parsedUrl['query']) ? $parsedUrl['query'] : null;   // получаем сам запрос

        // разбиваем на параметры
        $queryParams = [];
        if ($query) {
            $queryParts = explode('&', $query);
            foreach ($queryParts as $part) {
                list($key, $value) = explode('=', $part);
                $queryParams[$key] = $value;
            }
        }

        $munValue = $queryParams['mun'] ?? null;    // вытягиваем муниципалитет
        $subjectValue = $queryParams['sub'] ?? null;    // и предмет


        if ($munValue !== 14) $url = dbUrl::where('municipality_id', $munValue)->where('subject_id', $subjectValue)->first();
        else $url = dbUrl::where('school_id', $munValue)->where('subject_id', $subjectValue)->first();

        $duplicateTeacher = teacher::where('name', $request->name)->where('surname', $request->surname)->where('patronymic', $request->patronymic)->where('school', $request->educational)->first();
        if (!$duplicateTeacher)
        {
            $teacher = teacher::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
                'school' => $request->educational,
                'position' => $request->position,
                'url_id' => $url->id,
            ]);
        }


        $request->session()->put('url_id', $url->id);

        return \redirect()->route('table.process', ['target_id' => $munValue, 'subject_id' => $subjectValue]);
    }


    // GET формы регистрации учителя
    public function giveurl_get(Request $request){
        if ($request->mun !== 14) $url = dbUrl::where('municipality_id', $request->mun)->where('subject_id', $request->sub)->first();
        else $url = dbUrl::where('school_id', $request->mun)->where('subject_id', $request->sub)->first();

        if($url->state == 0){
            return view('main');
        }

        /*if(!$request->hasValidSignature()){
            abort(403, "Время сеанса истекло");
        }*/

        $schools = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-schools/1")->body());
        $municipalities = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-municipalities/1")->body());


        $request->session()->put('mun', $request->mun);
        $request->session()->put('sub', $request->sub);

        return view('giveurl', ['schools' => $schools, 'municipalities' => $municipalities]);
    }

    // Зависимый список школ
    public function dropdownSchools(Request $request)
    {
        if($request->has('municipality_id')){

            $educational = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-schools-juri/1/".$request->municipality_id)->body());

            return ['success' => true, 'data' => $educational];
        }
    }
}
