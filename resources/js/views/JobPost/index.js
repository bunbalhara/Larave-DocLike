import React, {useEffect, useState} from "react";
import {PostProgressBar, Content} from './components'
import {useDispatch, useSelector} from "react-redux";
import {
    getAllCategories,
    getAppointment,
    getAuthUser,
    getOffers,
    jobPostBack,
    jobPostNext,
    postRequest
} from "../../actions";
import MyMap from "../../components/MyMap";
import {Alert} from '@material-ui/lab';
import Snackbar from '@material-ui/core/Snackbar';
import {Fade} from '@material-ui/core';
import {SET_JOB_POST_ERROR} from "../../actions/type";
import NavigateNextIcon from '@material-ui/icons/NavigateNext';
import CircularProgress from '@material-ui/core/CircularProgress';
import ArrowBackIosIcon from '@material-ui/icons/ArrowBackIos';
import {OffersList} from "./components/OffersList";

export const JobPost = () => {

    const activeStep = useSelector(state=>state.jobPost.activeStep)
    const isError = useSelector(state=>state.jobPost.isError)
    const errorText = useSelector(state=>state.jobPost.errorText)
    const maxStep = useSelector(state=>state.jobPost.maxStep)
    const isShowMap = useSelector(state=>state.jobPost.isShowMap)
    const offers = useSelector(state=>state.jobPost.offers)
    const dispatch = useDispatch();
    const [loading, setLoading] = useState(true);
    const [map, setMap] = useState(null);

    useEffect(()=>{
        dispatch(getAllCategories(null))
        dispatch(getAuthUser(null))
        dispatch(getAppointment((res)=>{
            if(res.success){
                console.log(res.data.appointment_id)
                dispatch(getOffers(res.data.appointment_id,()=>{
                    setLoading(false);
                }))
            }else {
                setLoading(false);
            }
        }))
    },[dispatch])

    const handlePrevious = () => {
        if(activeStep > 1){
            dispatch(jobPostBack())
        }
    }

    const handleContinue = () => {
        if(activeStep < maxStep){
            dispatch(jobPostNext())
        }
    }
    const handleClose = (event, reason) => {
        dispatch({type:SET_JOB_POST_ERROR, payload:{error: false, errorText:''}})
    };

    const post = () =>{
        dispatch(postRequest())
    }

    return(
        <div className='d-flex flex-column align-items-center job-post'>
            <PostProgressBar />
            {
                !loading ?
                <div className='content-map-container'>
                    {
                        activeStep < 9 &&
                        <div className={'d-flex flex-column align-items-center content-container'}>
                            <div className='d-flex w-100'>
                                <Content />
                            </div>

                            <Snackbar
                                anchorOrigin={{vertical:'top', horizontal:'center'}}
                                open={isError}
                                autoHideDuration={6000}
                                onClose={handleClose}
                                TransitionComponent={Fade}
                            >
                                <Alert  variant="filled"  onClose={handleClose}  severity="error" style={{marginTop: 50}}>
                                    {errorText}
                                </Alert>
                            </Snackbar>

                            <div
                                className='mb-3 mt-2 d-flex justify-content-between align-items-center button-group'
                                style={{
                                    width:'100%',
                                    maxWidth: 500,
                                    padding: '0 20px'
                                }}
                            >

                                {
                                    activeStep > 1 &&
                                    <button className='btn previous-button' onClick={handlePrevious} disabled={activeStep===1}>
                                        <ArrowBackIosIcon style={{color:'#299acf', marginRight: 10}} />
                                        <span style={{paddingBottom: 2}}>Previous</span>
                                    </button>
                                }
                                {
                                    (activeStep === 2 || activeStep === 6 || activeStep === 7 )&&
                                    <button className='btn continue-button' onClick={handleContinue} disabled={activeStep===maxStep+1}>
                                        <span style={{paddingBottom: 2}}>Continue</span>
                                        <NavigateNextIcon style={{color:'white', marginLeft: 10}}/>
                                    </button>
                                }
                                {
                                    activeStep === 8 &&
                                    <button className='btn send-request-button' onClick={post} disabled={activeStep===maxStep+1}>
                                        <span style={{paddingBottom: 2}}>Send Request</span>
                                    </button>
                                }
                            </div>
                        </div>
                    }
                    {
                        offers && <OffersList map={map}/>
                    }
                    {
                        isShowMap &&
                        <div className={activeStep === 9?'map-container-full':'map-container'}
                             style={{
                                 width: (activeStep === 9)?'100%':'50%',
                             }}
                        >
                            <MyMap setMap={setMap} />
                        </div>
                    }
                </div>:
                <div className='d-flex justify-content-center align-items-center w-100' style={{minHeight: 685}}>
                    <CircularProgress />
                </div>
            }
        </div>
    )
}
