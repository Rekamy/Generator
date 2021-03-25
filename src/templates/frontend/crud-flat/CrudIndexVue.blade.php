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
                <router-link to=\"/crud/$slug/create\" class=\"btn btn-sm btn-primary\">New $title</router-link>
              </div>
            </div>
          </div>
          <div class=\"table-responsive\">
            <!-- Projects table -->
            <DataTable class=\"table align-items-center table-hover table-striped table-sm\" :options=\"table{$studly}.options\" id=\"{$camel}List\">
              <thead class=\"thead-light\">
                <tr>\n" ?>
<?php
  foreach($columns as $column):
    $name = Str::of($column->getName());

    echo "\t\t\t\t\t<th scope=\"col\">$name</th>\n";
  endforeach;
  echo "\t\t\t\t\t<th scope=\"col\">Action</th>\n";
?>
<?= "\t\t\t\t</tr>
              </thead>
            </DataTable>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script scoped lang=\"ts\" src=\"./index.ts\"></script>

"
?>