<?=
"
<template>
  <div class=\"container-fluid mt--6\">
    <div class=\"row\">
      <div class=\"col-12\">
        <div class=\"card\">
          <div class=\"card-header border-0\">
            <div class=\"row align-items-center\">
              <div class=\"col\">
                <h3 class=\"mb-0\">$title</h3>
              </div>
              <div class=\"col text-right\">
                <router-link to=\"/crud/$title/create\" class=\"btn btn-sm btn-primary\">New $title</router-link>
              </div>
            </div>
          </div>
          <div class=\"table-responsive\">
            <!-- Projects table -->
            <DataTable class=\"table align-items-center table-flush\" :events=\"events\" :options=\"options\" id=\"$title-list\">
              <thead class=\"thead-light\">
                <tr>\n" ?>
<?php 
  foreach($columns as $column):
    echo "\t\t\t\t\t<th scope=\"col\">{$column->getName()}</th>\n";
  endforeach;
?>
<?= "\t\t\t\t</tr>
              </thead>
            </DataTable>
          </div>
        </div>
      </div>
    </div>

    <main-footer />
  </div>
</template>

<script lang=\"ts\" src=\"./$table.ts\"></script>

"
?>