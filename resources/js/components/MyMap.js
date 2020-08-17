import React, {useEffect, useState} from 'react';
import GoogleMapReact from 'google-map-react';
import {WaveMarker} from "../views/JobPost/components/WaveMarker";
import {Marker} from "./Marker";
import {useSelector} from "react-redux";
import {InfoWindow} from "./InfoWindow";
import {DoctorItem} from "../views/JobPost/components/DoctorItem";
import {assets} from "../helpers"

const Map = (props) => {
    const activeStep = useSelector(state=>state.jobPost.activeStep);
    const address = useSelector(state=>state.jobPost.post.address);
    const appointment = useSelector(state=>state.jobPost.appointment)
    const [center, setCenter] = useState({
        lat: 46.2276,
        lng: 2.2237
    })
    const [currentPosition, setCurrentPosition] = useState({
        lat: appointment?parseFloat(appointment.latitute):46.2276,
        lng: appointment?parseFloat(appointment.longitute):2.2237
    })
    const [destination, setDestination] = React.useState(null);

    const [zoom, setZoom] = useState(6)
    const [show, setShow] = useState(false);
    const offers = useSelector(state=>state.jobPost.offers)
    const doctors = offers?.doctors;
    const [map, setMap] = useState(null);
    useEffect(()=>{
        if(address.location){
            setCenter(address.location)
            if(activeStep<8){
                setCurrentPosition(address.location)
            }
        }
    },[address])


    const handleApiLoaded = (map, maps) => {
        setMap(map)
        props.setMap(map)
    };


    return (
        <GoogleMapReact
            bootstrapURLKeys={{ key:'AIzaSyAcJ5DVBnqF-t-q2jeyX-2FE-TDf42rE5s' }}
            defaultCenter={center}
            defaultZoom={zoom}
            center={center}
            style={styles.container}
            options={{
                styles: [
                    {
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#444444"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "weight": "0.40"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "saturation": "-40"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#333366"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.country",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "hue": "#ff0000"
                            },
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.province",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.locality",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.neighborhood",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.man_made",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": -100
                            },
                            {
                                "lightness": 45
                            },
                            {
                                "weight": "1.25"
                            },
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#dddcdc"
                            }
                        ]
                    }
                    ]
            }}
            onClick={()=>{setShow(!show)}}
            yesIWantToUseGoogleMapApiInternals
            onGoogleApiLoaded={({ map, maps }) => handleApiLoaded(map, maps)}
        >
            {
                activeStep === 9 ?
                <WaveMarker
                    lat={currentPosition.lat}
                    lng={currentPosition.lng}
                    text="My Marker"
                />:
                <Marker
                    lat={currentPosition.lat}
                    lng={currentPosition.lng}
                    src={assets('/current.png')}
                    show={show}
                    text="My Marker"
                />

            }
            {
                doctors && doctors.map((doctor, index)=>(
                    <Marker
                        key={index}
                        lat={doctor.latitude}
                        lng={doctor.longitude}
                        show={show}
                        setDestination = {setDestination}
                        src={assets(doctor.avatar.replace('/assets/images/',''))}
                    >
                        <InfoWindow>
                            <div style={{width: 350}}>
                                <DoctorItem
                                    key={index}
                                    doctor={doctor}
                                    map = {map}
                                    drawRoute
                                />
                            </div>
                        </InfoWindow>
                    </Marker>
                ))
            }
        </GoogleMapReact>
    );
}
const styles = {
    container:{
        width: '100%',
        height: '100%',
    }
}
export default Map;
