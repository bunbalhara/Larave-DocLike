import React from "react";
import {useDispatch, useSelector} from "react-redux";
import {SET_JOB_POST_AGE} from "../../../actions/type";
export const SelectAge = () =>{
    const dispatch = useDispatch();
    const age = useSelector(state=>state.jobPost.post.age)
    const handleChange = (e) => {
        dispatch({type: SET_JOB_POST_AGE, payload: e.target.value})
    }
    return (
        <div className='container flex flex-column align-items-center justify-content-around content-item'>
            <div className='d-flex justify-content-center align-items-center flex-column select-age'>
                <h2
                    style={{
                        fontWeight: 600,
                    }}
                >
                    How old is the patient?
                </h2>
                <input
                    value={age}
                    onChange={handleChange}
                    type='number'
                    min='0'
                    style={{
                        width: 120,
                        height: 50,
                        outline:'none',
                        border:'solid 1px #8080807f',
                        fontStyle:'normal',
                        fontSize: 24,
                        marginTop: 50
                    }}
                />
            </div>
        </div>
    )
}
