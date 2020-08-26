import React, {useState, useEffect} from "react";
import PlacesAutocomplete, {
    geocodeByAddress,
    getLatLng,
} from 'react-places-autocomplete';
import RoomIcon from '@material-ui/icons/Room';
import {useDispatch, useSelector} from "react-redux";
import {SET_JOB_POST_LOCATION} from "../../../actions/type";
import Geocode from "react-geocode";
Geocode.setApiKey("AIzaSyAcJ5DVBnqF-t-q2jeyX-2FE-TDf42rE5s");

export const SelectLocation = () =>{
    const locale = useSelector(state=>state.app.locale);
    const address = useSelector(state=>state.jobPost.post.address)
    const dispatch = useDispatch()
    const [state, setState] = useState(address);

    Geocode.setLanguage(locale);
    Geocode.setRegion("fr");

    const handleChange = address => {
        setState({...state, address: address});
    };


    useEffect(()=>{
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            Geocode.fromLatLng(lat, lng).then(
                response => {
                    const res = response.results[0];
                    let locality = res.address_components.find(item=>item.types.includes("locality"));
                    let administrate_level_1 = res.address_components.find(item=>item.types.includes("administrative_area_level_1"));
                    let city = locality.long_name;
                    let state = administrate_level_1?administrate_level_1.long_name:'';
                    let location = {
                        address: res.formatted_address,
                        city: city,
                        state: state,
                        location: {
                            lat: lat,
                            lng: lng
                        },
                    }
                    setState(location)
                    dispatch({type: SET_JOB_POST_LOCATION, payload: location})
                },
                error => {
                    console.error(error);
                }
            );
        });
    },[])


    const handleSelect = address => {
        geocodeByAddress(address)
            .then(results => results[0])
            .then(async (res) =>{
                let latLng = await getLatLng(res);
                let locality = res.address_components.find(item=>item.types.includes("locality"));
                let administrate_level_1 = res.address_components.find(item=>item.types.includes("administrative_area_level_1"));
                let city = locality.long_name;
                let state = administrate_level_1?administrate_level_1.long_name:'';
                let location = {
                    address: res.formatted_address,
                    city: city,
                    state: state,
                    location: latLng,
                }
                setState(location)
                dispatch({type: SET_JOB_POST_LOCATION, payload: location})
            }).catch(error => console.error('Error', error));
    };

    return (
        <div className='container flex flex-column align-items-center  content-item w-100 select-location'>
            <div className='w-100 d-flex flex-column align-items-center mt-2 mt-lg-5'>
                <PlacesAutocomplete
                    value={state.address}
                    onChange={handleChange}
                    onSelect={handleSelect}
                    highlightFirstSuggestion={true}
                    searchOptions={{types: ['address'], componentRestrictions: { country: ['fr'] },}}
                >
                    {({ getInputProps, suggestions, getSuggestionItemProps, loading }) => (
                        <div
                            className='w-100 d-flex flex-column align-items-center mt-5 auto-complete'
                            style={{
                                width: '100%',
                                maxWidth: 500,
                            }}
                        >
                            <input
                                {...getInputProps({
                                    placeholder: 'Search Location ...',
                                })}
                                style={styles.inputBox}
                            />
                            <div className="autocomplete-dropdown-container w-100">
                                {loading && <div>Loading...</div>}
                                {suggestions.map((suggestion, index) => {
                                    const className = suggestion.active
                                        ? 'suggestion-item--active'
                                        : 'suggestion-item';
                                    const style = suggestion.active
                                        ? {
                                            backgroundColor: '#299acf',
                                            color:'white',
                                            cursor: 'pointer',
                                            padding: 15,
                                            borderBottom:'solid 1px #8080803f'
                                        }
                                        : {
                                            backgroundColor: '#ffffff',
                                            cursor: 'pointer',
                                            padding: 15,
                                            borderBottom:'solid 1px #8080803f'
                                        };
                                    return (
                                        <div
                                            {...getSuggestionItemProps(suggestion, {
                                                className,
                                                style,
                                            })}
                                            key={index}
                                        >
                                            <RoomIcon style={{color:suggestion.active?'white':'#8080807f'}} />
                                            <span style={{paddingLeft: 4}}>{suggestion.description.length < 50?suggestion.description:suggestion.description.substring(0, 50)}</span>
                                        </div>
                                    );
                                })}
                            </div>
                        </div>
                    )}
                </PlacesAutocomplete>
            </div>
        </div>
    )
}

const styles = {
    inputBox:{
        width: '100%',
        minWidth: 300,
        maxWidth: 500,
        borderStyle:'solid',
        borderWidth: 0,
        borderBottomWidth: 1,
        borderColor: '#808080',
        fontStyle:'normal',
        fontSize: 16,
        backgroundColor:'transparent'
    },
    dropdownItem:{
        width: '100%',
        borderBottom:'solid 1px #a4a4a47f',
        padding: 10,
        backgroundColor:'transparent',
        cursor:'pointer'
    }
}
