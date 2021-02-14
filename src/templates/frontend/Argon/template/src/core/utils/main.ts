export class Response {
    public message!: string;
    public success!: boolean;
}


export class DataTable {
    public current_page!: number;
    public first_page_url!: string;
    public from!: number;
    public to!: number;
    public total!: number;
    public last_page!: number;
    public per_page!: number;
    public path!: string;
    public last_page_url!: string;
    public next_page_url!: string;
    public prev_page_url!: string;
}

