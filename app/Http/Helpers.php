<?php
function humanize_datetime_format($datetime) {
	if ($datetime == null) {
		return null;
	}

	return Carbon\Carbon::parse($datetime)->format('l\\, j F Y H:i:s');
}

function humanize_date_format($datetime) {
	if ($datetime == null) {
		return null;
	}

	return Carbon\Carbon::parse($datetime)->format('l\\, j F Y');
}

function convertToAngka($rupiah)
{
    // $int = ereg_replace("[^0-9]", "", $rupiah); 
    $int    = str_replace(".", "", $rupiah);
    return $int;
}

/**
 * 
 * TRANSACTION & STATUS
 */
function AI_status_list() {
	$status = [
		'Inactive',
		'Active'
	];
	return $status;
}

function AI_status($status, $label = true) {
	if ($status == 0) {
		$string = "Inactive";
		$label_type = "danger";
	}elseif ($status == 1) {
		$string = "Active";
		$label_type = "success";
	}

	if ($label == true) {
		$string = '<small class="label label-' . $label_type . '">' . $string . '</small>';
	}

	return $string;
}

function criteria_type_list() {
	$status = [
        '1' => 'Benefit',
        '2' => 'Cost'
	];
	return $status;
}

function criteria_type($status, $label = false) {
	if ($status == 1) {
		$string = "Benefit";
		$label_type = "success";
	}elseif ($status == 2) {
		$string = "Cost";
		$label_type = "danger";
	}

	if ($label == true) {
		$string = '<small class="label label-' . $label_type . '">' . $string . '</small>';
	}

	return $string;
}


function criteria_step_list() {
	$status = [
        '1' => 'Step 1',
        '2' => 'Step 2'
	];
	return $status;
}

function criteria_step($status, $label = false) {
	if ($status == 1) {
		$string = "Step 1";
		$label_type = "default";
	}elseif ($status == 2) {
		$string = "Step 2";
		$label_type = "default";
	}

	if ($label == true) {
		$string = '<small class="label label-' . $label_type . '">' . $string . '</small>';
	}

	return $string;
}

function display_status_list() {
	$status = [
		'No',
		'Yes'
	];

	return $status;
}

function display_status($status, $label = true) {
	if ($status == 0) {
		$string = "No";
		$label_type = "danger";
	}elseif ($status == 1) {
		$string = "Yes";
		$label_type = "success";
	}

	if ($label == true) {
		$string = "<small class='label label-" . $label_type . "'>" . $string . "</small>";
	}

	return $string;
}

function priority_list() {
	$status = [
        '0.5' => 'Rendah',
		'0.8' => 'Sedang',
		'1' => 'Tinggi'
	];
	return $status;
}

function priority($status, $label = false) {
	if ($status == '0.5') {
		$string = "Rendah";
		$label_type = "default";
	}elseif ($status == '0.8') {
		$string = "Sedang";
		$label_type = "default";
	}elseif ($status == '1') {
		$string = "Tinggi";
		$label_type = "default";
	}

	if ($label == true) {
		$string = '<small class="label label-' . $label_type . '">' . $string . '</small>';
	}

	return $string;
}

function gender($code)
{
    if($code == 1)
    {
        $output = 'Male';
    }elseif($code == 2){
        $output = 'Female';
    }else{
        $output = 'Not Found';
    }
    return $output;
}

function religion($code)
{
    if($code == 1)
    {
        $output = 'Islam';
    }elseif($code == 2){
		$output = 'Kristen';
	}elseif($code == 3){
		$output = 'Hindu';
	}elseif($code == 4){
		$output = 'Buddha';
	}elseif($code == 5){
		$output = 'Konghucu';
	}elseif($code == 6){
		$output = 'Lainnya';
		
    }else{
        $output = 'Not Found';
    }
    return $output;
}

function blood_type($code)
{
    if($code == 1)
    {
        $output = 'O';
    }elseif($code == 2){
		$output = 'A';
	}elseif($code == 3){
		$output = 'B';
	}elseif($code == 4){
		$output = 'AB';		
    }else{
        $output = 'Not Found';
    }
    return $output;
}

