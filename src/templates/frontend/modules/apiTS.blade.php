<?= "
import { api } from '@/services/api';
import { {$studly->singular()} } from './index';

export class {$studly->singular()}Api {
    private BASE_URL: string;

    constructor() {
        this.BASE_URL = \"/{$table->singular()}\";
    }

    async all(): Promise<any> {
        return await api.get<any>(this.BASE_URL, true);
    }

    async first(id: number): Promise<any> {
        return await api.get<any>(`\${this.BASE_URL}/\${id}`, true);
    }

    async create(data: any): Promise<any> {
        return await api.post<any>(this.BASE_URL, data, true);
    }

    async edit(id: number, data: any): Promise<any> {
        return await api.put<any>(`\${this.BASE_URL}/\${id}`, data, true);
    }

    async destroy(id: number): Promise<any> {
        return await api.delete<any>(`\${this.BASE_URL}/\${id}`, true);
    }

}

const {$camel->singular()}Api = new {$studly->singular()}Api();
export { {$camel->singular()}Api };
" 
