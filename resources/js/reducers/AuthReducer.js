import {GET_AUTH_USER_FAILURE, GET_AUTH_USER_START, GET_AUTH_USER_SUCCESS} from "../actions";

const INIT_STATE = {
    user: null
};

export default (state = INIT_STATE, action) => {
    switch (action.type) {
        case GET_AUTH_USER_START:
            return {...state};
        case GET_AUTH_USER_SUCCESS:
            return {...state, user: action.payload}
        case GET_AUTH_USER_FAILURE:
            return {...state, user: null}
        default:
            return {...state}
    }
}
