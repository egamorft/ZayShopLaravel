<?php

namespace App\Exports;

use App\Order;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExcelExport implements
    // FromCollection,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents,
    FromQuery,
    WithDrawings,
    WithCustomStartCell,
    WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Order::with('account')->get();
    // }

    //Better chunk than collection
    public function query()
    {
        return Order::query()->with('account');
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_id,
            $order->account->account_name,
            '"' . $order->order_code . '"',
            $order->created_at
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'User order',
            'Order code',
            'Created at'
        ];
    }

    public function registerEvents(): array
    {
        return [
           AfterSheet::class => function (AfterSheet $event) {
               $event->sheet->getStyle('A8:D8')->applyFromArray([
                   'font' => [
                       'bold' => true
                   ]
               ]);
           }
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/upload/logo/logo.png'));
        $drawing->setHeight(120);
        $drawing->setCoordinates('B1');

        return $drawing;
    }

    public function startCell(): string
    {
        return 'A8';
    }
}
