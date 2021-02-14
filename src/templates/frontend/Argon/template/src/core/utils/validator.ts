import Validator from 'fastest-validator';

const v = new Validator();

interface  IValidator {
    rules : any;
    validate(): {success: boolean, message: any};
    data(): any;
}

export abstract class Validators implements IValidator {
    abstract rules:any;
    [key: string]: any;
    validate(){
        const obj:any = {};
        for(let variable in this){
            if(variable != "rules"){
                obj[variable] = this[variable];
            }
        }

        const res = v.validate(obj, this.rules);
        if(res !== true){
            return {success: false, message: res};
        }
    
        return {success: true, message: obj};
    }

    data(){
        const obj:any = {};
        for(let variable in this){
            if(variable != "rules"){
                obj[variable] = this[variable];
            }
        }
        return obj;
    }

    formData(ref: any){
        const form = new FormData(ref);
        form.forEach((value, key) => {
            if(key.includes("[") && key.includes("]")){
                if(this[key]){
                    this.key = [];
                }

                this[key].push(value);
                return;
            }
            this[key] = value;
        });
        return form;
    }
}