<?="
"?><?php

foreach ($db->columns as $i => $column) {
    if ($column->TABLE_NAME == $tablename) {
?><?="
<div class=\"form-group\">        
    <label>". ucfirst(str_replace('_', ' ', $column->COLUMN_NAME)) . "</label>
    <input type=\"text\" class=\"form-control\" value=\"{{ $" . $tablename . "->" . $column->COLUMN_NAME . " ?? '' }}\" placeholder=\"". ucfirst(str_replace('_', ' ', $column->COLUMN_NAME)) . "\" name=\"". $column->COLUMN_NAME . "\">
</div>
"?>
<?php }
} ?>