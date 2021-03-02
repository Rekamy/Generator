<?= "
import { AuthBloc, AuthenticationResponse, authApi } from \"./index\"
import { ref, reactive, onBeforeMount, onUpdated, watch } from \"vue\"
import { useStore } from \"vuex\"
import { store } from \"@/core/services/store\"
import storage from '@/services/storage';
import router from '@/router';
import { User } from './../user'

"