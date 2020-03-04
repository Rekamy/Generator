<?="
<script type=\"text/javascript\">
    btnCreate = (elem) => {
        let data = \$('form').serialize();
        confirmCreate(elem).then((result) => {
            if (result.value) {
                let datatable = \$('#" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "Datatable')
                processCreation(elem, datatable)
            } else {
                Swal.fire(
                    'Canceled',
                    'Process has been canceled',
                    'info'
                )
            }
        })
    }
</script>
"?>