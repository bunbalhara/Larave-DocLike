
import {Api} from "../api";
import {FormatNumberLength} from '../helpers'
import {
    SET_JOB_POST_AGE, SET_JOB_POST_APPOINTMENT, SET_JOB_POST_APPOINTMENT_SHIFT,
    SET_JOB_POST_CATEGORY, SET_JOB_POST_CONTACT_DETAIL, SET_JOB_POST_DATE,
    SET_JOB_POST_ERROR,
    SET_JOB_POST_LOCATION,
    SET_JOB_POST_SHOW_MAP,
    SET_JOB_POST_SUBCATEGORY, SET_JOB_POST_TIME,
    GET_OFFERS_START,
    GET_OFFERS_SUCCESS,
    GET_OFFERS_FAILURE,
} from "./type";
const api = new Api();
export const JOB_POST_NEXT = 'JOB_POST_NEXT';
export const JOB_POST_BACK = 'JOB_POST_BACK';
export const SELECT_POST_METHOD = 'SELECT_POST_METHOD';
export const SET_ALL_CATEGORIES = 'SET_ALL_CATEGORIES';

export const postRequest = () => async (dispatch, getState) => {
    const state = getState();
    const post = state.jobPost.post;
    const user = state.auth.user;
    let type;
    if(post.method.title === 'Online'){
        type = 1;
    }else if(post.method.title === 'At Home'){
        type = 2;
    }else {
        type = 3;
    }

    let date = post.dateTime.date;

    if(date.toLowerCase() === 'today'){
        let today = new Date()
        date = today.getFullYear() + '-' + FormatNumberLength(today.getMonth()+1, 2)+'-'+FormatNumberLength(today.getDate(),2);
    }else if(post.dateTime.date.toLowerCase() === 'tomorrow'){
        let today = new Date();
        date = today.getFullYear() + '-' + FormatNumberLength(today.getMonth()+1, 2)+'-'+FormatNumberLength(today.getDate()+1,2);
    }else{
        let today = new Date(date);
        date = today.getFullYear() + '-' + FormatNumberLength(today.getMonth()+1, 2)+'-'+FormatNumberLength(today.getDate(),2);
    }

    let time = post.dateTime.time;
    let start_time, end_time;
    if(time.toLowerCase() === 'as soon as possible'){
        let today = new Date();
        start_time = FormatNumberLength(today.getHours(), 2) + ':' + FormatNumberLength(today.getMinutes(), 2)+':'+FormatNumberLength(today.getSeconds(),2);
        if(today.getHours() + 5 > 23){
            end_time = FormatNumberLength(today.getHours() + 5 - 24, 2) + ':' + FormatNumberLength(today.getMinutes(), 2)+':'+FormatNumberLength(today.getSeconds(),2);
        }else {
            end_time = FormatNumberLength(today.getHours() + 5, 2) + ':' + FormatNumberLength(today.getMinutes(), 2)+':'+FormatNumberLength(today.getSeconds(),2);
        }
    }else if(time.toLowerCase() === 'morning 7:00 ~ 12:00'){
        start_time='07:00:00';
        end_time='12:00:00';
    }else if(time.toLowerCase() === 'afternoon 12:00 ~ 17:00'){
        start_time='12:00:00';
        end_time='17:00:00';
    }else if(time.toLowerCase() === 'evening 17:00 ~ 21:00'){
        start_time='17:00:00';
        end_time='21:00:00';
    }else if(time.toLowerCase() === 'night 21:00 ~ 7:00'){
        start_time='21:00:00';
        end_time='7:00:00';
    }

    const data = {
        user_id: user.id,
        type: type,
        status: user.status,
        patient_name:post.contact.fullName,
        category_id: post.category.id,
        sub_category_id: post.subcategory.id,
        address: post.address.address,
        city: post.address.city,
        state: post.address.state,
        latitute: post.address.location.lat,
        longitute: post.address.location.lng,
        age: post.age,
        date: date,
        email: post.contact.email,
        phone: post.contact.phone,
        start_time: start_time,
        end_time: end_time,
        offerBy: post.contact.offerBy,
        gender: post.contact.gender,
    }
    const res = await api.submitPost(data)
    if(res.success){
        let token = res.data.appointment.token;
        if(token){
            window.location.href='http://book.doclike.localhost?token='+token;
        }
        dispatch({type: JOB_POST_NEXT, payload:{activeStep: 9}})
        dispatch({type: SET_JOB_POST_SHOW_MAP, payload: true})
        dispatch({type: SET_JOB_POST_APPOINTMENT, payload: res.data.appointment})
        dispatch({type: SET_JOB_POST_APPOINTMENT_SHIFT, payload: res.data.appointmentShift})
        if(res.data.status === 0){
            dispatch({type: SET_JOB_POST_ERROR, payload:'You have already active request, If you want new request, please cancel your current request.'})
        }
    }
}

