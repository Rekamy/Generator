import { createApp } from 'vue'
import App from '@/App.vue'
import router from '@/router';
import {store} from '@/core/services/store';

import plugins from '@/core/plugins'
import storage from '@/core/utils/storage'

const tables: Array<string> = [
    'auth',
    'user'
];
storage.init(tables);

const app = createApp(App)
.use(router)
.use(store)
.use(plugins)

// .mount('#app')
router.isReady().then(() => app.mount('#app'))

