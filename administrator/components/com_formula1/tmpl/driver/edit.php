<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
?>

<form action="<?php echo Route::_('index.php?option=com_formula1&layout=edit&id=' . (int) ($this->item->id ?? 0)); ?>"
      method="post"
      name="adminForm"
      id="driver-form"
      class="form-validate">

    <div class="form-horizontal">
        <?php echo $this->form->renderField('id'); ?>
        <?php echo $this->form->renderField('first_name'); ?>
        <?php echo $this->form->renderField('last_name'); ?>
        <?php echo $this->form->renderField('nationality'); ?>
        <?php echo $this->form->renderField('number'); ?>
        <?php echo $this->form->renderField('team_id'); ?>
    </div>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>