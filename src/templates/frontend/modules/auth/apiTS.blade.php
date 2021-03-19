<?= 
"
import { api } from '@/core/services/api';
import { User } from './../user';


export class AuthApi {
    private BASE_URL: string;

    constructor() {
        this.BASE_URL = \"\";
    }

    async login (data: User): Promise<any>{
        return await api.post<any>('/login',data,true);
    }

    async logout (): Promise<any>{
        return await api.post<any>('/logout',null,true);
    }

    async register (data: User): Promise<any> {
        return await api.post<any>(`/register`, data, false);
    }
}

const authApi = new AuthApi();
export { authApi };
"
?>