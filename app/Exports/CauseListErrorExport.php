<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CauseListErrorExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;
	public $errors;

	public function __construct($errors){
		$this->errors = $errors;
	}
    
    public function collection()
    {
        $errors = $this->errors;
	    return collect($errors);
    }
    public function headings(): array
	{
        return [
            'enroll_no',
			'causelist_no',
			'case_no',
			'case_status',
			'petitioner',			
			'respondent',
			'case_info',
			'advocate_pet',
			'advocate_res',
			'hearing_date',
			'judge_name',
			'type',
			'hearing_place',
			'bench',
        ];
	}
}
