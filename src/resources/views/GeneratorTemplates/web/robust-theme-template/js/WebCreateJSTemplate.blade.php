<?="
<script type=\"text/javascript\">
    let storeUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".store') }}\";

    \$('form').submit(function(e) {
        e.preventDefault();

        let data = \$('form').serialize();

        btnCreate = (elem) => {
            confirmCreate(elem).then((result) => {
                if (result.value) {
                    callback = $('#intercomDatatable')
                    processCreation(elem, callback)
                } else {
                    Swal.fire(
                        'Canceled',
                        'Process has been canceled',
                        'info'
                    )
                }
            })
        }
    })
</script>
"?>