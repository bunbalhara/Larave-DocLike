/**
 *
 * App Reducers
 *
 * */
import { combineReducers } from 'redux';
import jobPostReducer from './JobPostReducer';
import authReducer from './AuthReducer';
import appReducer from './AppReducer';

const reducers = combineReducers({
    auth: authReducer,
    jobPost: jobPostReducer,
    app: appReducer
});

export default reducers;
