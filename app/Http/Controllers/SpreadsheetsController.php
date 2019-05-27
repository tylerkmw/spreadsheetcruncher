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

            $result = [$name];

            while (!feof($file)) {
                $filearray = fgetcsv($file);
                $header = trim($filearray[0]);
                $header = strtolower($header);

                if ($header == 'tsr revenues') {
                    $result[] = $filearray[1];
                    $result[] = $filearray[8];
                }

                if ($header == 'total nf mgn & of nf sales') {
                    $result[] = $filearray[1];
                    $result[] = $filearray[5];
                }

                if ($header == 'non-labor exp $ of nf sales') {
                    $result[] = $filearray[1];
                    $result[] = $filearray[5];
                }

                if ($header == 'labor % of nf sales') {
                    $result[] = $filearray[1];
                    $result[] = $filearray[5];
                }

                if ($header == 'ebitda') {
                    $result[] = $filearray[1];
                    $result[] = $filearray[8];
                }
            }
            $results[] = $result;
        }
        return view('results', ['results' => $results]);
    }
}
