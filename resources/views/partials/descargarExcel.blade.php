@php
    
use PHPExcel;
use PHPExcel_IOFactory;

class ExcelController extends Controller
{
    public function descargar()
    {
        // Crear una instancia de PHPExcel
        $excel = new PHPExcel();

        // Seleccionar la hoja de trabajo activa
        $hoja = $excel->getActiveSheet();

        // Agregar algunos datos a la hoja de trabajo
        $hoja->setCellValue('A1', 'Nombre');
        $hoja->setCellValue('B1', 'Email');
        $hoja->setCellValue('C1', 'Teléfono');

        $hoja->setCellValue('A2', 'Juan');
        $hoja->setCellValue('B2', 'juan@example.com');
        $hoja->setCellValue('C2', '555-1234');

        $hoja->setCellValue('A3', 'María');
        $hoja->setCellValue('B3', 'maria@example.com');
        $hoja->setCellValue('C3', '555-5678');

        // Crear un objeto de escritura de Excel
        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');

        // Configurar el encabezado del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ejemplo.xlsx"');
        header('Cache-Control: max-age=0');

        // Escribir el archivo Excel en la salida de la respuesta HTTP
        $writer->save('php://output');
    }
}
@endphp