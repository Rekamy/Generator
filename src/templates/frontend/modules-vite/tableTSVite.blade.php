<?= "
import { dtActionWrapper, dtAction, dtActionTrigger } from \"@/core/composable\";
import jQuery from \"jquery\";
import type { Ref } from \"vue\";
import type { {$studly} } from \"./model\";

export function use{$studly}Table (tableRef: Ref) {
    const router = useRouter();
    const endpoint = crudApi(\"{$slug}\").getUrl();
    const options = {
        ajax: {
            url: endpoint,
        },
        order: [[1, \"asc\"]],
        columns: [
            // { data: \"_dtRowIndex\", title: \"#\" },"
?>
<?php
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
            ?>
<?= "
            {
                searchable: false,
                orderable: false,
                data: \"id\",
                title: \"Tindakan\",
                render: dtActionWrapper(
                    dtAction({
                        icon: \"fas fa-eye\",
                        color: \"primary\",
                        action: \"view\",
                    }),
                    dtAction({
                        icon: \"fas fa-pencil\",
                        color: \"warning\",
                        action: \"edit\",
                    }),
                    dtAction({
                        icon: \"fas fa-trash\",
                        color: \"danger\",
                        action: \"destroy\",
                        urlTo: \"{$slug}\",
                    })
                ),
            },
        ],

        // eslint-disable-next-line @typescript-eslint/no-explicit-any
        createdRow: function (element: HTMLElement, data: {$studly}) {
            dtActionTrigger(element, \"view\", () =>
                router.push(`/{$slug}/\${data.id}`)
            );
            dtActionTrigger(element, \"edit\", () =>
                router.push(`/{$slug}/\${data.id}/edit`)
            );
            dtActionTrigger(element, \"destroy\", () => deleteData(data));
        }
    }

    async function deleteData(data: {$studly}) {
        try {
            const result = await widget.confirm();
            if (!result.isConfirmed) {
                widget.alertSuccess(\"Hapus Batal.\", \"Data masih selamat.\");
                return;
            }

            await crudApi<{$studly}>(\"{$slug}\").destroy(data.id);
            widget.alertSuccess(\"Terbaik!\", \"Data anda telah dihapuskan.\");
            tableRef.value?.reload();
        } catch (err: unknown) {
            handleError(err);
        }
    }

    return { options, reload: tableRef.value?.reload(), search: tableRef.value?.search() };
}
"?>
