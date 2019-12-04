<?php
function humanize_datetime_format($datetime) {
	if ($datetime == null) {
		return null;
	}

	return Carbon\Carbon::parse($datetime)->format('l\\, j F Y H:i:s');
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

function criteria_type($status, $label = true) {
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

function criteria_step($status, $label = true) {
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
?>