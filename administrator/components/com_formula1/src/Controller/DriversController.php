<?php

namespace Alumno\Component\Formula1\Administrator\Controller;

defined('_JEXEC') or die;

require_once JPATH_ROOT . '/vendor/autoload.php';

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\AdminController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DriversController extends AdminController
{
    public function getModel($name = 'Driver', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function export()
    {
        $app = Factory::getApplication();
        $db  = Factory::getContainer()->get('DatabaseDriver');

        $filters = $app->input->get('filter', [], 'array');

        $search = trim($filters['search'] ?? '');
        $nationality = trim($filters['nationality'] ?? '');

        $query = $db->getQuery(true)
            ->select([
                'd.' . $db->quoteName('id'),
                'd.' . $db->quoteName('first_name'),
                'd.' . $db->quoteName('last_name'),
                'd.' . $db->quoteName('nationality'),
                'd.' . $db->quoteName('number'),
                'd.' . $db->quoteName('team_id'),
                't.' . $db->quoteName('name', 'team_name')
            ])
            ->from($db->quoteName('#__formula1_drivers', 'd'))
            ->leftJoin(
                $db->quoteName('#__formula1_teams', 't')
                . ' ON d.' . $db->quoteName('team_id') . ' = t.' . $db->quoteName('id')
            );

        // Filtro por búsqueda
        if ($search !== '') {
            if (stripos($search, 'id:') === 0) {
                $query->where($db->quoteName('d.id') . ' = ' . (int) substr($search, 3));
            } else {
                $searchLike = $db->quote('%' . $db->escape($search, true) . '%');
                $query->where(
                    '('
                    . $db->quoteName('d.first_name') . ' LIKE ' . $searchLike
                    . ' OR '
                    . $db->quoteName('d.last_name') . ' LIKE ' . $searchLike
                    . ')'
                );
            }
        }

        // Filtro por nacionalidad
        if ($nationality !== '') {
            $query->where(
                $db->quoteName('d.nationality') . ' = ' . $db->quote($nationality)
            );
        }

        $query->order($db->quoteName('d.last_name') . ' ASC');

        $db->setQuery($query);
        $rows = $db->loadAssocList();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Pilotos');

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'First Name');
        $sheet->setCellValue('C1', 'Last Name');
        $sheet->setCellValue('D1', 'Nationality');
        $sheet->setCellValue('E1', 'Number');
        $sheet->setCellValue('F1', 'Team ID');
        $sheet->setCellValue('G1', 'Team');

        $fila = 2;
        foreach ($rows as $row) {
            $sheet->setCellValue('A' . $fila, $row['id']);
            $sheet->setCellValue('B' . $fila, $row['first_name']);
            $sheet->setCellValue('C' . $fila, $row['last_name']);
            $sheet->setCellValue('D' . $fila, $row['nationality']);
            $sheet->setCellValue('E' . $fila, $row['number']);
            $sheet->setCellValue('F' . $fila, $row['team_id']);
            $sheet->setCellValue('G' . $fila, $row['team_name'] ?? '');
            $fila++;
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        while (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="pilotos_filtrados.xlsx"');
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
            $model = $this->getModel('Driver');
            $pks = [$id];

            if ($model->delete($pks)) {
                $this->setRedirect('index.php?option=com_formula1&view=drivers', 'Driver deleted successfully.');
                return;
            }
        }

        $this->setRedirect('index.php?option=com_formula1&view=drivers', 'Could not delete the driver.', 'error');
    }
}