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
        return Registration::with('attendee', 'pitching')
            ->get()
            ->map(function($reg) {
                return [
                    $reg->id,
                    $reg->attendee->name ?? 'N/A',
                    $reg->attendee->email ?? 'N/A',
                    $reg->attendee->affiliation ?? 'N/A',
                    $reg->pitching->group_name ?? 'N/A',
                    $reg->pitching->organization ?? 'N/A',
                    $reg->pitching->team_members ?? 'N/A',
                    $reg->exhibit_product ?? 'N/A',
                    $reg->phone_number ?? 'N/A',
                    $reg->registered_date ?? 'N/A',
                ];
            });
    }

    public function headings(): array
    {
        return ["Reg ID", "Name", "Email", "Affiliation", "Pitching Group Name", "Pitching Organization", "Pitching Team Members", "Product Exhibition", "Phone Number", "Reg Date"];
    }
}
