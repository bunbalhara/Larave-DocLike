import React from "react";
import {useDispatch, useSelector} from "react-redux";
import {selectPostMethod} from "../../../actions";
import LocalizedStrings from 'react-localization';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import Slider from 'react-slick';

let strings = new LocalizedStrings({
    en:{
        title:'Where do you want to see the doctor? Choose one or more.',
    },
    fr: {
        title:'Où voulez-vous voir le médecin? Choisissez un ou plusieurs.',
    }
});

const settings = {
    dots: false,
    infinte:true,
    speed: 500,
    slidesToShow: 3,
    arrows: true,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 5000,
    initialSlide: 0,
    className: "slides",
    rows: 1,
    centerPadding: "60px",
    responsive: [
        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                initialSlide: 2
            }
        },
    ]
}

const MethodItem = ({item, active})=>{

    const dispatch = useDispatch();

    const selectItem = () => {
        dispatch(selectPostMethod(item))
    }

    return(
        <div
            onClick={selectItem}
            className='d-flex flex-row justify-content-between align-items-center method-item'
            style={{
                backgroundColor:'#8080807f',
                width: 'calc(100% - 10px)',
                height:350,
                maxWidth: 250,
                borderRadius: 10,
                borderStyle:'solid',
                borderWidth: 0.5,
                borderColor: '#8989897f',
                cursor:'pointer',
                overflow:'hidden',
                margin: 'auto',
                position:'relative'
            }}>
            <img
                src={item.image}
                style={{width: '100%', height:'100%', objectFit:'stretch'}}
            />
            <div
                style={{
                    position:'absolute',
                    top: 10,
                    left:10,
                    width: 50,
                    height: 50,
                    backgroundColor:'#169bb9',
                    borderRadius: 25,
                    padding: 5,
                }}
            >
                <img src={item.activeIcon} style={{width: '100%', height:'100%', objectFit:'stretch'}} />
            </div>

            <div
                style={{
                    position:'absolute',
                    bottom: 15,
                    left: 0,
                    width: '100%',
                    height: 50,
                    fontSize: 16,
                    fontWeight:'bold',
                    color:'white',
                    display:'flex',
                    alignItems:'center',
                    justifyContent:'center',
                    backgroundColor:'#0000005f'
                }}
            >
                {item.title}
            </div>
        </div>
    )
}

export const SelectMethod = () =>{

    const locale = useSelector(state=>state.app.locale)
    const methods = useSelector(state=>state.jobPost.methods)
    const postMethod = useSelector(state=>state.jobPost.post.method)
    strings.setLanguage(locale);

    return (
        <div className='container flex flex-column align-items-center content-item select-method'>
            <div>
                <h4
                    style={{
                        fontWeight: 600,
                        paddingTop: 40,
                        textAlign: 'center'
                    }}
                >{strings.title}</h4>
            </div>
            <div
                style={{
                    width:'100%',
                    height:'100%',
                }}
            >
                <Slider {...settings}>
                    {
                        methods.map((item, index)=>(
                            <MethodItem key={index} item={item} active={item === postMethod}/>
                        ))
                    }
                </Slider>
            </div>
        </div>
    )
}
