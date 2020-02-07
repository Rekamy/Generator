<?="get" . ucfirst(Str::camel($tablename)) . " = (url) => {
    $.get(url, (response) => {
        $('tbody').empty().append(
            // 
        )
    })
};
"?>