export const jobPostNext = () => async (dispatch, getState) => {
    const state = getState();
    const post = state.jobPost.post;
    const activeStep = state.jobPost.activeStep;

    if(activeStep === 2 && post.address.address === ''){
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: true, errorText:'Please Select a Location'}})
    }else if(activeStep === 3 && post.category === null){
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: true, errorText:'Please Select a Category'}})
    } else if(activeStep === 4 && post.subcategory === null){
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: true, errorText:'Please Select a Subcategory'}})
    } else if(activeStep === 5 && post.dateTime.date === null){
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: true, errorText:'Please Select a Date'}})
    } else if(activeStep === 5 && post.dateTime.time === null){
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: true, errorText:'Please Select a Time'}})
    } else if(activeStep === 6 && post.age === ''){
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: true, errorText:'Please Select a Location'}})
    }else if(activeStep === 7 && (post.contact === null || post.address.address === '')){
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: true, errorText:'Please Complete Contact Forms'}})
    } else{
        if(activeStep === 1){
            dispatch({type: SET_JOB_POST_SHOW_MAP, payload: true})
        }
        dispatch({type: JOB_POST_NEXT, payload:{activeStep: activeStep + 1}})
    }
}

export const jobPostBack= (data) => async (dispatch, getState) => {
    const state = getState();
    const postMethod = state.jobPost.post.method;
    const methods = state.jobPost.methods;
    const activeStep = state.jobPost.activeStep;

    if(postMethod ===  methods[0] && activeStep === 3){
        dispatch({type: SET_JOB_POST_SHOW_MAP, payload: false})
        dispatch({type: JOB_POST_BACK, payload:{activeStep: 1}})
    }else {
        if(activeStep === 2){
            dispatch({type: SET_JOB_POST_SHOW_MAP, payload: false})
            dispatch({type: SET_JOB_POST_LOCATION, payload: {address:'', location:null}})
            // dispatch({type: SELECT_POST_METHOD, payload: null})
        }else if(activeStep === 3){
            dispatch({type: SET_JOB_POST_CATEGORY, payload: null})
            // dispatch({type: SELECT_POST_METHOD, payload: null})
        }else if(activeStep === 4){
            dispatch({type: SET_JOB_POST_SUBCATEGORY, payload: null})
            // dispatch({type: SET_JOB_POST_CATEGORY, payload: null})
        } else if(activeStep === 5){
            dispatch({type: SET_JOB_POST_DATE, payload: null})
            dispatch({type: SET_JOB_POST_TIME, payload: null})
            // dispatch({type: SET_JOB_POST_SUBCATEGORY, payload: null})
        }else if(activeStep === 6){
            dispatch({type: SET_JOB_POST_AGE, payload: ''})
            // dispatch({type: SET_JOB_POST_DATE, payload: null})
            // dispatch({type: SET_JOB_POST_TIME, payload: null})
        }else if(activeStep === 7){
            dispatch({type: SET_JOB_POST_CONTACT_DETAIL, payload: null})
            // dispatch({type: SET_JOB_POST_AGE, payload: ''})
        }

        dispatch({type: JOB_POST_BACK, payload:{activeStep: activeStep - 1}})
    }
}

export const selectPostMethod = (data, callback) => async (dispatch, getState) => {

    dispatch({type:SELECT_POST_METHOD, payload:data});

    if(callback){
        callback();
    }
}

export const getAllCategories = (callBack) => async (dispatch) => {
    const res = await api.getAllCategories();
    if(res.success){
        dispatch({type: SET_ALL_CATEGORIES, payload: res.data})
    }else {
        dispatch({type: SET_ALL_CATEGORIES, payload: []})
    }
    if(callBack){
        callBack();
    }
}

export const getAppointment = (callBack) => async (dispatch) => {
    const res = await api.getAppointment();
    if(res.success){
        console.log(res.data)
        dispatch({type: SET_JOB_POST_APPOINTMENT, payload: res.data})
        if(res.data){
            dispatch({type: JOB_POST_BACK, payload:{activeStep: 9}})
            dispatch({type: SET_JOB_POST_SHOW_MAP, payload: true})
        }
    }else {
        dispatch({type: SET_JOB_POST_APPOINTMENT, payload: null})
    }
    if(callBack){
        callBack(res);
    }
}


export const getOffers = (appointmentId, callback) => async (dispatch) =>{
    dispatch({type: GET_OFFERS_START});
    const res = await api.getOffers(appointmentId);
    if(res.success){
        dispatch({type: GET_OFFERS_SUCCESS, payload: res.data})
    }else{
        dispatch({type: GET_OFFERS_FAILURE})
    }
    if(callback){
        callback(res)
    }
}
