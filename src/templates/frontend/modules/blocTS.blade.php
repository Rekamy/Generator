<?= "
import { $studly, ${camel}Api } from \"./index\"
import { ref, reactive } from \"vue\"
import { useStore } from \"vuex\"
import { useRouter } from \"vue-router\"
import { widget } from \"@/core/utils\"
import $ from \"jquery\"
import { dataTableApi } from \"@/core/components/datatable\"


export function {$camel}Factory() {
    const module = '${camel}'
    const store: any = useStore()
    const api = ${camel}Api
    
    async function get{$studly->plural()}(query?: string) : Promise<[$studly]> {
        let response = query ? await api.all(query) : await api.all()
        return response.data.data;
    }

    async function get{$studly}(id: any, query?: string): Promise<$studly> {
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
    const router = useRouter();
    const { destroy{$studly} } = {$camel}Factory();
    const api = {$camel}Api;
    const { reload, search } = dataTableApi(tableId);
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
                echo "\n\t\t\t{ data: '". $columns->getName() . "', title: '". $title . "', visible: false }," ;
            }

        endforeach;

        foreach ($relationColumns as $name => $column) :
            $title = (string) \Str::of($name)->studly()->absoluteTitle();
            echo "\n\t\t\t{ data: '{$column}', title: '$title' }," ;
        endforeach;
?><?= "
            {
                title: \"Action\",
                data: \"id\",
                render: function (data: any, type: any, row: any, meta: any) {
                    let html = `<div class=\"btn-group\" role=\"group\">`
                    html += `<button type=\"button\" class=\"btn btn-success btn-sm view\" id=\"{$camel}ViewAction\"><i class=\"far fa-eye\" data-placement=\"top\" title=\"View\" ></i></button>`
                    html += `<button type=\"button\" class=\"btn btn-primary btn-sm edit\" id=\"{$camel}EditAction\"><i class=\"fas fa-edit\" data-placement=\"top\" title=\"Edit\"></i></button>`
                    html += `<button type=\"button\" class=\"btn btn-danger btn-sm destroy\"id=\"{$camel}DestroyAction\"><i class=\"far fa-trash-alt\" data-placement=\"top\" title=\"Delete\"></i></button>`
                    html += `</div>`
                    return html;
                }
            }
        ],

        createdRow: function (row: any, data: any) {
            $(row).find(\"#{$camel}ViewAction\")
                .on(\"click\", () => viewAction(data));

            $(row).find(\"#{$camel}EditAction\")
                .on(\"click\", () => editAction(data));

            $(row).find(\"#{$camel}DestroyAction\")
                .on(\"click\", () => destroyAction(data));
        }
    }

    async function viewAction (data: any) {
        router.push(`/crud/{$slug}/\${data.id}`);
    }

    async function editAction (data: any) {
        router.push(`/crud/{$slug}/\${data.id}/edit`);
    }

    async function destroyAction (data: any) {
        // FIXME: error does not get captured globally without try and catch
        try {
            const { isConfirmed } = await widget.confirm()
            if (!isConfirmed) {
                widget.alertSuccess('Deletion abort.', 'Your data is save.')
                return;
            }

            let message = await destroy{$studly}(data.id);
            widget.alertSuccess('Good Job!', 'Your data has been deleted.');
            $(tableId).DataTable().ajax.reload()
        } catch(err) {
            widget.alertError(err);
        }
        
    }

    return { options: reactive(dtOptions), reload, search }
}

"
?>