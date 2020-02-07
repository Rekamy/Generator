<?=
"<style>.navigation{font-family: Arial, Helvetica, sans-serif;}</style>
<div class=\"app-content content\">
  <div class=\"content-wrapper\">
    <div class=\"content-header row\">
    </div>
    <div class=\"main-menu menu-static menu-light menu-accordion menu-shadow\" data-scroll-to-active=\"true\">
      <?php if  (isset(\$page )==FALSE)  \$page=\"Home\"; ?>
      <div class=\"main-menu-content\">
        <ul class=\"navigation navigation-main\" id=\"main-menu-navigation\" data-menu=\"menu-navigation\">
          <li class=\"<?php if(\$page=='Home') {echo'active';}?>\"><a href=\"{{ route('dashboard') }}\"><i class=\"icon-home\"></i><span class=\"menu-title\" data-i18n=\"nav.email-application.main\">Dashboard</span></a>
          </li>"?>
          <?php foreach ($db->tables as $table) { ?>
          <?= "
          <li class=\"<?php if(\$page=='" . ucfirst(Str::camel(Str::singular($table->TABLE_NAME))) . "') {echo'active';}?>\"><a href=\"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $table->TABLE_NAME))) . ".index') }}\"><i class=\"icon-user-female\"></i><span class=\"menu-title\" data-i18n=\"nav.email-application.main\">" . ucfirst(Str::singular(str_replace('_', '', $table->TABLE_NAME))) . "</span></a>
          </li>" ?>
          <?php } ?>
        <?="  
        </ul>
      </div>
    </div>
"?>