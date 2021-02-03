<?=

"
import { Vue, setup } from \"vue-class-component\";
import Swal from \"sweetalert2\";
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";
import $ from \"jquery\";

export default class Charges extends Vue {
    Swal!: typeof Swal
    
    {$camel}Bloc = setup(() => {$camel}Factory())
    {$camel->plural()}: object[] = []
    options = {}
    events: object[] = []

    mounted() {
        this.builDataTable()
    }

    async builDataTable() {
        const scope: any = this;
        this.{$camel->plural()} = await this.{$camel}Bloc.get{$studly->plural()}()
        this.options = {
            data: this.{$camel->plural()},
            columns: [\n" ?><?php
            foreach ($columns as $column) :
                echo "\t\t\t\t{ data: '" . $column->getName() . "' },\n";
            endforeach;
            ?><?= "\t\t\t\t{
                    title: \"Action\",
                    data: \"id\",
                    render: function(id: any, type: any, full: any, meta: any) {
                        return (
                            '<div class=\"form-group\">' +
                            '<div class=\"btn-group\" role=\"group\">' +
                            `<button type=\"button\" class=\"btn btn-success btn-sm view\" id=\"viewAction\"><i class=\"far fa-eye\" data-placement=\"top\" title=\"View\" ></i></button>` +
                            `<button type=\"button\" class=\"btn btn-primary btn-sm edit\" id=\"editAction\"><i class=\"fas fa-edit\" data-placement=\"top\" title=\"Edit\"></i></button>` +
                            `<button type=\"button\" class=\"btn btn-danger btn-sm delete\"id=\"deleteAction\"><i class=\"far fa-trash-alt\" data-placement=\"top\" title=\"Delete\"></i></button>` +
                            \"</div>\" +
                            \"</div>\"
                        );
                    }
                }
            ],
            createdRow: function(row: any, data: any) {
                $(row).find(\"#viewAction\")
                    .on(\"click\", scope.viewData.bind(this, data, scope));

                $(row).find(\"#editAction\")
                    .on(\"click\", scope.editData.bind(this, data, scope));

                $(row).find(\"#deleteAction\")
                    .on(\"click\", scope.deleteData.bind(this, data, scope));
            }
        };
    }

    async viewData(data: any) {
        this.\$router.push(`/crud/$slug/\${data.id}`);
    }

    async editData(data: any) {
        this.\$router.push(`/crud/$slug/\${data.id}/edit`);
    }

    async deleteData(data: any) {
        this.Swal.fire({
            title: 'Are you sure?',
            text: \"You won't be able to revert this!\",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let message = await this.{$camel}Bloc.destroy{$studly}(data.id);
                this.builDataTable();
                console.log(message);
                this.Swal.fire('Deleted', '', 'success');
            }
        })
    }

}

"
?>