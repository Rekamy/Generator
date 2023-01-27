<?= "
import jQuery from \"jquery\";
import type { Ref } from \"vue\";
import type { {$studly} } from \"./model\";
import { use{$studly}Bloc } from \"./bloc\";

export function use{$studly}Table (tableRef: Ref) {
    const router = useRouter();
    const endpoint = crudApi(\"{$slug}\").getUrl();
    const options = {
        ajax: {
            url: endpoint,
        },
        order: [[1, \"asc\"]],
        columns: [
            // { data: \"_dtRowIndex\", title: \"Bil\" },"
?><?php
            $i = 0;
            foreach ($columns as $columns) :
                $title = \Str::of($columns->getName())->absoluteTitle();
                if ($i++ < 5) {
                    echo "\n\t\t\t{ data: \"{$columns->getName()}\", title: \"{$title}\" },";
                } else {
                    echo "\n\t\t\t // { data: \"{$columns->getName()}\", title: \"{$title}\", visible: false },";
                }

            endforeach;

            foreach ($relationColumns as $name => $column) :
                $title = (string) \Str::of($name)->studly()->absoluteTitle();
                echo "\n\t\t\t // { data: \"{$column}\", title: \"$title\" },";
            endforeach;
            ?><?= "
            {
                searchable: false,
                orderable: false,
                data: \"id\",
                title: \"Tindakan\",
                render: actionButtonRenderer({
                    path: \"{$slug}\",
                    view: true,
                    edit: true,
                    destroy: true,
                }),
            },
        ],

        createdRow: function (row: HTMLElement, data: unknown) {
            jQuery(row)
                .find(\".action\")
                .on(\"click\", function () {"?><?php $url = '`${this.dataset.url}`'; ?><?="
                    router.push({$url});
                });

            jQuery(row)
                .find(\".destroy\")
                .on(\"click\", () => deleteData(data));
        }
    }

    async function deleteData(data: unknown) {
        try {
            const result = await widget.confirm();
            if (!result.isConfirmed) {
                widget.alertSuccess(\"Hapus Batal.\", \"Data masih selamat.\");
                return;
            }

            await use{$studly}Bloc().delete{$studly}((data as {$studly}).id);
            widget.alertSuccess(\"Terbaik!\", \"Data anda telah dihapuskan.\");
            tableRef.value?.reload();
        } catch (err: unknown) {
            handleError(err);
        }
    }

    return { options, reload: tableRef.value?.reload(), search: tableRef.value?.search() };
}
"?>
