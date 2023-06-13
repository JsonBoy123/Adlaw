<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class StudentAttendenceExport  implements FromView
{
   
    public $exportData;

    public function __construct($exportData){
        $this->exportData = $exportData;
    }
    public function view(): View
    {
        $monthDates = $this->exportData['monthDates'];
        $academic_dates = $this->exportData['academic_dates'];
        $students = $this->exportData['students'];
        $headerData = $this->exportData['headerData'];
        $filter = $this->exportData['filter'];
        $data = $this->exportData['data'];

        return  view('attendance.report.monthly_report',compact('monthDates','academic_dates','students','headerData','filter','data'));

    }
}
