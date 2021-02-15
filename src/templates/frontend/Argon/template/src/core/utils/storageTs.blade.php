import { BehaviorSubject } from 'rxjs/internal/BehaviorSubject';

class StorageService  {
  [key: string]: any;
  USER = 'user';


  protected obs:any = {};
  protected mut:any = {};
  constructor() {
  }

  init(tables) {
    for(let table in tables){
      this[table.toUpperCase()] = table;
    }
    
    for(let table in this){
      if(table != "obs" && table != "mut"){
          this.obs[this[table]] = new BehaviorSubject(null);
          this.mut[this[table]] = localStorage.getItem(table);
      }
    }
  }

  set(table: string, value: any) {
    try {
      this.mut[table] = value;
      this.obs[table].next(value);
      return localStorage.setItem(table, JSON.stringify(value));
    } catch (e) {
      throw e;
    }
  }

  get<T>(table: string): T {
    try {
      const data: any = localStorage.getItem(table);
      return JSON.parse(data);
    } catch (e) {
      console.log(e);
      const data: any = null;
      return <T>data;
    }
  }

  observable(table: string) {
    try {
      return this.obs[table];
    } catch (e) {
      throw e;
    }
  }

  mutator(table: string) {
    try {
      return this.mut[table];
    } catch (e) {
      throw e;
    }
  }

  clear(table: string) {
    try {
      this.mut[table] = null;
      this.obs[table].next(null);
      localStorage.removeItem(table);
    } catch (e) {
      throw e;
    }
  }

  clearAll(){
    try{
      localStorage.clear();
    } catch (e) {
      throw e;
    }
  }
}

const storage = new StorageService();
export default storage;
