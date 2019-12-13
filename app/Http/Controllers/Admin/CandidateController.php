<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Carbon;
use Validator;
use App\Candidate;

use App\Mail\ActionEmail;
use Illuminate\Support\Facades\Mail;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_division  = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
        return view('admin.pages.candidates.index')->with(compact('list_division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    $id = $request->get('id');
      $data   = DB::table('job_vacancies')
                ->select(
                  [
                    'candidates.id',
                    'candidates.name',
                    'candidates.birth_place',
                    'candidates.birth_date',
                    'candidates.value',
                    'candidates.created_at',
                    'job_vacancies.title as vacancy_title'
                  ])
                ->where('division_id', $id)
                ->join('candidates', 'job_vacancies.id' , '=', 'candidates.job_vacancy_id')
                ->orderBy('candidates.created_at', 'desc')
                ->where('candidates.interview_date', null)
                ->get();
        if(!empty($data)) {
            $list = [];
            $n = 1;
            foreach ($data as $key => $r) {
                $list[] = 
                    '<tr><th scope="row">'.$n.'.</th>'.
                    '<td>'.$r->name.'</td>'.
                    '<td>'.$r->birth_place.', '.$r->birth_date.'</td>'.
                    '<td>'.$r->vacancy_title.'</td>'.
                    '<td>'.$this->getCronbach($r->value, 1).'</td>'.
                    '<td>'.$r->created_at.'</td>'.
                    '<td><label><input type="checkbox" value="'.$r->id.'" name="checkbox_email[]"></label></td></tr>';
            $n++;
            }

            return response()->json([
                'message' => 'Success',
                'count' => count($data),
                'data' => $list
            ], 200);
        }else{
            return response()->json([
                'message' => 'Error, data not fount!',
                'data' => $data
            ], 400);
        }
    }

    function saveIntv(Request $request) {
        $id = explode(",", $request->get('id'));
        $list_id = [];
        $list_id = array_merge($list_id, $id);
        $varEMail = [
                        'type' => 'apply_finish',
                        'name' => $request->input('name'),
                        'vacancy_name' => $request->input('vacancy_name')
                      ];
        if(count($list_id) > 0) {
            foreach ($list_id as $v) {
                Candidate::where('id', $v)->update([
                                                        'interview_date' => $request->get('interview_date'),
                                                        'cronbach_alpha_id' => $this->getCronbach($v, 2)
                                                    ]);
                Mail::to($this->getCandidate($v)->email)->send(new ActionEmail(
                        [
                            'type' => 'interview_email',
                            'name' => $this->getCandidate($v)->name,
                            'date' => \Carbon\Carbon::parse($request->get('interview_date'))->format('l, j F Y \\a\\t h:i:s A'),
                        ]));
            }
        }
        return response()->json([
            'message' => 'Success',
            'count' => count($list_id)
        ], 200);
    }

    function getCronbach($value, $type) { // 1 : label 2 : id
        $data   = DB::table('cronbach_alphas')
                ->select(
                    [
                        'cronbach_alphas.id',
                        'cronbach_alphas.label',
                        'cronbach_alphas.min',
                        'cronbach_alphas.max'
                    ])
                ->get();
        $rt_val = "";
        if($type == 1) { // Return label
            foreach ($data as  $v) {
                if( ($value >= $v->min) && ($value < $v->max) ){
                    $rt_val = $v->label;
                }
            }
        }else{ // Return id
            $cdnt = $this->getCandidate($value);
            foreach ($data as $v) {
                if( ($cdnt->value >= $v->min) && ($cdnt->value < $v->max) ){
                    $rt_val = $v->id;
                }
            }
        }
        return $rt_val;
    }

    function getCandidate($id) {
        $cdnt = DB::table('candidates')
                    ->where('candidates.id', $id) // $value : id
                    ->first();
        return $cdnt;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
