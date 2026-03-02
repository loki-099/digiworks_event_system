<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Select only the columns you want in your Excel file
        return Attendance::with('registration.pitching')
            ->get()
            ->map(function ($att) {
                return [
                    $att->for ?? 'N/A',
                    $att->created_at ?? 'N/A',
                    $att->registration->attendee->name ?? 'N/A',
                    $att->registration->attendee->email ?? 'N/A',
                    $att->registration->attendee->affiliation ?? 'N/A',
                    $att->registration->pitching->group_name ?? 'N/A',
                    $att->registration->pitching->organization ?? 'N/A',
                    $att->registration->pitching->team_members ?? 'N/A',
                    $att->registration->exhibit_product ?? 'N/A',
                ];
            });
    }

    public function headings(): array
    {
        return ["For", "Time In", "Attendee Name", "Email", "Affiliation", "Pitching Group Name", "Pitching Organization", "Team Members", "Product Exhibition"];
    }
}
