<?= "
import { api } from '@/services/api';

export class {$studly->singular()}Api {
    private BASE_URL: string;

    constructor() {
        this.BASE_URL = \"/{$table->singular()}\";
    }

    async get{$studly}(): Promise<any> {
        console.log('model get data')
        const endpoint = `\${this.BASE_URL}`;
        return api.get<any>(endpoint, true);
    }

}

const {$camel->singular()}Api = new {$studly->singular()}Api();
export { {$camel->singular()}Api };
" 
