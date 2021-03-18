<?= "
export interface I${studly} {
    readonly id: any;
    name: string
    description: string
}

export class ${studly} {
    public id!: any;
    public _method!: string;\n"?><?php
    foreach ($columns as $column) {
    $name = Str::of($column->getName());
    echo "\tpublic {$name}!: string;\n";}?><?=" 
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
    store: any
    api: any

    /**
     * Get all ${camel} 
     */
    get{$studly->plural()}: () => Promise<[${studly}]>

    /**
     * Get ${camel} by id
     */
    get{$studly}: (id: number) => Promise<${studly}>

    /**
     * Create new ${camel} and sync to storage
     */
    create{$studly}: (${camel}: ${studly}) => Promise<${studly}>

    /**
     * update specified ${camel} and sync to storage
     */
    update{$studly}: (${camel}: ${studly}) => Promise<${studly}>

    /**
     * destroy specified ${camel} and sync to storage
     */
    destroy{$studly}: (id: number) => Promise<void>
}


// export type ${studly} = {
//     readonly id: number
//     name: string
// }

"