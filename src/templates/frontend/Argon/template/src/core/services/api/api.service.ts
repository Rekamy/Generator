import environment  from '@/config/environment';
import axios from "axios";
import storage from '@/core/utils/storage';

class Api {

  public API_URL:any = environment.API_URL;
// public API_URL:any = "/api";

  constructor(){
  }


  toFormData(obj: any) {
    var form_data = new FormData();

    for ( var key in obj ) {
        form_data.append(key, obj[key]);
    }

    return form_data;
  }

  toSerialize(obj: any) {
    let query = '', name, value, fullSubName, subName, subValue, innerObj : any, i;
    for(name in obj) {
        value = obj[name];
        if(value instanceof Array) {
            for(i in value) {
                subValue = value[i];
                fullSubName = name + '[' + i + ']';
                innerObj = {};
                innerObj[fullSubName] = subValue;
                query += this.toParam(innerObj) + '&';
            }
        } else if(value instanceof Object) {
            for(subName in value) {
                subValue = value[subName];
                fullSubName = name + '[' + subName + ']';
                innerObj = {};
                innerObj[fullSubName] = subValue;
                query += this.toParam(innerObj) + '&';
            }
        } else if(value !== undefined && value !== null)
            query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
    }

    return query.length ? query.substr(0, query.length - 1) : query;
  }


  toParam(obj: any){
    let val = "";
    for ( var key in obj ) {
        val += `${key}=${obj[key]}`;
    }

    return val;
  }

  removeTrailingSlash(endpoint: any){
    const lastChar = endpoint[endpoint.length - 1]
    if(lastChar == "/"){
        endpoint = endpoint.substring(0, endpoint.length - 1);
    }

    return endpoint;
  }

  async apiError(error: any){
    switch(error.status){
      case 401:
        // this.widget.presentToast("Sesi log masuk anda telah tamat, sila log masuk semula");
        // await this.appCommon.logout();
        break;
      case 403:
        // console.log(403)
        // widget.toast("You Doesn`t Have Access to perform this process. Please contact company admin", "error");
        break;
      default:
        break;
    }
  }

  async headers(authCondition: any, withImage: any){
    let headers: any = {
        responseType: "json",
        'Content-Type':'application/json',
        'Authorization': "",
        'Accept': 'application/json'
    };

    // if(authCondition){
    //     let auth = await storage.get<any>(storage.AUTH);
    //     if(auth){
    //       headers.Authorization = `Bearer ${auth["access_token"]}`;
    //     }
    // }

    if(withImage){
      headers["Content-Type"] = `multipart/form-data`;
    }

    return { headers }
  }

   get<T>(endpoint: string, auth = false): Promise<T>{
    try {
      return new Promise( (resolve, reject) => {
        const headers =  this.headers(auth, endpoint);
        axios.get<T>(this.API_URL + endpoint).then((response: any) => {
          resolve(<T>response.data);
        }).catch((err: any) => {
          this.apiError(err.response.data);
          reject(err.response.data);
        });
      });
    } catch (e) {
       this.apiError(e);
      throw e;
    }
  }

   post<T>(endpoint: string, data: any, auth = false, withImage = false): Promise<T>{
    return new Promise( (resolve: any, reject: any) => {
      const headers =  this.headers(auth, withImage);
      axios.post<T>(this.API_URL + endpoint, data).then((response: any) => {
        resolve(<T>response.data);
      }).catch((err: any) => {
        this.apiError(err.response.data);
        reject(err.response.data);
      });
    });
  }

  async put<T>(endpoint: string, data: any, auth = false){
    try{
      const headers = await this.headers(auth, endpoint);
      const response =  await axios.put<T>(this.API_URL + endpoint, data, headers);
      return <T>response.data;
    } catch (e) {
      this.apiError(e);
      throw e;
    }
  }

  async delete<T>(endpoint: string, auth = false){
    try {
      const headers = await this.headers(auth, endpoint);
      const response =  await axios.delete<T>(this.API_URL + endpoint, headers);
      return <T>response.data;
    } catch (e) {
      await this.apiError(e);
      throw e;
    }
  }
}

const api = new Api();

export { api } ;
