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
        },
        columns: ["
        ?><?php 
        $i = 0;
        foreach ($columns as $columns) :
            $title = \Str::of($columns->getName())->absoluteTitle();
            if($i++ < 5) {
                echo "\n\t\t\t{ data: '". $columns->getName() . "', title: '". $title . "' }," ;
            } else {
                echo "\n\t\t\t{ data: '". $columns->getName() . "', title: '". $title . "', visible: \"false\" }," ;
            }

        endforeach;
?><?= "
            {
                title: \"Action\",
                data: \"id\",
                render: function (data: any, type: any, row: any, meta: any) {
                    let html = `
                    <div class=\"btn-group\" role=\"group\">
                        <button type=\"button\" class=\"btn btn-success btn-sm view\" id=\"{$camel}ViewAction\"><i class=\"far fa-eye\" data-placement=\"top\" title=\"View\" ></i></button>
                        <button type=\"button\" class=\"btn btn-primary btn-sm edit\" id=\"{$camel}EditAction\"><i class=\"fas fa-edit\" data-placement=\"top\" title=\"Edit\"></i></button>
                        <button type=\"button\" class=\"btn btn-danger btn-sm delete\"id=\"{$camel}DeleteAction\"><i class=\"far fa-trash-alt\" data-placement=\"top\" title=\"Delete\"></i></button>
                    </div>
                    `
                    return html;
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
        // FIXME: error does not get captured globally without try and catch
        try {
            const result = await widget.alertDelete()
            if (!result.isConfirmed) {
                widget.alertSuccess('Deletion abort.', 'Your data is save.')
                return;
            }

            let message = await {$camel}Bloc.destroy{$studly}(data.id);
            widget.alertSuccess('Good Job!', 'Your data has been deleted.');
            $(tableId).DataTable().ajax.reload()
        } catch(err) {
            if (err.error.response?.statusText) {
                widget.dialog.fire('Opps!', err.error.response.statusText, 'error');
            } else {
                widget.dialog.fire('Opps!', err.error.message, 'error');
            }
            // console.log(err.error.response)
            // console.log(err.error.message)
            // FIXME: cause uncaught exception
            // throw new Error('asd')
        }
        
    }

    return { options: reactive(dtOptions) }
}

"
?>