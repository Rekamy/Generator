<?="
import { User } from './../user'

export interface AuthenticationResponse {
    user: User,
    token: string,
    scopes: string,
}

export enum Roles {
    SuperAdmin,
    Admin,
    JUUAdmin,
    DepartmentAdmin,
    DepartmentUser,
    Guest,
}

export class Permissions {\n"?><?php foreach ($routes as $name) {
echo "\t{$name}_index = '{$name}_index';\n";
echo "\t{$name}_create = '{$name}_create';\n";
echo "\t{$name}_show = '{$name}_show';\n";
echo "\t{$name}_update = '{$name}_update';\n";
echo "\t{$name}_destroy = '{$name}_destroy';";}?><?="
}

/**
 * DepartmentBloc Type
 *
 *
 * Instantiate storage with default data
 * ```
 * init()
 * ```
 *
 *
 * Instantiate storage with default data
 * ```
 * caseLot typeof object[]
 * ```
 */
export type AuthBloc = {
  store: any
  api: any
  isAuthenticated: any
  // isAuthenticated: any

  /**
   * Get all caseLotc
   */
  authenticate: (data: any) => Promise<AuthenticationResponse>

  /**
   * Get all caseLot
   */
  register: (data: any) => Promise<AuthenticationResponse>

  /**
   * Get all caseLot
   */
  logout: () => void

  clearSession: () => void

  restoreAuthState: () => void
}
"