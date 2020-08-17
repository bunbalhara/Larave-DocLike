
import {Api} from "../api";
import {
    GET_AUTH_USER_FAILURE,
    GET_AUTH_USER_START,
    GET_AUTH_USER_SUCCESS
} from "./type";

const api = new Api();

export const getAuthUser = (callback) => async (dispatch, getState) => {
    dispatch({type: GET_AUTH_USER_START});
    const user = await api.getCurrentUser();
    if(user.success){
        dispatch({type: GET_AUTH_USER_SUCCESS, payload: user.data})
    }else {
        dispatch({type: GET_AUTH_USER_FAILURE})
    }
    if(callback){
        callback();
    }
}

