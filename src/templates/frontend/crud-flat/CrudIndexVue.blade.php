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