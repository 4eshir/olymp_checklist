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
use PhpOffice\PhpSpreadsheet\IOFactory;

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
        $subject = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-subject/1/".$subject_id)->body())->name;

        $request->session()->put('children',$data);

        return view('welcome', ['data' => $data, 'subject' => $subject]);
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

        $excelExport = [
            ['ФИО', 'Дата рождения', 'Класс участия', 'Учебное учреждение', 'Обоснование участия', 'Гражданство', 'ОВЗ', 'Статус участника'],
        ];
        $children = $request->session()->get('children')->data;
        $citizenship = ['РФ', 'Резидент', 'Иностранное государство'];
        $disabled = ['Без ОВЗ', 'Имеется ОВЗ'];
        $status = ['Заявка отклонена', 'Заявка подтверждена'];

        $data = [];
        for ($i = 0; $i < count($_POST["ids"]); $i++)
        {
            $data[] = [$_POST["ids"][$i], $_POST["citizenship"][$i], $_POST["disabled"][$i], $_POST["status"][$i]];

            $student = students::create([
                'teacher_id' => $request->session()->get('teacher_id'),
                'olympiad_entry_id' => $_POST["ids"][$i],
                'citizenship_id' => $_POST["citizenship"][$i],
                'ovz' => $_POST["disabled"][$i],
                'status' => $_POST["status"][$i],
            ]);

            $excelExport[] = [
                $children[$i]->name.' '.$children[$i]->surname.' '.$children[$i]->patronymic,
                date('d.m.Y',strtotime($children[$i]->birthdate)),
                $children[$i]->class,
                $children[$i]->educational,
                $children[$i]->warrant,
                $citizenship[$_POST["citizenship"][$i]],
                $disabled[$_POST["disabled"][$i]],
                $status[$_POST["status"][$i]]
            ];

        }


        $res = Http::post(getenv('STUDENT_URL')."/api/check-students", [
            'data' => $data
        ]);

        dbUrl::where('id', $request->session()->get('url_id'))->update(['state' => 0]);

        $url = dbUrl::where('id', $request->session()->get('url_id'))->first();
        $subject = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-subject/1/".$url->subject_id)->body());
        $municipalities = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-municipality/1/".$url->municipality_id)->body());

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($excelExport, null, 'A1');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(strval($request->session()->get('url_id')).'_'.$subject->name.'_'.$municipalities->name.'.xlsx');

        return redirect(route('main'));
    }

    public function findFilesByPattern($pattern, $directory = '.') {
        $files = glob($pattern, GLOB_BRACE);
        $files = array_map(function ($file) use ($directory) {
            return /*$directory . DIRECTORY_SEPARATOR . */$file;
        }, $files);
        return $files;
    }

    public function downloadExcel(Request $request){
        $idUrl = $request->session()->get('url_id');
        if ($idUrl == null) $idUrl = dbUrl::where('raw', strval($request->header('Referer')))->first()->id;

        $filepattern = sprintf('%s*.xlsx', $idUrl);
        $files = $this->findFilesByPattern($filepattern);

        foreach ($files as $file)
        {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'.$file.'"');
            header('Cache-Control: max-age=3600');
            header('Cache-Control: max-age=3600');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Expires: ' . gmdate('r', time() + 3600));
            readfile($file);

            // Удалить файл после скачивания
            if (file_exists($file)) {
                unlink($file);
            }
        }

        exit;
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


        if ($munValue == -1) $munValue = $queryParams['sch'];

        if ($munValue < 14) $url = dbUrl::where('municipality_id', $munValue)->where('subject_id', $subjectValue)->first();
        else $url = dbUrl::where('school_id', $munValue)->where('subject_id', $subjectValue)->first();


        $teacher = teacher::where('name', $request->name)->where('surname', $request->surname)->where('patronymic', $request->patronymic)->where('school', $request->educational)->first();
        if (!$teacher)
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
        $request->session()->put('teacher_id', $teacher->id);

        return \redirect()->route('table.process', ['target_id' => $munValue, 'subject_id' => $subjectValue]);
    }


    // GET формы регистрации учителя
    public function giveurl_get(Request $request){
        if (!$request->sch) $url = dbUrl::where('municipality_id', $request->mun)->where('subject_id', $request->sub)->first();
        else $url = dbUrl::where('school_id', $request->sch)->where('subject_id', $request->sub)->first();

        if($url->state == 0){
            return view('main');
        }

        /*if(!$request->hasValidSignature()){
            abort(403, "Время сеанса истекло");
        }*/

        $schools = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-schools/1")->body());
        $municipalities = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-municipalities/1")->body());


        $request->session()->put('mun', $request->mun !== -1 ? : $request->sch);
        $request->session()->put('sub', $request->sub);

        return view('giveurl', ['schools' => $schools, 'municipalities' => $municipalities]);
    }

    // Зависимый список школ
    public function dropdownSchools(Request $request)
    {
        if($request->has('municipality_id') && ($request->municipality_id == 14 || $request->municipality_id == 15)){

            $educational = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-schools-juri/1/".$request->municipality_id)->body());

            return ['success' => true, 'data' => $educational];
        }
    }
}
