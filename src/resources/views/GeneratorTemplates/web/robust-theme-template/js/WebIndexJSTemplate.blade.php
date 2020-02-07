<?="<script type=\"text/javascript\">

    $(document).ready(function () {
        $('#example').DataTable();
    });

    get" . ucfirst(Str::camel($tablename)) . " = (url) => {
        $.get(url, (response) => {
            $('tbody').empty().append(
                /* */
            )
        })
    };

</script>
"?>