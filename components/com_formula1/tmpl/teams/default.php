<?php

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
?>

<h1>Teams</h1>

<p>
    <a class="btn btn-primary" href="<?php echo Route::_('index.php?option=com_formula1&view=team&layout=edit'); ?>">
        New Team
    </a>

    <a class="btn btn-secondary" href="<?php echo Route::_('index.php?option=com_formula1&view=drivers'); ?>">
        View Drivers
    </a>
</p>

<table class="table table-striped">
    <thead>
        <tr>
            <!--<th>ID</th>-->
            <th>Name</th>
            <th>Country</th>
            <th>Team Principal</th>
            <th>Engine</th>
            <th>Technical Sheet</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $item) : ?>
                <tr>
                    <!--<td><?php echo (int) $item->id; ?></td>-->
                    <td>
                        <a href="<?php echo Route::_('index.php?option=com_formula1&view=team&layout=edit&id=' . (int) $item->id); ?>">
                            <?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($item->country, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($item->team_principal, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($item->engine, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                    <?php 
                    $pdfPath = $item->file;

                    if (!empty($pdfPath)) : ?>
                        <a href="<?php echo Joomla\CMS\Uri\Uri::root() . 'files/documents/' . $item->file; ?>" target="_blank">
                        View Technical Sheet
                        </a>
                    <?php else : ?>
                        <span>No technical sheet available</span>
                    <?php endif; ?></td>
                    <td>
                        <a class="btn btn-sm btn-secondary"
                           href="<?php echo Route::_('index.php?option=com_formula1&view=team&layout=edit&id=' . (int) $item->id); ?>">
                            Edit
                        </a>

                        <a class="btn btn-sm btn-danger"
                           href="<?php echo Route::_('index.php?option=com_formula1&task=teams.delete&id=' . (int) $item->id); ?>"
                           onclick="return confirm('Are you sure you want to delete this team?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">No teams found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>