<?= "
import { api } from '@/core/services/api';
import { {$studly} } from './index';

export class {$studly}Api {
    private BASE_URL: string;

    
    constructor() {
        this.BASE_URL = \"/{$slug}\";
    }

    async all(): Promise<any> {
        return await api.get<any>(this.BASE_URL, true);
    }

    async first(id: any): Promise<any> {
        return await api.get<any>(`\${this.BASE_URL}/\${id}`, true);
    }

    async create(data: any): Promise<any> {
        return await api.post<any>(this.BASE_URL, data, true);
    }

    async edit(id: any, data: any): Promise<any> {
        return await api.put<any>(`\${this.BASE_URL}/\${id}`, data, true);
    }

    async destroy(id: any): Promise<any> {
        return await api.delete<any>(`\${this.BASE_URL}/\${id}`, true);
    }

}

const {$camel}Api = new {$studly}Api();
export { {$camel}Api };
"