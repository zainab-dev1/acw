<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\EventAttendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActivityAttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function collection()
    {
        return EventAttendance::where('survey_id', $this->activity->id)
            ->orderBy('id')
            ->get();
    }

    public function headings(): array
    {
        $headings = [
            'ID',
            'Phone',
            'Name (English)',
            'Email',
        ];

        if ((int)($this->activity->has_attachment ?? 0) === 1) {
            $headings[] = 'Attachment link';
        }

        $headings[] = 'Created at';

        return $headings;
    }

    public function map($attendance): array
    {
        $row = [
            $attendance->id,
            $attendance->civil_no,
            $attendance->fullname_en ?? '-',
            $attendance->email,
        ];

        if ((int)($this->activity->has_attachment ?? 0) === 1) {
            $link = '';
            if (!empty($attendance->attachment_path)) {
                $link = asset('storage/' . ltrim($attendance->attachment_path, '/'));
            }
            $row[] = $link;
        }

        $row[] = optional($attendance->created_at)->format('Y-m-d H:i:s');

        return $row;
    }
}
