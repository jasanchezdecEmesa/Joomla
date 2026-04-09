<?php 
// No direct access
defined('_JEXEC') or die; ?>
<form action="" method="post">
    <select name="team_id" onchange="this.form.submit()">
        <option value="">Selecciona un equipo</option>
        <?php foreach ($teams as $team) : ?>
            <option value="<?php echo $team->id; ?>"><?php echo $team->nombre; ?></option>
        <?php endforeach; ?>
    </select>
</form>


<div id="pilots-list">
    <!-- Aquí se mostrarán los pilotos del equipo seleccionado -->
    <?php
    if (isset($_POST['team_id']) && !empty($_POST['team_id'])) {
        $teamId = $_POST['team_id'];
        $pilots = ModFormulaOneHelper::getPilotsByTeam($teamId);
        if (!empty($pilots)) {
            echo '<ul>';
            foreach ($pilots as $pilot) {
                echo '<li>' . $pilot->nombre . ' ' . $pilot->apellido . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No hay pilotos para este equipo.</p>';
        }
    }
    ?>
</div>