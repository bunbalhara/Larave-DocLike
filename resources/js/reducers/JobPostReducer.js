
import {assets} from "../helpers";
import {
    SELECT_POST_METHOD,
    SET_ALL_CATEGORIES,
    JOB_POST_NEXT,
    JOB_POST_BACK, GET_OFFERS_FAILURE
} from "../actions";
import {
    SET_JOB_POST_CATEGORY,
    SET_JOB_POST_SUBCATEGORY,
    SET_JOB_POST_TIME,
    SET_JOB_POST_DATE,
    SET_JOB_POST_AGE,
    SET_JOB_POST_LOCATION,
    SET_JOB_POST_CONTACT_DETAIL,
    SET_JOB_POST_SHOW_MAP,
    SET_JOB_POST_ERROR,
    SET_JOB_POST_APPOINTMENT,
    SET_JOB_POST_APPOINTMENT_SHIFT,
    GET_OFFERS_START,
    GET_OFFERS_SUCCESS,
    JOB_POST_REFRESH,
} from "../actions/type";

const  methods = [
    {
        title: 'Online',
        description:'As a video visit',
        inActiveIcon: assets('icons/videocam-green-52.png'),
        activeIcon: assets('icons/videocam-white-52.png')
    },
    {
        title: 'At Home',
        description:'The doctor will come to my place',
        inActiveIcon: assets('icons/house-call-green-52.png'),
        activeIcon: assets('icons/house-call-white-52.png')
    },
    {
        title: 'At the Doctors\' Office',
        description:'I will go see the doctor',
        inActiveIcon: assets('icons/hospital-green-52.png'),
        activeIcon: assets('icons/hospital-white-52.png')
    }
]

const INIT_STATE = {
    maxStep: 9,
    activeStep: 1,
    post:{
        method: null,
        address: {
            address:'',
            location:null
        },
        category:null,
        subcategory:null,
        dateTime:{
            date: null,
            time: null,
        },
        age:'',
        contact:null,
    },
    postInfo: null,
    methods: methods,
    allCategories:[],
    isShowMap: false,
    isError: false,
    errorText:'ERROR',
    appointment:null,
    appointmentShift: null,
    offers: null,
};

export default (state = INIT_STATE, action) => {
    switch (action.type) {
        case SELECT_POST_METHOD:
            let activeStep = 2;
            let isShowMap = true;
            if(action.payload === state.methods[0]){
                activeStep = 3;
                isShowMap = false;
            }
            return {
                ...state,
                post:{...state.post, method: action.payload},
                activeStep: activeStep,
                isShowMap: isShowMap,
            }
        case SET_ALL_CATEGORIES:
            return {
                ...state,
                allCategories: action.payload
            }
        case JOB_POST_NEXT:
            return {
                ...state,
                activeStep: action.payload.activeStep
            }
        case JOB_POST_BACK:
            if(action.payload.activeStep === 1){
                return {
                    ...state,
                    activeStep:
                    action.payload.activeStep,
                    post: {...state.post, method: null},
                    isShowMap: false,
                }
            }else {
                return {
                    ...state,
                    activeStep:
                    action.payload.activeStep
                }
            }

        case SET_JOB_POST_CATEGORY:
            return  {...state, post: {...state.post, category: action.payload}}
        case SET_JOB_POST_SUBCATEGORY:
            return {...state, post: {...state.post, subcategory: action.payload}}
        case SET_JOB_POST_TIME:
            return {...state, post: {...state.post, dateTime: {...state.post.dateTime, time: action.payload}}}
        case SET_JOB_POST_DATE:
            return {...state, post: {...state.post, dateTime: {...state.post.dateTime, date: action.payload}}}
        case SET_JOB_POST_AGE:
            return {...state, post: {...state.post, age: action.payload}}
        case SET_JOB_POST_LOCATION:
            return {...state, post: {...state.post, address: action.payload}}
        case SET_JOB_POST_CONTACT_DETAIL:
            return {...state, post: {...state.post, contact: action.payload}}
        case SET_JOB_POST_APPOINTMENT:
            return {...state, appointment: action.payload}
        case SET_JOB_POST_APPOINTMENT_SHIFT:
            return {...state, appointmentShift: action.payload}
        case SET_JOB_POST_SHOW_MAP:
            return {...state, isShowMap: action.payload}
        case SET_JOB_POST_ERROR:
            return {...state, isError: action.payload.error, errorText: action.payload.errorText}
        case GET_OFFERS_START:
            return {...state}
        case GET_OFFERS_SUCCESS:
            return {...state, offers: action.payload}
        case GET_OFFERS_FAILURE:
            return {...state, offers: null}
        case JOB_POST_REFRESH:
            return {...state, activeStep: 1, post:{
                    method: null,
                    address: {
                        address:'',
                        location:null
                    },
                    category:null,
                    subcategory:null,
                    dateTime:{
                        date: null,
                        time: null,
                    },
                    age:'',
                    contact:null,
                }, isShowMap:false}
        default:
            return {...state}
    }
}
