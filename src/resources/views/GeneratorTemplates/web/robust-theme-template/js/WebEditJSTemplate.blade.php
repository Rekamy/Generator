<?="<script type=\"text/javascript\">
    btnUpdate = (elem) => {
        confirmUpdate(elem).then((result) => {
            let data = \$('form').serialize();
            if (result.value) {
                let datatable = \$('#" . lcfirst(Str::singular(Str::camel($tablename))) . "Datatable')
                processUpdation(elem, datatable, data)
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