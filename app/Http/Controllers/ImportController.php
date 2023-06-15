<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use Maatwebsite\Excel\Facades\Excel;
use App\Mail\DistributeCodeToEmail;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel-file' => 'required|mimes:xls,xlsx,csv'
        ]);

        if ($request->hasFile('excel-file')) {
            $file = $request->file('excel-file');

            $data = Excel::toArray([], $file, null, \Maatwebsite\Excel\Excel::XLSX);

            $excelData = $this->extractExcelData($data[0]);
            
            // This is a painful band aid solution
            Session::put('excelData', $excelData);

            return view('admin.distribute-code-table', ['data' => $data]);
        }
    }

    public function extractExcelData($data)
    {
        $raceData = [];

        foreach ($data as $index => $row) {
            if ($index === 0) {
                continue;
            }

            $email = $row[2]; 
            $raceCode = $row[3]; 

            $raceData[] = [
                'email' => $email,
                'race_code' => $raceCode,
            ];
        }

        // dd($raceData);
        return $raceData;
    }

    public function distributeCode()
    {
        $excelData = Session::pull('excelData');

        foreach ($excelData as $row) {
            $email = $row['email'];
            $raceCode = $row['race_code'];

            Mail::to($email)->queue(new DistributeCodeToEmail($raceCode));
        }
        return redirect()->route('event');
    }
}
