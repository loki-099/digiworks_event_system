<?php
namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Select only the columns you want in your Excel file
        return Registration::with('attendee', 'workshop')
            ->get()
            ->map(function($reg) {
                return [
                    $reg->id,
                    $reg->attendee->name ?? 'N/A',
                    $reg->attendee->email ?? 'N/A',
                    $reg->workshop->name ?? 'General',
                    $reg->status,
                ];
            });
    }

    public function headings(): array
    {
        return ["Reg ID", "Name", "Email", "Workshop", "Status"];
    }
}
