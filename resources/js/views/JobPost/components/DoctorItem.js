import React, {useEffect, useState} from "react";
import {assets} from "../../../helpers";
import {useSelector} from "react-redux";
import AccessTimeIcon from '@material-ui/icons/AccessTime';

export const DoctorItem = (props) => {
    const {doctor, avatarRounded, map, drawRoute} = props;
    const [distance, setDistance] = useState(0);
    const category = useSelector(state=>state.jobPost.allCategories.find(item=>item.id === doctor.category));
    const appointment = useSelector(state=>state.jobPost.appointment)
    const currentPosition={
        lat: appointment?parseFloat(appointment.latitute):46.2276,
        lng: appointment?parseFloat(appointment.longitute):2.2237
    }

    useEffect(()=>{
        let directionsService = null;
        let directionsRenderer = null;
        if(map && doctor){
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);
            directionsRenderer.setOptions( { suppressMarkers: true } );
            var request = {
                origin: `${currentPosition.lat},${currentPosition.lng}`,
                destination: `${doctor.latitude},${doctor.longitude}`,
                travelMode: 'DRIVING'
            };
            directionsService.route(request, function(result, status) {
                if (status === 'OK') {
                    setDistance(result.routes[0].legs[0].distance.text);
                    if(drawRoute){
                        directionsRenderer.setDirections(result);
                    }
                }
            });
        }

        return () =>{
            if(directionsRenderer){
                directionsRenderer.setMap(null);
            }
        }
    },[map, doctor])

    return(
        <div
            style={{
                display:'flex',
                flexDirection:'row',
                alignItems:'center',
                minWidth: 350,
            }}
        >
            <img
                src={assets(doctor.avatar.replace('/front/img/',''))}
                style={{
                    width: '40%',
                    height:'auto',
                    borderRadius:avatarRounded?'50%':0
                }}
                alt='avatar'
            />
            <div
                style={{
                    width:'60%',
                    paddingLeft: 10,
                }}
            >
                <div style={{width: '100%'}}><strong style={{fontSize: 18}}>{doctor.name}</strong></div>
                <span style={{fontSize: 16}}>{category?.name}</span>
                <div className='d-flex justify-content-between align-items-center mt-3 px-2'>
                    <div style={styles.buttonStyle}>
                        <img
                            src={assets('marker.png')}
                            alt='marker'
                            style={styles.marker}
                        />
                        <span style={{whiteSpace:'nowrap'}}>{distance}</span>
                    </div>
                    <div style={styles.buttonStyle}>
                        <AccessTimeIcon style={{fontSize: 16, marginRight: 5}} />
                        <span>Accept</span>
                    </div>
                </div>
            </div>
        </div>
    )
}

const styles = {
    buttonStyle:{
        width: '45%',
        height: 26,
        backgroundColor:"#c9c9c9",
        padding:'2px 5px',
        display:'flex',
        justifyContent:'center',
        alignItems:'center',
        borderRadius: 13,
    },
    marker:{
        width: 15,
        height: 15,
        marginRight: 5
    }
}
