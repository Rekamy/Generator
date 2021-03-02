<?="
import StorageCore from \"@/core/utils/storage\";

class StorageService extends StorageCore {
    [key: string]: any;
    readonly AUTH: string = 'auth';

    constructor() {
        super();
        this.init();
    }
}


const service = new StorageService();
export default service;
"