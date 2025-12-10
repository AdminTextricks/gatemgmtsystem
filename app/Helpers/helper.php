<?php

use App\Models\DisabilityMatser;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;


if (!function_exists('getSessions')) {
    function getSessions($startYear = 2024)
    {
        $today = Carbon::today();
        $year = $today->year;

        // Find current session end year
        $currentSession = ($today->month > 3) ? $year + 1 : $year;

        $sessions = [];
        for ($y = $startYear; $y < $currentSession; $y++) {
            $sessions[] = $y . '-' . ($y + 1);
        }

        return $sessions;
    }
}

  function getDisabilityNameById($disabilityId)
    {
        if (!$disabilityId) {
            return 'NA';
        }

        $disability = DisabilityMatser::find($disabilityId);

        return $disability ? $disability->disability_name : 'NA';
    }


 function calculateAge($dob)
    {
        if (empty($dob)) {
            return null; 
        }

        return Carbon::parse($dob)->age;
    }

function shout(string $string)
{
    return strtoupper($string);
}


function format_date($date)
{
    if (empty($date)) {
        return null;
    }

    try {
        return Carbon::parse($date)->format('Y-m-d');
    } catch (\Exception $e) {
        return null; // invalid date
    }
}


function setDefault($value, $default = 'N/A')
{
    if (is_array($value)) {
        return !empty($value) ? $value[0] : $default;
    }
    if (is_null($value) || (is_string($value) && trim($value) === '')) {
        return $default;
    }
    return $value;
}

function random_code()
{

    return rand(1111, 9999);
}

function allUpper($str)
{
    return strtoupper($str);
}


function get_avatar(string $str)
{
    $acronym = '';
    $word = '';
    $words = preg_split("/(\s|\-|\.)/", $str);
    foreach ($words as $w) {
        $acronym .= substr($w, 0, 1);
    }
    $word = $word . $acronym;
    return $word;
}

function getBloodGroupList(bool $withLabel = false): array
{
    $bloodGroups = [
        'A+' => 'A Positive',
        'A-' => 'A Negative',
        'B+' => 'B Positive',
        'B-' => 'B Negative',
        'AB+' => 'AB Positive',
        'AB-' => 'AB Negative',
        'O+' => 'O Positive',
        'O-' => 'O Negative',
    ];

    return $withLabel ? $bloodGroups : array_keys($bloodGroups);
}

if (! function_exists('base_url')) {
    function base_url($path = '')
    {
        return URL::to($path);
    }
}
