import React, {useState} from "react";
import {useDispatch, useSelector} from "react-redux";
import {makeStyles} from "@material-ui/core/styles";
import PhoneInput from 'react-phone-input-2'
import 'react-phone-input-2/lib/style.css'
import RoomIcon from "@material-ui/icons/Room";
import PlacesAutocomplete, {
    geocodeByAddress,
    getLatLng,
} from 'react-places-autocomplete';
import {SET_JOB_POST_CONTACT_DETAIL, SET_JOB_POST_LOCATION} from "../../../actions/type";

export const ContactDetail = () =>{

    const dispatch = useDispatch();
    const method = useSelector(state=>state.jobPost.post.method);
    const user = useSelector(state=>state.auth.user);
    const [address, setAddress] = useState('');
    const [state, setState] = React.useState({
        gender:'Mr.',
        fullName: user.name??'',
        offerBy:'Email',
        email:user.email??'',
        phone:user.phone_number??'',
    });

    const classes = useStyles();

    const handleChange = (e) => {
        setState({...state, [e.target.name]:e.target.value})
        submit({...state, [e.target.name]:e.target.value})
    }

    const handleAddressChange = address => {
        setAddress(address)
    };

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
                setAddress(res.formatted_address)
                dispatch({type: SET_JOB_POST_LOCATION, payload: location})
            }).catch(error => console.error('Error', error));
    };

    const submit = (contact) => {
        if(contact.fullName !== '' && contact.email !== '' &&contact.phone !== ''){
            dispatch({type:SET_JOB_POST_CONTACT_DETAIL, payload: contact})
        }
    }

    return (
        <div className='container flex flex-column align-items-center content-item'>
            <div
                className='d-flex flex-column align-items-center'
                style={{
                    width:'100%',
                    maxWidth: 500
                }}
            >
                <span className={classes.label}>First and Last name</span>
                <div className='d-flex w-100'>
                    <select  name='gender' onChange={handleChange} className={classes.inputBox} style={{width: 80,}}>
                        <option>Mr.</option>
                        <option>Ms.</option>
                    </select>
                    <input
                        className={classes.inputBox} style={{width: 'calc(100% - 120px)', marginLeft: 40}}
                        placeholder='First and Last name'
                        name='fullName'
                        value={state.fullName}
                        onChange={handleChange}
                    />
                </div>
                <span className={classes.label}>Send me appointment offers by</span>
                <div className='d-flex w-100'>
                    <select
                        name='offerBy'
                        onChange={handleChange}
                        className={classes.inputBox} style={{width: '100%'}}
                    >
                        <option>Email</option>
                        <option>What's App</option>
                    </select>
                </div>
                <span className={classes.label}>Email</span>
                <div className='d-flex w-100'>
                    <input
                        name='email'
                        onChange={handleChange}
                        className={classes.inputBox} style={{width: '100%' }}
                        value={state.email}
                       placeholder='Enter your Email'
                    />
                </div>
                <span className={classes.label}>Mobile number</span>
                <PhoneInput
                    country={'fr'}
                    value={state.phone}
                    onChange={phone => {
                        setState({...state, phone: phone})
                        submit({...state, phone: phone})
                    }}
                    containerStyle={{width:'100%!important'}}
                    inputStyle={{width:'100%!important'}}
                />

                {
                    method.title === 'Online' &&
                    <>
                        <span className={classes.label}>Find nearby doctors in</span>
                        <div className='d-flex w-100'>
                            <PlacesAutocomplete
                                value={address}
                                onChange={handleAddressChange}
                                onSelect={handleSelect}
                                highlightFirstSuggestion={true}
                                searchOptions={{types: ['address'], componentRestrictions: { country: ['fr'] },}}
                            >
                                {({ getInputProps, suggestions, getSuggestionItemProps, loading }) => (
                                    <div
                                        className='w-100 d-flex flex-column align-items-center position-relative auto-complete'
                                        style={{
                                            width: '100%',
                                            maxWidth: 500,
                                        }}
                                    >
                                        <input
                                            {...getInputProps({
                                                placeholder: 'Search Location ...',
                                            })}
                                            style={{
                                                outline:"none",
                                                height: 35,
                                                borderRadius: 4,
                                                paddingLeft: 10,
                                                width:'100%',
                                                fontStyle:'normal',
                                                border: "solid 1px #8080807f!important"
                                            }}
                                        />
                                        <div className="w-100 position-absolute top" style={{top: 35, zIndex: 999999,}}>
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
                                                        padding: '5px 15px',
                                                        borderBottom:'solid 1px #8080803f',
                                                        top: 35,
                                                        zIndex: 999999,
                                                    }
                                                    : {
                                                        backgroundColor: '#ffffff',
                                                        cursor: 'pointer',
                                                        padding: '5px 15px',
                                                        borderBottom:'solid 1px #8080803f',
                                                        top: 35,
                                                        zIndex: 999999,
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
                    </>
                }

            </div>
        </div>
    )
}

const useStyles = makeStyles({
    inputBox:{
        outline:"none",
        height: 35,
        borderRadius: 4,
        paddingLeft: 10,
        border: "solid 1px #8080807f!important"
    },
    label:{
        fontSize: 14,
        fontWeight: 700,
        textAlign:'left',
        width:'100%',
        marginBottom: 5,
        marginTop:5,
    }
})
