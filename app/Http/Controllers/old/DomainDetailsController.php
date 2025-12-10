<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DomainDetailsController extends Controller
{
    public function motorCodeList()
    {
        $data = [];
        return view('domainCode.motor', compact('data'));
    }

    public function personalCodeList()
    {
        $data = [];
        return view('domainCode.personal', compact('data'));
    }

    public function socialCodeList()
    {
        $data = [];
        return view('domainCode.social', compact('data'));
    }

    public function languageCodeList()
    {
        $data = [];
        return view('domainCode.language', compact('data'));
    }

    public function numberTimeMoneyMeasurementCodeList()
    {
        $data = [];
        return view('domainCode.numberTimeMoneyMeasurement', compact('data'));
    }

    public function environmentalScienceCodeList()
    {
        $data = [];
        return view('domainCode.environmentalScience', compact('data'));
    }

    public function occupationalVocationalCodeList()
    {
        $data = [];
        return view('domainCode.occupationalVocational', compact('data'));
    }

    public function coCurricularCodeList()
    {
        $data = [];
        return view('domainCode.coCurricular', compact('data'));
    }

    public function parentalInvolvementPlanCodeList()
    {
        $data = [];
        return view('domainCode.motor', compact('data'));
    }
}
