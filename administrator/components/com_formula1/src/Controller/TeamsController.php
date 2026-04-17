<?php

namespace Alumno\Component\Formula1\Administrator\Controller;

defined('_JEXEC') or die;

require_once JPATH_ROOT . '/vendor/autoload.php';

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Joomla\CMS\MVC\Controller\AdminController;

class TeamsController extends AdminController
{
    public function getModel($name = 'Team', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function export()
    {
        $db = Factory::getContainer()->get('DatabaseDriver');

        $query = $db->getQuery(true)
            ->select([
                $db->quoteName('id'),
                $db->quoteName('name'),
                $db->quoteName('country'),
                $db->quoteName('team_principal'),
                $db->quoteName('engine')
            ])
            ->from($db->quoteName('#__formula1_teams'))
            ->order($db->quoteName('id') . ' ASC');

        $db->setQuery($query);
        $rows = $db->loadAssocList();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Escuderias');

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Country');
        $sheet->setCellValue('D1', 'Team Principal');
        $sheet->setCellValue('E1', 'Engine');

        $fila = 2;

        foreach ($rows as $row) {
            $sheet->setCellValue('A' . $fila, $row['id']);
            $sheet->setCellValue('B' . $fila, $row['name']);
            $sheet->setCellValue('C' . $fila, $row['country']);
            $sheet->setCellValue('D' . $fila, $row['team_principal']);
            $sheet->setCellValue('E' . $fila, $row['engine']);
            $fila++;
        }

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'escuderias.xlsx';

        while (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        $spreadsheet->disconnectWorksheets();

        exit;
    }

    public function delete()
    {
        $app = Factory::getApplication();
        $id = $app->input->getInt('id');

        if ($id > 0) {
            $model = $this->getModel('Team');
            $pks = [$id];
            $model->delete($pks);
        }

        $this->setRedirect('index.php?option=com_formula1&view=teams');
    }
}