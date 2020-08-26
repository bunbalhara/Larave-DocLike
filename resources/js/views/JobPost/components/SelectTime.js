import React, {useEffect} from "react";
import {useDispatch, useSelector} from "react-redux";
import {assets} from "../../../helpers";
import {SET_JOB_POST_TIME,SET_JOB_POST_DATE} from "../../../actions/type";
import DatePicker from 'react-custom-date-picker';
import {JOB_POST_NEXT} from "../../../actions";
import $ from 'jquery'
const SelectDatePickerItem = ({text}) => {
    const dispatch = useDispatch();
    const dateTime = useSelector(state=>state.jobPost.post.dateTime)
    const [date, setDate] = React.useState(null);
    const [active, setActive] = React.useState(false);
    const [keepOpen, setKeepOpen] = React.useState(false);
    const handleDateChange = (date) => {
        const selectedDate = `${date.getFullYear()}/${date.getMonth()+1}/${date.getDate()}`
        dispatch({type: SET_JOB_POST_DATE, payload: selectedDate})
        setKeepOpen(false);
    }

    useEffect(()=>{
        if(dateTime.date !== 'Today' && dateTime.date !== 'Tomorrow' && dateTime.date !== null){
            setDate(new Date(dateTime.date))
        }else {
            setDate(new Date())
        }
        setActive( dateTime.date !== 'Today' && dateTime.date !== 'Tomorrow' && dateTime.date !== null);
    },[dateTime])

    return (
        <div
            className='d-flex justify-content-center align-items-center  select-time-item'
            style={{
                width: '100%',
                maxWidth: 400,
                padding: 2,
                borderRadius:999999,
                backgroundColor: active?'#299acf':'white',
                border: active?'solid 1px #299acf':'solid 1px #8080807f',
                cursor:'pointer'
            }}
        >
            {
                active ?
                <DatePicker
                    date = {date}
                    handleDateChange={handleDateChange}
                    minDate={new Date()}
                    width={300}
                    keepOpen={keepOpen}
                    inputStyle={{
                        width: 300,
                        border:'none',
                        outline:'none',
                        textAlign:'center',
                        backgroundColor: 'transparent',
                        color:active?'white':'grey',
                        cursor:'pointer',
                    }}
                />:
                <span
                    style={{
                        padding: 6,
                        color:active?'white':'grey',
                    }}
                    onClick={()=>{
                        setActive(true);
                        setKeepOpen(true);
                    }}
                >
                    {text}
                </span>
            }

        </div>
    )
}



const SelectDateItem = ({text, active}) => {
    const dispatch = useDispatch();
    const handleClick = () => {
        dispatch({type: SET_JOB_POST_DATE, payload: text})
    }
    return (
        <div
            className='d-flex justify-content-center align-items-center select-time-item'
            style={{
                width: '100%',
                maxWidth: 400,
                padding: 6,
                borderRadius:999999,
                backgroundColor: active?'#299acf':'white',
                border: active?'solid 1px #299acf':'solid 1px #8080807f',
                cursor:'pointer'
            }}
            onClick={handleClick}
        >
            <span
                style={{
                    color:active?'white':'grey',
                    fontSize:16,
                    fontWeight: 500,
                }}
            >{text}</span>
        </div>
    )
}


const SelectTimeItem = ({image, text, active}) => {

    const dispatch = useDispatch();

    const handleClick = () => {
        dispatch({type: SET_JOB_POST_TIME, payload: text})
    }

    return (
        <div
            className='d-flex justify-content-center align-items-center select-time-item'
            style={{
                width: '100%',
                maxWidth: 400,
                padding: 6,
                borderRadius:999999,
                backgroundColor: active?'#299acf':'white',
                border: active?'solid 1px #299acf':'solid 1px #8080807f',
                cursor:'pointer'
            }}
            onClick={handleClick}
        >
            {
                image &&
                    <img src={image} alt={text}/>
            }
            <span
                style={{
                    color:active?'white':'grey',
                    fontSize:16,
                    fontWeight: 500,
                    paddingLeft: 20,
                }}
            >{text}</span>
        </div>
    )
}

export const SelectTime = () =>{
    const dateTime = useSelector(state=>state.jobPost.post.dateTime)
    const activeStep = useSelector(state=>state.jobPost.activeStep);
    const dispatch = useDispatch();

    useEffect(()=>{
        if(dateTime.date !== null && dateTime.time !== null){
            $('html, body').animate({scrollTop: 0})
            dispatch({type: JOB_POST_NEXT, payload:{activeStep: activeStep + 1}})
        }
    }, [dateTime]);

    return (
        <div className='container flex flex-column align-items-center justify-content-around content-item select-time' style={{paddingTop: 70}}>
            <div className='title'>
                <span>Select a Date</span>
            </div>
            <SelectDateItem
                text={'Today'}
                active={dateTime.date === 'Today'}
            />
            <SelectDateItem
                text={'Tomorrow'}
                active={dateTime.date === 'Tomorrow'}
            />
            <SelectDatePickerItem
                text={'Choose a date'}
            />
            <div className=' title'>
                <span>Select a Time</span>
            </div>
            <SelectTimeItem
                text={'As soon as possible'}
                active={dateTime.time === 'As soon as possible'}
            />
            <SelectTimeItem
                image={dateTime.time === 'Morning 7:00 ~ 12:00'? assets('icons/up_sun_white.png'):assets('icons/up_sun.png')}
                text={'Morning 7:00 ~ 12:00'}
                active={dateTime.time === 'Morning 7:00 ~ 12:00'}
            />
            <SelectTimeItem
                image={dateTime.time === 'Afternoon 12:00 ~ 17:00'? assets('icons/noun_morning_white.png'):assets('icons/noun_morning.png')}
                text={'Afternoon 12:00 ~ 17:00'}
                active={dateTime.time === 'Afternoon 12:00 ~ 17:00'}
            />
            <SelectTimeItem
                image={dateTime.time === 'Evening 17:00 ~ 21:00'? assets('icons/noun_sunset_white.png'):assets('icons/noun_sunset.png')}
                text={'Evening 17:00 ~ 21:00'}
                active={dateTime.time === 'Evening 17:00 ~ 21:00'}
            />
            <SelectTimeItem
                image={dateTime.time === 'Night 21:00 ~ 7:00'? assets('icons/moon_white.png'):assets('icons/moon.png')}
                text={'Night 21:00 ~ 7:00'}
                active={dateTime.time === 'Night 21:00 ~ 7:00'}
            />
        </div>
    )
}
