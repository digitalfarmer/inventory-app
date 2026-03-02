<?php
namespace App\Exports;

use App\Models\StockEntry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StockReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $start_date, $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        return StockEntry::with('product')
            ->whereBetween('date', [$this->start_date, $this->end_date])
            ->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Nama Produk', 'Jumlah (Qty)', 'Keterangan'];
    }

    public function map($row): array
    {
        return [
            $row->date,
            $row->product->name,
            $row->qty,
            $row->description,
        ];
    }
}