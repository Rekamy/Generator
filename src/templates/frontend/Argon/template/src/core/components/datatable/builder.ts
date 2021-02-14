import { Vue, Options, prop, mixins } from 'vue-class-component';
import { Watch } from 'vue-property-decorator';
import DataTableProps from './props'
import $ from "jquery";
import './assets'

@Options({
    // emits: ['showDt']
})

class DataTableContructor extends Vue.with(DataTableProps) {
    table: any = {}
    get tableClass() {
        if (this.tableClasses) return `table ${this.tableClasses}`;
        return `table`;
    }
    mounted() {
        this.options.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        this.options.containers = ''
        this.options.language = {
            paginate: {
                first: '«',
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                last: '»'
            },
            aria: {
                paginate: {
                    first: 'First',
                    previous: 'Previous',
                    next: 'Next',
                    last: 'Last'
                }
            }
        }
        $(this.$el).DataTable(this.options)
            .tables().containers()
            .to$().addClass('my-4');
    }

    @Watch("options", { immediate: true, deep: true })
    optionsUpdated(value: Object, oldValue: Object) {
        // console.log(this.$el)
        // console.log(this.options)
        if (value != oldValue && this.$el) {
            $(this.$el).DataTable().destroy()
            $(this.$el).DataTable(this.options);
        }
        // $(this.$el).DataTable(this.options)
    }
}

class DataTableEvents extends Vue.with(DataTableProps) {
    remapEvents() {
        this.events.forEach((event: any) => {
            // console.log('map', event)
            $(this.$el).on(event.trigger, event.selector, (jquery) => event.action(jquery, this))
        });
    }

    mounted() {
        this.$nextTick(() => this.remapEvents())
    }

    destroyed() {
        $(this.$el).DataTable().destroy()
    }
}

export default class BaseDataTable extends mixins(DataTableContructor, DataTableEvents) {

}
