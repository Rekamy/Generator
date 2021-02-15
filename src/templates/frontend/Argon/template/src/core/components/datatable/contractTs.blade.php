
interface Person {
    name: String,
    email: String,
    actions?: Function
}

interface DataColumn {
    data: String,
    title: String,
    render?: Function,
}

interface DataRow {
    name: String,
    email: String,
    action?: Function,
}

interface DataTableOptions {
    data: Person[],
    columns: DataColumn[],
}

interface DataTableEvent {
    selector: String,
    trigger: String,
    action: Function,
}

// type DataTableEvent = {
//     selector: String,
//     trigger: String,
//     action: Function,
// }
