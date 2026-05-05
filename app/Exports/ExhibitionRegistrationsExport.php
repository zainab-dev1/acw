<?php

namespace App\Exports;

use App\Models\ExhibitionRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExhibitionRegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return ExhibitionRegistration::with('files')->orderBy('id')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Department',
            'Email',
            'Phone',
            'Files count',
            'Files',
            'Created at',
        ];
    }

    /**
     * @param \App\Models\ExhibitionRegistration $registration
     */
    public function map($registration): array
    {
        $files = $registration->files->map(function ($f) {
            return $f->original_name ?: $f->path;
        })->implode(' | ');

        return [
            $registration->id,
            $registration->name,
            $registration->department,
            $registration->email,
            $registration->phone,
            $registration->files->count(),
            $files,
            optional($registration->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
