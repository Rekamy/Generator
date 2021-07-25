<?=

"
import { widget } from \"@/core/utils\";
import { draw{$studly}Table } from \"@/modules\";

export default defineComponent({
    setup() {
        return { ...draw{$studly}Table('#{$camel}List') }
    }
})

"
?>