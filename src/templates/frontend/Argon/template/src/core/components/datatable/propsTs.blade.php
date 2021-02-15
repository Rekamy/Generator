import { prop } from 'vue-class-component';

export default class DataTableProps {
    id = prop({
        type: String,
        required: true,
    })
    tableClasses = prop({
        type: String,
        default: "table-bordered nowrap table-striped table-hover order-column"
    })
    events = prop({
        type: [Object],
        default: [],
    })
    options = prop({
        type: Object,
        required: true,
    })
}
