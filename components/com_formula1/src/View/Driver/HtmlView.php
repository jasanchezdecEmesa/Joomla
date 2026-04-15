<?php

namespace Alumno\Component\Formula1\Site\View\Driver;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;
    protected $state;

    public function display($tpl = null)
    {
        $this->form  = $this->get('Form');
        $this->item  = $this->get('Item');
        $this->state = $this->get('State');

        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        $input = Factory::getApplication()->input;
        $isNew = $input->getInt('id', 0) === 0;

        ToolbarHelper::title($isNew ? 'New Driver' : 'Edit Driver');
        ToolbarHelper::apply('driver.apply');
        ToolbarHelper::save('driver.save');
        ToolbarHelper::save2new('driver.save2new');
        ToolbarHelper::cancel('driver.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}