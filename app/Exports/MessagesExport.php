<?php

namespace App\Exports;

use App\Models\Transaksi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MessagesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, WithColumnWidths
{
    protected $startDate;
    protected $endDate;
    protected $statusKontak;
    protected $statusTransaksi;

    public function __construct($startDate, $endDate, $statusKontak = '', $statusTransaksi = '')
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->statusKontak = $statusKontak;
        $this->statusTransaksi = $statusTransaksi;
    }

    public function collection()
    {
        $query = Transaksi::with(['penyewa', 'kos'])
            ->whereHas('kos', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->whereBetween('created_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay()
            ]);

        if ($this->statusKontak) {
            $query->where('status_kontak', $this->statusKontak);
        }

        if ($this->statusTransaksi) {
            $query->where('status_transaksi', $this->statusTransaksi);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Nama Penyewa',
            'Email Penyewa',
            'Telepon Penyewa',
            'Nama Kos',
            'Lokasi Kos',
            'Pesan',
            'Status Kontak',
            'Status Transaksi',
            'Tanggal Balasan',
            'Balasan Pemilik'
        ];
    }

    public function map($message): array
    {
        static $no = 1;

        return [
            $no++,
            $message->created_at->format('d/m/Y H:i'),
            $message->penyewa->name,
            $message->penyewa->email,
            $message->penyewa->phone ?? '-',
            $message->kos->nama_kos,
            $message->kos->lokasi,
            $message->catatan ?? '-',
            $this->getStatusKontakText($message->status_kontak),
            $this->getStatusTransaksiText($message->status_transaksi),
            $message->tanggal_balasan ? $message->tanggal_balasan->format('d/m/Y H:i') : '-',
            $message->balasan_pemilik ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        return [
            // Header row style
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF4472C4'],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ],
            // All data cells
            "A2:L{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // Tanggal
            'C' => 20,  // Nama Penyewa
            'D' => 25,  // Email
            'E' => 15,  // Telepon
            'F' => 20,  // Nama Kos
            'G' => 25,  // Lokasi
            'H' => 30,  // Pesan
            'I' => 15,  // Status Kontak
            'J' => 15,  // Status Transaksi
            'K' => 15,  // Tanggal Balasan
            'L' => 30,  // Balasan Pemilik
        ];
    }

    public function title(): string
    {
        return 'Laporan Pesan';
    }

    private function getStatusKontakText($status)
    {
        switch ($status) {
            case 'pending':
                return 'Menunggu';
            case 'contacted':
                return 'Sudah Dihubungi';
            case 'closed':
                return 'Ditutup';
            default:
                return $status;
        }
    }

    private function getStatusTransaksiText($status)
    {
        switch ($status) {
            case 'pending':
                return 'Pending';
            case 'selesai':
                return 'Selesai';
            case 'dibatalkan':
                return 'Dibatalkan';
            default:
                return $status;
        }
    }
}