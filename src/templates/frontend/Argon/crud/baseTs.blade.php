<?=

"
import { Vue } from \"vue-class-component\";
import Swal from \"sweetalert2\";

export default class Charges extends Vue {
    Swal!: typeof Swal

    options: object = {}
    $camelId: object[] = []
    events: object[] = []

    mounted() {
        this.setData()
        this.options = {
            data: this.$camelId,
            columns: [\n" ?><?php
            foreach ($columns as $column) :
                echo "\t\t\t\t{ data: '" . $column->getName() . "' },\n";
            endforeach;
            ?>
<?= "\t\t\t\t{
                    data: 'id',
                    render: function (data: string, type: string, row: any) {

                        let html = `<div class=\"btn-group\" role=\"group\" aria-label=\"Action Button Group\">`;
                        html += `<button type=\"button\" class=\"btn btn-success btn-sm view\"><i class=\"far fa-eye\" data-placement=\"top\" title=\"View\" data-id=\"\${data}\"></i></button>`;
                        html += `<button type=\"button\" class=\"btn btn-primary btn-sm edit\"><i class=\"fas fa-edit\" data-placement=\"top\" title=\"Edit\" data-id=\"\${data}\"></i></button>`;
                        html += `<button type=\"button\" class=\"btn btn-danger btn-sm delete\"><i class=\"far fa-trash-alt\" data-placement=\"top\" title=\"Delete\" data-id=\"\${data}\"></i></button>`;
                        html += `</div>`;

                        return html;
                    }

                },
            ]
        }
        this.registerEvents();
    }

    registerEvents() {
        this.events = [
            {
                selector: '.view',
                trigger: 'click',
                action: (jquery: any) => this.viewData(jquery.target.dataset.id)
            },
            {
                selector: '.edit',
                trigger: 'click',
                action: (jquery: any) => this.editData(jquery.target.dataset.id)
            },
            {
                selector: '.delete',
                trigger: 'click',
                action: (jquery: any) => this.deleteData(jquery.target.dataset.id)
            },
        ]
    }

    viewData(value: any) {
        this.\$router.push('/crud/$slugId/view');
    }

    editData(value: any) {
        this.\$router.push('/crud/$slugId/edit');
    }

    deleteData(value: any) {
        this.Swal.fire({
            title: 'Are you sure?',
            text: \"You won't be able to revert this!\",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
            }
        })
    }

    setData() {
        this.$camelId = [\n"?>
<?php 
        for ($i=10;$i > 0;$i--) :
            echo "\t\t\t{\n";
            foreach ($columns as $column) :
                echo "\t\t\t\t" . $column->getName() . ": '".   $column->getName() . "',\n";
            endforeach;
            echo "\t\t\t},\n";
        endfor;
?>
<?= "\t\t]
    }
}

"
?>