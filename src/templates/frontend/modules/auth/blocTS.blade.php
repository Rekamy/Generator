<?= "
import { AuthBloc, AuthenticationResponse, authApi } from \"./index\"
import { ref, reactive, onBeforeMount, onUpdated, watch } from \"vue\"
import { useStore } from \"vuex\"
import { store } from \"@/core/services/store\"
import storage from '@/services/storage';
import router from '@/router';
import { User } from './../user'



/**
 * DepartmentFactory to instantiate CaseLotBloc instance.
 *
 * Example with vue-class-components composition API:
 * ```
 * import { Vue, setup } from \"vue-class-component\";
 * import { caseLotFactory, CaseLotBloc } from \"@/services/bloc/index\";
 *
 * class ComponentA extends Vue {
 *     caseLotBloc: CaseLotBloc = setup(() => caseLotFactory())
 * }
 * ```
 */

export function authFactory (): AuthBloc {
  const module = 'auth'
  // const store = useStore()
  const api = authApi
  const isAuthenticated = ref(false)

  async function register (data: User): Promise<AuthenticationResponse> {
    let response = await api.register(data)
    store.commit('auth/authenticate', response)
    storage.set(storage.AUTH, response)
    return response;
  }

  async function authenticate (data: User): Promise<AuthenticationResponse> {
    let response = await api.login(data)
    store.commit('auth/authenticate', response)
    storage.set(storage.AUTH, response)
    return response;
  }

  async function logout () {
    // ask server to purge token
    tryLogout();
    // clear local token and state
    store.commit('auth/signOut');
    await clearSession();
    router.replace('/login');
  }

  async function tryLogout () {
    try {
        await api.logout()
    } catch (error) {
    }
  }

  async function clearSession () {
    await storage.clearAll()
  }

  async function restoreAuthState () {
    // const authStorage: any = await storage.get(storage.AUTH);
    // if (!authStorage) return;

    // console.log(store);

    // store.commit('auth/authenticate', {
    //     token: authStorage.token,
    //     user: authStorage.user,
    // })
    // const authStore: any = store.state
    // const authState: any = authStore.auth
    // console.log(authState.auth.loggedIn);
  }


  return {
    isAuthenticated,
    store,
    api,
    restoreAuthState,
    register,
    authenticate,
    logout,
    clearSession,
  }

}
"
?>