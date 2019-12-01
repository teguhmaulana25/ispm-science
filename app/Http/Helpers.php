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
?>