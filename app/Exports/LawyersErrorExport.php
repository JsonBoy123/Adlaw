<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class LawyersErrorExport implements FromCollection, WithHeadings, ShouldAutoSize
{
	use Exportable;
	public $errors;

	public function __construct($errors){
		$this->errors = $errors;
	}
    public function collection()
    {
        //
    }
}
