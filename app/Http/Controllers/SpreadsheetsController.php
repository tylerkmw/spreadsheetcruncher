<?php

namespace App\Http\Controllers;

use App\Spreadsheet;
use Illuminate\Http\Request;

class SpreadsheetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Spreadsheet  $spreadsheet
     * @return \Illuminate\Http\Response
     */
    public function show(Spreadsheet $spreadsheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spreadsheet  $spreadsheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Spreadsheet $spreadsheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spreadsheet  $spreadsheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spreadsheet $spreadsheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spreadsheet  $spreadsheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spreadsheet $spreadsheet)
    {
        //
    }

    public function crunch(Request $request)
    {
        $files = $request->file('files');

        $results = [];

        foreach ($files as $file) {
            $file = fopen($file, "r");
            // Load in the first line of the spreadsheet
            $filearray = fgetcsv($file);
            $name = $filearray[1];
            $num1 = null;
            $num2 = null;
            $num3 = null;
            $num4 = null;
            $num5 = null;
            $num6 = null;
            $num7 = null;
            $num8 = null;
            $num9 = null;
            $num10 = null;

            while (!feof($file)) {
                $filearray = fgetcsv($file);
                $header = trim($filearray[0]);
                $header = strtolower($header);

                if ($header == 'tsr revenues') {
                    $num1 = $filearray[1];
                    $num2 = $filearray[8];
                }

                if ($header == 'total nf mgn % of nf sales') {
                    $num3 = $filearray[1];
                    $num4 = $filearray[5];
                }

                if ($header == 'non-labor exp % of nf sales') {
                    $num5 = $filearray[1];
                    $num6 = $filearray[5];
                }

                if ($header == "labor % of nf sales") {
                    $num7 = $filearray[1];
                    $num8 = $filearray[5];
                }

                if ($header == 'ebitda') {
                    $num9 = $filearray[1];
                    $num10 = $filearray[8];
                }
            }
            $results[] = [$name, $num1, $num2, $num3, $num4, $num5, $num6, $num7, $num8, $num9, $num10];
        }
        return view('results', ['results' => $results]);
    }
}
