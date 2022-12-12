<?php

namespace App\Exports; 

use App\User;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use Carbon\Carbon;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
     
    public function collection()
    {
        return User::latest()
        ->whereBetween('login_at', array(request("startDate"), request("endDate")))
        ->get();
    }

    public function map($user): array
    {
        return [
            $user->name, 
            $user->email,
            $user->phone,
            $user->type,
            $user->status,
            Date::stringToExcel($user->login_at),
            Date::stringToExcel($user->login_at),
            Date::stringToExcel($user->logout_at),
            Date::stringToExcel($user->logout_at),
            Date::dateTimeToExcel($user->created_at),
            Date::dateTimeToExcel($user->created_at),
            $user->login_ip,
            $user->availability,
        
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Type',
            'Status',
            'Last Login At Date',
            'Last Login At Time',
            'Last Logout At Date',
            'Last Logout At Time',
            'Created At Date',
            'Created At Time',
            'Last Login IP',
            'Availability',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_TIME2,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_TIME2,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_TIME2,
        ];
    }
}