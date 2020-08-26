import React, {useEffect, useRef} from "react";
import LinearProgress from '@material-ui/core/LinearProgress';
import {useDispatch, useSelector} from "react-redux";
import {withStyles} from "@material-ui/core";
import NavigationIcon from '@material-ui/icons/Navigation';
import {assets} from "../../../helpers";
import CloseIcon from '@material-ui/icons/Close';
import {cancelAppointment, JOB_POST_REFRESH} from "../../../actions";
import { confirmAlert } from 'react-confirm-alert'; // Import
import 'react-confirm-alert/src/react-confirm-alert.css' // Import css

const BorderLinearProgress = withStyles(() => ({
    root: {
        width:'100%',
        height: 8,
    },
    colorPrimary: {
        backgroundColor: '#8080807f',
    },
    bar: {
        backgroundColor: '#299acf',
    },
}))(LinearProgress);

const ProgressItem = ({image, text, icon, color, backgroundColor}) =>(
    <div className='progress-item' style={{backgroundColor: backgroundColor}}>
        {
            image &&
            <div className='icon-container' style={{backgroundColor: color}}>
                <img src={image} alt={text} style={{width: '100%', height: '100%', objectFit:'contain'}}/>
            </div>
        }
        {
            icon &&
            <div className='icon-container'>
                {icon}
            </div>
        }
        <div
            className={'text text-white '+(image?'ml-1':'') }
            style={{fontSize:14}}>
            {text?.toString().length < 25 ? text: text?.toString().substring(0, 25) + '...'}
        </div>
    </div>
)

export const PostProgressBar = () => {
    const local = useSelector(state=>state.app.locale)
    const testRef = useRef(null);
    const dispatch = useDispatch()
    const scrollRef = useRef(null);
    const post = useSelector(state=>state.jobPost.post)
    const maxStep = useSelector(state=>state.jobPost.maxStep)
    const activeStep = useSelector(state=>state.jobPost.activeStep)
    const appointment = useSelector(state=>state.jobPost.appointment)
    const appointmentShift = useSelector(state=>state.jobPost.appointmentShift)
    const methods = useSelector(state=>state.jobPost.methods)
    const allCategories = useSelector(state=>state.jobPost.allCategories)

    if(appointment!==null){
        appointment.category = allCategories.find(item=>item.id===appointment.category_id)
        appointment.subcategory = allCategories.find(item=>item.id===appointment.sub_category_id)
        appointment.method = methods[appointment.type -1]
    }

    useEffect(()=>{
        if(testRef.current && scrollRef.current){
            scrollRef.current.scrollTo(testRef.current.offsetLeft, 0)
        }
    },[post])

    const cancel = () => {
        confirmAlert({
            title: 'Confirm!',
            message: 'Do you want really to cancel your post?',
            buttons: [
                {
                    label: 'Yes',
                    onClick: () => {
                        dispatch(cancelAppointment())
                    }
                },
                {
                    label: 'No',
                    onClick: () => {

                    }
                }
            ]
        })
    }

    const refresh = () => {
        dispatch({type: JOB_POST_REFRESH})
    }

    return(
        <div className='w-100 d-flex flex-column progress-bar'>
            <BorderLinearProgress  variant="determinate" value={100 *( activeStep - 1 )/ maxStep}/>
            {
                appointment === null?
                <div
                    className='progress-container'
                    ref={scrollRef}
                >
                    <div className='progress-item'>
                        <img  className='flag' src={assets(`flags/${local}.png`)} alt='flag'/>
                    </div>
                    {
                        post.method &&
                        <ProgressItem
                            image={post.method.activeIcon}
                            text={post.method.title}
                            backgroundColor={'#299acf'}
                        />
                    }
                    {
                        post.address.address &&
                        <ProgressItem
                            icon={<NavigationIcon style={{fontSize: 16, color:'white', transform: 'rotate(30deg)'}}/>}
                            text={post.address.address}
                            backgroundColor={'#c44034'}
                        />
                    }
                    {
                        post.category &&
                        <ProgressItem
                            color={post.category?.color}
                            image={post.category?.image}
                            text={post.category?.name}
                            backgroundColor={'#e9a233'}
                        />
                    }
                    {
                        post.subcategory &&
                        <ProgressItem
                            image={null}
                            text={post.subcategory?.name}
                            backgroundColor={'#c9c9c9'}
                        />
                    }

                    {
                        post.dateTime.date &&
                        <ProgressItem
                            image={null}
                            text={post.dateTime.date}
                            backgroundColor={'#c9c9c9'}
                        />
                    }
                    {
                        post.age &&
                        <ProgressItem
                            image={null}
                            text={post.age}
                            backgroundColor={'#c9c9c9'}
                        />
                    }
                    {
                        activeStep > 1 &&
                        <div
                            onClick={refresh}
                            className='close-appointment'
                        >
                            <CloseIcon />
                        </div>
                    }
                    <div ref={testRef} style={{float:'left'}}> </div>
                </div>:
                <div
                    className='progress-container'
                >
                    <div className='progress-item'>
                        <img  className='flag' src={assets('flags/fr.png')} alt='flag'/>
                    </div>
                    <ProgressItem
                        image={appointment.method.activeIcon}
                        text={appointment.method.title}
                        backgroundColor={'#299acf'}
                    />
                    <ProgressItem
                        icon={<NavigationIcon style={{fontSize: 16, color:'white', transform: 'rotate(30deg)'}}/>}
                        text={appointment.address}
                        backgroundColor={'#c44034'}
                    />
                    <ProgressItem
                        color={appointment.category?.color}
                        image={appointment.category?.image}
                        text={appointment.category?.name}
                        backgroundColor={'#e9a233'}
                    />
                    <ProgressItem
                        image={null}
                        text={appointment.subcategory?.name}
                        backgroundColor={'#c9c9c9'}
                    />
                    <ProgressItem
                        image={null}
                        text={appointmentShift?.date}
                        backgroundColor={'#c9c9c9'}
                    />
                    <ProgressItem
                        image={null}
                        text={appointment?.age}
                        backgroundColor={'#c9c9c9'}
                    />

                    {
                        activeStep > 1 &&
                        <div
                            className='close-appointment'
                            onClick={cancel}
                        >
                            <CloseIcon />
                        </div>
                    }
                </div>
            }
        </div>
    )
}
