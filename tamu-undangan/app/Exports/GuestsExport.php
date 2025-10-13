<?php

namespace App\Exports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class GuestsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    public function collection()
    {
        $guests = Guest::all();

        return $guests->map(function ($guest, $index) {
            return [
                'No'               => $index + 1,
                'Nama'             => $guest->name,
                'Alamat'           => $guest->address,
                'WhatsApp'         => $guest->whatsapp,
                'Pesan'            => $guest->message,
                'Jenis Hadiah'     => ucfirst($guest->gift_type),
                'Nominal Transfer' => $guest->transfer_amount ? 'Rp ' . number_format($guest->transfer_amount, 0, ',', '.') : '-',
                'Metode Transfer'  => $guest->transfer_method ?? '-',
                // ❌ Bukti Transfer dihapus
                'Nominal Cash'     => $guest->cash_amount ? 'Rp ' . number_format($guest->cash_amount, 0, ',', '.') : '-',
                'Barang'           => $guest->barang_name ?? '-',
                // ❌ Foto Tamu dihapus
                'Tanggal Dibuat'   => $guest->created_at->format('d-m-Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Alamat',
            'WhatsApp',
            'Pesan',
            'Jenis Hadiah',
            'Nominal Transfer',
            'Metode Transfer',
            // ❌ Bukti Transfer dihapus
            'Nominal Cash',
            'Barang',
            // ❌ Foto Tamu dihapus
            'Tanggal Dibuat'
        ];
    }

    public function startCell(): string
    {
        return 'A3'; // Header mulai baris ke-3
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Judul
                $sheet->mergeCells('A1:K1'); // ⬅️ menyesuaikan jumlah kolom (sekarang A-K)
                $sheet->setCellValue('A1', '📋 Data Tamu Undangan Wedding');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('8B4513');
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                // Keterangan
                $sheet->mergeCells('A2:K2'); // ⬅️ menyesuaikan jumlah kolom
                $sheet->setCellValue('A2', 'Dicetak pada: ' . now()->format('d-m-Y H:i'));
                $sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(11);
                $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

                // Header tabel
                $sheet->getStyle('A3:K3')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $sheet->getStyle('A3:K3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D2B48C');
                $sheet->getStyle('A3:K3')->getAlignment()->setHorizontal('center');

                // Border semua data
                $lastRow = $sheet->getHighestRow();
                $lastCol = $sheet->getHighestColumn();
                $sheet->getStyle("A3:{$lastCol}{$lastRow}")
                      ->getBorders()
                      ->getAllBorders()
                      ->setBorderStyle(Border::BORDER_THIN);
                      // Kolom "No" rata tengah
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A4:A{$lastRow}")
                ->getAlignment()
                ->setHorizontal('center')
                ->setVertical('center');

            }
        ];
    }
}
