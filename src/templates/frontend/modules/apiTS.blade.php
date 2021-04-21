<?= "
import CrudApi from '@/core/abstracts/crud-api';

export class {$studly}Api extends CrudApi {
    
    constructor() {
        super();
        this.BASE_URL = \"/{$slug}\";
    }

}

const {$camel}Api = new {$studly}Api();
export { {$camel}Api };
"
?>