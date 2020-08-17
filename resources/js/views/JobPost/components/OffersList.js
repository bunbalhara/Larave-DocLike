import React from "react";
import { useSelector} from "react-redux";
import {DoctorItem} from "./DoctorItem";
export const OffersList = (props) =>{
    const {map} = props;
    const offers = useSelector(state=>state.jobPost.offers)
    const doctors = offers?.doctors;

    return (
        <div className={'d-flex flex-column align-items-center content-container'}>
            <div className='d-flex w-100'>
                <div className='container flex flex-column align-items-center justify-content-around content-item'>
                    <div className='d-flex justify-content-center align-items-center flex-column p-lg-5'>
                        {
                            doctors && doctors.map((doctor, index)=>(
                                <div
                                    className='p-lg-4 p-2'
                                    style={{
                                        width:'100%',
                                        borderRadius: 10,
                                        boxShadow:'0 0 4px 2px #8080807f',
                                        overflow:'hidden'
                                    }}
                                    key={index}
                                >
                                    <DoctorItem
                                        doctor={doctor}
                                        avatarRounded
                                        map={map}
                                    />
                                </div>
                            ))
                        }
                    </div>
                </div>
            </div>
        </div>
    )
}
