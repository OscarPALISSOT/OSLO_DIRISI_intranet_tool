<?php 

require_once('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$lines= export($_POST['data']);
$nomBDD = $lines[0]["Libelle"];


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$styleArray = [
    
    "0" =>[
        'font' => [
        'bold' => true,
    ]
    ],
    "1" => [
        'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startColor' => [
            'argb' => '8DB4E2',
        ],
        'endColor' => [
            'argb' => '8DB4E2',
        ]
    ]
    ],
    "2" => [
        'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startColor' => [
            'argb' => 'BFBFBF',
        ],
        'endColor' => [
            'argb' => 'BFBFBF',
        ]
    ]],
    "3" => [
        'font' => [
            'italic' => true,
        ]
    ],

    "4" => [
        'borders' => [
            'outline' => [
                'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            ]
        ]
    ]

    ];


$sheet->setCellValue('A1', "BDD ".$nomBDD);
$sheet->setCellValue('C2', "Organisme");
$sheet->setCellValue('D2', "Type");
$sheet->setCellValue('E2', "Débit");
$sheet->setCellValue('F2', "Nombre de travaux en cours");
$sheet->getStyle('C2:F2')->applyFromArray($styleArray['0']);
$sheet->mergeCells('A1:F1')->getStyle('A1')->applyFromArray($styleArray["0"]);
$sheet->getStyle('A1')->applyFromArray($styleArray["1"]);





$j=3;
$trigramme = "___";
for($i=0; $i<count($lines); $i++){
    // $trigramme = $lines[$i]["Trigramme"]; 
    if($trigramme != $lines[$i]["Trigramme"]){
        $quartiers = $lines[$i]["Trigramme"] . " - " . $lines[$i]["Nom_Quartier"];
        $sheet->setCellValue('A'.$j, $quartiers);
        $sheet->mergeCells('A'.$j.':F'.$j);
        $sheet->getStyle('A'.$j.':F'.$j)->applyFromArray($styleArray["0"]);
        $sheet->getStyle('A'.$j.':F'.$j)->applyFromArray($styleArray["2"]);

        $trigramme = $lines[$i]["Trigramme"];
        $z=$j;
        $x=$j;
        $y=$j;
        $j++;
        
    }

    //OPERA
    if($lines[$i]["Id_organisme"] == NULL){
        $sheet->setCellValue('B'.$j, "OPERA")->getStyle('B'.$j, "OPERA")->applyFromArray($styleArray["3"]);;
        
        $sheet->setCellValue('D'.$j, $lines[$i]["Type"]);
        $sheet->setCellValue('E'.$j, $lines[$i]["Debit"].' Mb/s');
        $sheet->setCellValue('F'.$j, $lines[$i]["EtatTrv"]);
        $y++;
        $x++;
    } else {
        $sheet->setCellValue('B'.$j, "MIM3")->getStyle('B'.$j, "MIM3")->applyFromArray($styleArray["3"]);;
        $sheet->setCellValue('C'.$j, $lines[$i]["Nom_Organisme"]);
        $sheet->setCellValue('D'.$j, $lines[$i]["Type"]);
        $sheet->setCellValue('E'.$j, $lines[$i]["Debit"].' Mb/s');
        $sheet->setCellValue('F'.$j, $lines[$i]["EtatTrv"]);
        $x++;
    }
    
    if($z!=$y){
        // $sheet->mergeCells('B'.$z.':B'.$y); //merge des OPERA
        $data["coordsOPERA".$i] = array($z, $y);
    } else if($y!=$x){
        // $sheet->mergeCells('B'.$y.':B'.$x); //merge des MIM3
        $data["coordsMIM3".$i] = array($y, $x);
    }

    $j++;
}

$sheet->getStyle('A1:F'.$x)->applyFromArray($styleArray["4"]);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);

ob_clean();
$writer = new Xlsx($spreadsheet);

$file_name = date('Y-m-d'). '_' . $nomBDD.'_Caractéristiques techniques OPERA et MIM3 par quartiers'. ".xlsx";

$writer->save('/var/www/html/Exports/'. $file_name);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Transfer-Encoding: Binary');
header("Content-disposition: attachment; filename=\"".$file_name."\"");


readfile('/var/www/html/Exports/'. $file_name);
exit;


// $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
// $writer->save('php://output');
// $writer->save('exportBDD.xlsx');

