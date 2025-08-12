<?php

namespace App\Exports;

use App\Models\Kos;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KosVerificationExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $startDate;
    protected $endDate;
    protected $status;

    public function __construct($startDate, $endDate, $status = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Kos::with(['pemilik'])
            ->whereBetween('created_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay()
            ]);

        if ($this->status !== null && $this->status !== '') {
            $query->where('is_verified', $this->status === 'verified' ? true : false);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal Dibuat',
            'Nama Kos',
            'Lokasi',
            'Harga (Rp)',
            'Fasilitas',
            'Deskripsi',
            'Status Verifikasi',
            'Nama Pemilik',
            'Email Pemilik',
            'Telepon Pemilik',
            'Tanggal Verifikasi',
            'Status Ketersediaan'
        ];
    }

    /**
     * @param mixed $kos
     * @return array
     */
    public function map($kos): array
    {
        static $index = 1;

        return [
            $index++,
            $kos->created_at->format('d/m/Y H:i:s'),
            $kos->nama_kos,
            $kos->lokasi,
            number_format($kos->harga, 0, ',', '.'),
            $kos->fasilitas ?? '-',
            $kos->deskripsi ?? '-',
            $kos->is_verified ? 'Terverifikasi' : 'Menunggu',
            $kos->pemilik->name,
            $kos->pemilik->email,
            $kos->pemilik->phone ?? '-',
            $kos->is_verified && $kos->updated_at ? $kos->updated_at->format('d/m/Y H:i:s') : '-',
            ucfirst(str_replace('_', ' ', $kos->status_ketersediaan ?? 'tersedia'))
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Auto-size columns
        foreach (range('A', 'M') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Style header row
        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3B82F6'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Add borders to all data
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:M' . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Center align specific columns
        $sheet->getStyle('A:A')->getAlignment()->setHorizontal('center'); // No
        $sheet->getStyle('H:H')->getAlignment()->setHorizontal('center'); // Status Verifikasi
        $sheet->getStyle('M:M')->getAlignment()->setHorizontal('center'); // Status Ketersediaan

        // Add title and information above the table
        $sheet->insertNewRowBefore(1, 5);

        // Title
        $sheet->setCellValue('A1', 'LAPORAN VERIFIKASI KOS');
        $sheet->mergeCells('A1:M1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        // Period information
        $periodText = 'Periode: ' . Carbon::parse($this->startDate)->format('d F Y') . ' s/d ' . Carbon::parse($this->endDate)->format('d F Y');
        if ($this->status) {
            $periodText .= ' | Status: ' . ($this->status === 'verified' ? 'Terverifikasi' : 'Menunggu');
        }

        $sheet->setCellValue('A2', $periodText);
        $sheet->mergeCells('A2:M2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        // Generated date
        $sheet->setCellValue('A3', 'Digenerate pada: ' . Carbon::now()->format('d F Y, H:i:s') . ' WIB');
        $sheet->mergeCells('A3:M3');
        $sheet->getStyle('A3')->getAlignment()->setHorizontal('center');

        // Empty row
        $sheet->setCellValue('A4', '');

        return [];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan Verifikasi Kos';
    }
}