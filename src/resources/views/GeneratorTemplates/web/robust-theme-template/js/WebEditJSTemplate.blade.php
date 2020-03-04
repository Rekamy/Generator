<?="<script type=\"text/javascript\">
    let storeUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".update', '" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "-id') }}\";

    $('form').submit(function(e) {
        e.preventDefault();

        let data = $('form').serialize();

        btnUpdate = (elem) => {
            confirmUpdate(elem).then((result) => {
                if (result.value) {
                    callback = $('#" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "Datatable')
                    processUpdation(elem, callback)
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