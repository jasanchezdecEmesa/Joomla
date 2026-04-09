<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

$currentUri = Factory::getApplication()->getInput()->server->getString('REQUEST_URI');
?>

<div class="f1-teams-menu">
    <ul>
        <?php foreach ($teams as $team) : ?>
            <li>
                <a href="<?php echo Route::_('index.php?team_id=' . (int) $team->id); ?>">
                    <?php echo htmlspecialchars($team->nombre, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="f1-pilots-list">
    <?php if ($selectedTeam) : ?>
        <h2>
            <?php echo htmlspecialchars($selectedTeam->nombre, ENT_QUOTES, 'UTF-8'); ?>
        </h2>

        <?php if (!empty($pilots)) : ?>
            <ul>
                <?php foreach ($pilots as $pilot) : ?>
                    <li>
                        <?php echo htmlspecialchars($pilot->nombre . ' ' . $pilot->apellido, ENT_QUOTES, 'UTF-8'); ?>
                        <ul>
                            Incorporación a la F1: <?php echo htmlspecialchars($pilot->fecha_incorporacion, ENT_QUOTES, 'UTF-8'); ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No hay pilotos para este equipo.</p>
        <?php endif; ?>
    <?php else : ?>
        <p>Selecciona una escudería.</p>
    <?php endif; ?>
</div>

<style>
.f1-teams-menu ul {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
}

.f1-teams-menu li {
    margin-bottom: 8px;
}

.f1-teams-menu a {
    text-decoration: none;
    font-weight: bold;
}
</style>