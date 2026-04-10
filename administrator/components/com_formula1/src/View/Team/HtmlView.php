<?php

namespace Alumno\Component\Formula1\Administrator\View\Team;

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

        ToolbarHelper::title($isNew ? 'New Team' : 'Edit Team');
        ToolbarHelper::apply('team.apply');
        ToolbarHelper::save('team.save');
        ToolbarHelper::save2new('team.save2new');
        ToolbarHelper::cancel('team.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}