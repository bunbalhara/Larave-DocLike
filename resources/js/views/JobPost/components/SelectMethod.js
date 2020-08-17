import React from "react";
import {useDispatch, useSelector} from "react-redux";
import {selectPostMethod} from "../../../actions";
import LocalizedStrings from 'react-localization';

let strings = new LocalizedStrings({
    en:{
        title:'Where do you want to see the doctor? Choose one or more.',
    },
    fr: {
        title:'Where do you want to see the doctor? Choose one or more',
    }
});

const MethodItem = ({item, active})=>{

    const dispatch = useDispatch();

    const selectItem = () => {
        dispatch(selectPostMethod(item))
    }

    return(
        <div
            onClick={selectItem}
            className='d-flex flex-row justify-content-between align-items-center p-4 mt-1 method-item'
            style={{
                backgroundColor:active?'#299acf':'white',
                width: '100%',
                maxWidth: 500,
                borderRadius: 20,
                borderStyle:'solid',
                borderWidth: 0.5,
                borderColor: active?'#299acf':'#8989897f',
                cursor:'pointer',
            }}>
            <div>
                <h4 className='title' style={{color: active?'white':'grey', fontSize: 24, marginBottom:0}}>{item.title}</h4>
                <span className='description' style={{color: active?'white':'grey', fontSize:16}}>{item.description}</span>
            </div>
            <div>
                <img src={active?item.activeIcon: item.inActiveIcon} style={{width: 40, height:'auto'}}/>
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
                <h4  className='title' style={{fontWeight: 600}}>{strings.title}</h4>
            </div>
            {
                methods.map((item, index)=>(
                    <MethodItem key={index} item={item} active={item === postMethod}/>
                ))
            }
        </div>
    )
}
