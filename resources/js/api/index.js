
import axios from 'axios';
const baseURL = window.Laravel.production?
    'https://find.doclike.fr/api/':
    'http://find.doclike.localhost/api/'

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    'Authorization': 'Bearer ' + window.Laravel.apiToken,
}

const  Axios = axios.create({
    baseURL: baseURL,
    timeout: 15000
});

export class Api {
    getAllCategories (){
        return new Promise(resolve => {
            Axios.get('/get-categories').then((res)=>{
                if(res.status === 200){
                    resolve({success: true, data: res.data})
                }else{
                    resolve({success: false, data: []})
                }
            }).catch(err=>{
                console.log(err)
            })
        })
    }

    getAppointment(){
        return new Promise(resolve => {
            Axios.post('/get-appointment',{token: window.Laravel.appointmentToken}).then((res)=>{
                if(res.status === 200){
                    let data = res.data;
                    if(data.status === 1){
                        resolve({success: true, data: data.data})
                    }else {
                        resolve({success: false, data: null})
                    }
                }else{
                    resolve({success: false, data: null})
                }
            }).catch(err=>{
                console.log(err)
            })
        })
    }

    getCurrentUser(){
        return new Promise(resolve => {
            Axios.get('/get-current-user').then(res=>{
                if(res.status=== 200){
                    resolve({success: true, data: res.data})
                }else {
                    resolve({success: false, data:[]})
                }
            })
        })
    }

    submitPost(post){
        return new Promise(resolve => {
            Axios.post('/save-post', post).then((res)=>{
                if(res.status === 200){
                    resolve({success: true, data: res.data})
                }else{
                    resolve({success: false, data: []})
                }
            }).catch(err=>{
                console.log(err)
            })
        })
    }

    getOffers(appointmentId){
        return new Promise(resolve => {
            Axios.post('/get-offers', {appointmentId: appointmentId}).then(res=>{
                if(res.status === 200){
                    resolve({success: true, data: res.data})
                }else{
                    resolve({success: false})
                }
            })
        })
    }

    getRoutesBetweenToLocations(from, to){
        return new Promise(resolve => {
            Axios.post('/get-map-routes', {from:from, to:to}).then(res=>{
                if(res.status === 200){
                    resolve({success: true, data: res.data})
                }else{
                    resolve({success: false})
                }
            })
        })
    }
}
