<?=

"
import { Vue, setup } from \"vue-class-component\";
import { widget } from \"@/core/utils/widget\";
import { draw{$studly}Table } from \"@/modules/{$table}\";

export default class {$studly}Page extends Vue {
    table{$studly} = setup(() => draw{$studly}Table('#{$camel}List'))
}

"
?>