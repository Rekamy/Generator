<?=

"
import { defineComponent } from \"vue\";
import { draw{$studly}Table } from \"@/modules\";

export default defineComponent({
    setup() {
        return { ...draw{$studly}Table('#{$camel}List') }
    }
})

"
?>