function get_data_picture($file_directory, $file_name, $type_file = null)
{
    /*----------  IF TYPE SMALL  ----------*/    
    if(!empty($file_name))
    {
        if($type_file == 'small')
        {
            $output     = asset($file_directory.'/small/'.$file_name.'');
        }else{
            $output     = asset($file_directory.'/'.$file_name.'');
        }        
    }else{
        $output     = asset('img/no-image-found.jpg');
    }
    return $output;
}
/**
 * 
 * USING DB
 */

function get_skill($code)
{
     $output     = DB::table('skills')
                     ->select([
                         'skills.name',
                     ])
                     ->where('skills.id', '=', $code)
                     ->first();
     if(!empty($output))
     {
         return $output->name;
     }else{
         return 'Not Found';
     }
}

function get_criteria_detail($criteria)
{
	$output     = DB::table('criteria_details')
					->select([
						'criteria_details.id',
						'criteria_details.name',
						'criteria_details.value',
					])
					->where('criteria_details.criteria_id', '=', $criteria)
					->get();
	return $output;
}

function get_criteria_name($code)
{
     $output     = DB::table('criteria_details')
                     ->select([
                         'criteria_details.name',
                     ])
                     ->where('criteria_details.id', '=', $code)
                     ->first();
     if(!empty($output))
     {
         return $output->name;
     }else{
         return 'Not Found';
     }
}

function get_criteria_parent($code)
{
	$output     = DB::table('criteria_details')
					->select([
						'criterias.step',
						'criterias.name',
					])
					->leftJoin('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
					->where('criteria_details.id', '=', $code)
					->first();
	return $output;
}

function get_criteria_list($code) {
	$getData = DB::table('criteria_details')
		->where('criteria_details.id', '=', $code)
		->first();

	$output = [];
	if ($getData) {
		$output     = DB::table('criteria_details')
			->select([
				'criteria_details.id',
				'criteria_details.name',
				'criteria_details.value',
			])
			->where('criteria_details.criteria_id', '=', $getData->criteria_id)
			->get();
	}
	return $output;
}

function get_criteria_list_hiring($code) {
	$output     = DB::table('criteria_details')
		->select([
			'criteria_details.id',
			'criteria_details.name',
			'criteria_details.value',
		])
		->where('criteria_details.criteria_id', '=', $code)
		->get();
	return $output;
}

function get_candidate_criteria($candidate_id, $criteria_detail_id) {
	$output     = DB::table('candidate_details')
		->select([
			'candidate_details.id',
			'candidate_details.answer',
			'criteria_details.value as criteria_value',
		])
		->leftJoin('criteria_details', 'candidate_details.criteria_detail_id', '=', 'criteria_details.id')
		->where('candidate_details.candidate_id', '=', $candidate_id)
		->where('candidate_details.criteria_detail_id', '=', $criteria_detail_id)
		->first();
	return $output;
}

function get_candidate_skill($candidate_id, $skill, $answer) {
	$output     = DB::table('candidate_skills')
		->select([
			'candidate_skills.id',
			'candidate_skills.answer',
		])
		->where('candidate_skills.candidate_id', '=', $candidate_id)
		->where('candidate_skills.skill_id', '=', $skill)
		->where('candidate_skills.answer', '=', $answer)
		->count();
	return $output;
}


function get_division($code)
{
	$output     = DB::table('divisions')
					->select([
						'divisions.name',
					])
					->where('divisions.id', '=', $code)
					->first();
	if(!empty($output))
	{
		return $output->name;
	}else{
		return 'Not Found';
	}
}

function job_vacancy($code)
{
	$output     = DB::table('job_vacancies')
					->select([
						'job_vacancies.title',
						'job_vacancies.description',
						'job_vacancies.start_date',
						'job_vacancies.end_date',
					])
					->where('job_vacancies.id', '=', $code)
					->first();
	return $output;
}

function check_skill_user($candidate_id, $skill_id, $label = true)
{
	$checkSkill = DB::table('candidate_skills')
		->where('candidate_skills.candidate_id', '=', $candidate_id)
		->where('candidate_skills.skill_id', $skill_id)
		->where('candidate_skills.answer', '!=', '0.00')
		->count();
	if ($checkSkill > 0) {
		$string = "Yes";
		$label_type = "success";
	} else {
		$string = "No";
		$label_type = "danger";		
	}

	if ($label == true) {
		$string = "<small class='label label-" . $label_type . "'>" . $string . "</small>";
	}

	return $string;
}


?>