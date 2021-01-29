<?= "
export interface I${studly} {
    readonly id: number
    name: string
    description: string
}

export class ${studly} {
    public id!: number;
    public name!: string;
    public description!: string;
    public status!: string;
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
 * ${camel} typeof object[]
 * ```
 */
export type ${studly}Bloc = {
    state: any
    /**
     * Get data from storage
     */
    init: () => void

    /**
     * Get ${camel} by id
     */
    all: () => [${studly}]

    /**
     * Get ${camel} by id
     */
    first: (id: number) => ${studly}

    /**
     * Create new ${camel} and sync to storage
     */
    create: (${camel}: ${studly}) => void

    /**
     * update specified ${camel} and sync to storage
     */
    update: (id: number, request: ${studly}) => void

    /**
     * destroy specified ${camel} and sync to storage
     */
    destroy: (id: number) => void
    ${camel}: any
}


// export type ${studly} = {
//     readonly id: number
//     name: string
// }

"