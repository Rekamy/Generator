<?=
"
<template>
  <div class=\"row\">
    <div class=\"col-12\">
      <div class=\"card\">
        <div class=\"card-header border-0\">
          <div class=\"row align-items-center\">
            <div class=\"col\">
              <h3 class=\"mb-0\">$title</h3>
            </div>
            <div class=\"col text-right\">
              <router-link 
                to=\"/crud/$slug/create\" 
                class=\"btn btn-sm btn-primary\"
              >
                New $title
              </router-link>
            </div>
          </div>
        </div>
        <div class=\"table-responsive\">
          <DataTable 
            :options=\"options\" 
            id=\"{$camel}List\" 
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script scoped lang=\"ts\" src=\"./index.ts\"></script>

"
?>