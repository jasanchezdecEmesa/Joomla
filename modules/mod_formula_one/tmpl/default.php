<?php 
// No direct access
defined('_JEXEC') or die; ?>

<?php
foreach ($teams as $team) {
    echo '<h2>' . $team->nombre . ' (' . $team->pais . ')</h2>';
    echo '<ul>';
    foreach ($pilots as $pilot) {
        if ($pilot->id_escuderia == $team->id) {
            echo '<li>' . $pilot->nombre . ' ' . $pilot->apellido . '</li>';
        }
    }
    echo '</ul>';
}?>