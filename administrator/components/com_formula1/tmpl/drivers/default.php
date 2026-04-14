<?php

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
?>

<h1>Drivers</h1>

<p>
    <a class="btn btn-primary" href="<?php echo Route::_('index.php?option=com_formula1&view=driver&layout=edit'); ?>">
        New Driver
    </a>

    <a class="btn btn-secondary" href="<?php echo Route::_('index.php?option=com_formula1&view=teams'); ?>">
        View Teams
    </a>
</p>

<table class="table table-striped">
    <thead>
        <tr>
            <!--<th>ID</th>-->
            <th>Picture</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Nationality</th>
            <th>Number</th>
            <th>Team</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $item) : ?>
                <tr>
                    <!--<td><?php echo (int) $item->id; ?></td>-->
                    <td>
                        <?php 
                        if (!empty($item->picture)) : 
                            $imagePath = $item->picture;
                            
                            if (strpos($imagePath, '{') === 0) {
                                $imageData = json_decode($imagePath);
                                $imagePath = $imageData->imagefile ?? '';
                            }
                            
                            if ($imagePath) : ?>
                                <img src="<?php echo Joomla\CMS\Uri\Uri::root() . htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" 
                                     alt="Driver Picture" 
                                     style="max-width: 100px; max-height: 100px; object-fit: cover;">
                            <?php else : ?>
                                No Image
                            <?php endif; ?>
                        <?php else : ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($item->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="<?php echo Route::_('index.php?option=com_formula1&view=driver&layout=edit&id=' . (int) $item->id); ?>">
                            <?php echo htmlspecialchars($item->last_name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($item->nationality, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo (int) $item->number; ?></td>
                    <td><?php echo htmlspecialchars($item->team_name ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a class="btn btn-sm btn-secondary"
                           href="<?php echo Route::_('index.php?option=com_formula1&view=driver&layout=edit&id=' . (int) $item->id); ?>">
                            Edit
                        </a>

                        <a class="btn btn-sm btn-danger"
                           href="<?php echo Route::_('index.php?option=com_formula1&task=drivers.delete&id=' . (int) $item->id); ?>"
                           onclick="return confirm('Are you sure you want to delete this driver?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="7">No drivers found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>