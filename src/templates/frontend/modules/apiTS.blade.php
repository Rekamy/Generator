<?= "
import { api } from '@/core/services/api';
import { {$studly} } from './index';
import CrudApi from '@/core/abstracts/crud-api';


export class {$studly}Api extends CrudApi {
    private BASE_URL: string;

    
    constructor() {
        super();
        this.BASE_URL = \"/{$slug}\";
    }
}

const {$camel}Api = new {$studly}Api();
export { {$camel}Api };
"
?>