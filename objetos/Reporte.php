<?php
require_once('../tcpdf/tcpdf.php');

class Reporte {
    public function generarReportePDF($headers, $data) {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Happy Pets');
        $pdf->SetAuthor('Happy Pets');
        $pdf->SetTitle('Reporte de Consulta');
        $pdf->SetHeaderData('', 0, 'Veterinaria Happy Pets', 'Reporte de consulta');
        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->setFooterFont(['helvetica', '', 10]);
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 25);
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'VETERINARIA HAPPY PETS', 0, 1, 'C');

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Reporte de consulta:', 0, 1, 'L');
        $pdf->Ln(5);

        $tbl = '<table border="1" cellpadding="4"><thead><tr>';
        foreach ($headers as $header) {
            $tbl .= '<th style="background-color:#e0e0e0;">' . htmlspecialchars($header) . '</th>';
        }
        $tbl .= '</tr></thead><tbody>';

        foreach ($data as $row) {
            $tbl .= '<tr>';
            foreach ($row as $cell) {
                $tbl .= '<td>' . htmlspecialchars($cell) . '</td>';
            }
            $tbl .= '</tr>';
        }

        $tbl .= '</tbody></table>';

        $pdf->writeHTML($tbl, true, false, false, false, '');

        $pdf->Output('reporte_consulta.pdf', 'D');
    }
}
?>
