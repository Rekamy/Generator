<?= "
import { $studly, ${camel}Api } from \"./index\"
import { ref, reactive } from \"vue\"
import { useStore } from \"vuex\"
import { useRouter } from \"vue-router\"
import { widget } from \"@/core/utils/widget\"
import $ from \"jquery\"

export function {$camel}Factory() {
    const module = '${camel}'
    const store: any = useStore()
    const api = ${camel}Api
    
    async function get{$studly->plural()}() : Promise<[$studly]> {
        let response = await api.all()
        return response.data.data;
    }

    async function get{$studly}(id: any): Promise<$studly> {
        let response = await api.first(id)
        return response.data;
    }

    async function create{$studly}(${camel}: $studly): Promise<$studly> {
        let response = await api.create(${camel})
        return response.data;
    }

    async function update{$studly}(${camel}: $studly): Promise<$studly> {
        let response = await api.edit(${camel}.id, ${camel})
        return response.data;
    }

    async function destroy{$studly}(id: any): Promise<void> {
        let response = await api.destroy(id)
        return response.data;
    }

    return {
        store,
        api,
        get{$studly->plural()},
        get{$studly},
        create{$studly},
        update{$studly},
        destroy{$studly},
    }

}

export function draw{$studly}Table (tableId) {
    const router = useRouter()
    const {$camel}Bloc = {$camel}Factory()
    const api = {$camel}Api
    const dtOptions = {
        ajax: {
            url: api.getEndpoint(),
            method: 'GET',
            dataType: 'json',
            dataSrc: \"data.data\",
        },
        columns: ["
        ?><?php 
        foreach ($columns as $columns) :
            echo "\n\t\t\t{ data: '". $columns->getName() . "' }," ;
        endforeach;
?><?= "
            {
                title: \"Action\",
                data: \"id\",
                render: function (id: any, type: any, full: any, meta: any) {
                    return (
                        '<div class=\"form-group\">' +
                        '<div class=\"btn-group\" role=\"group\">' +
                        `<button type=\"button\" class=\"btn btn-success btn-sm view\" id=\"{$camel}ViewAction\"><i class=\"far fa-eye\" data-placement=\"top\" title=\"View\" ></i></button>` +
                        `<button type=\"button\" class=\"btn btn-primary btn-sm edit\" id=\"{$camel}EditAction\"><i class=\"fas fa-edit\" data-placement=\"top\" title=\"Edit\"></i></button>` +
                        `<button type=\"button\" class=\"btn btn-danger btn-sm delete\"id=\"{$camel}DeleteAction\"><i class=\"far fa-trash-alt\" data-placement=\"top\" title=\"Delete\"></i></button>` +
                        \"</div>\" +
                        \"</div>\"
                    );
                }
            }
        ],

        createdRow: function (row: any, data: any) {
            $(row).find(\"#{$camel}ViewAction\")
                .on(\"click\", () => viewData(data));

            $(row).find(\"#{$camel}EditAction\")
                .on(\"click\", () => editData(data));

            $(row).find(\"#{$camel}DeleteAction\")
                .on(\"click\", () => deleteData(data));
        }
    }

    async function viewData (data: any) {
        router.push(`/crud/{$slug}/\${data.id}`);
    }

    async function editData (data: any) {
        router.push(`/crud/{$slug}/\${data.id}/edit`);
    }

    async function deleteData (data: any) {
        widget.alertDelete().then(async (result) => {
            try {
                if (!result.isConfirmed) {
                    widget.alertSuccess('Deletion abort.', 'Your data is save.')
                    return;
                }
                let message = await {$camel}Bloc.destroy{$studly}(data.id);
                widget.alertSuccess('Good Job!', 'Your data has been deleted.');
                $(tableId).DataTable().ajax.reload()
            } catch (error) {
                widget.alertError(error);
            }
        })
    }
    return { options: reactive(dtOptions) }
}

"
?>