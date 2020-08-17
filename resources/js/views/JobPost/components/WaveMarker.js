import React from "react";
import {assets} from "../../../helpers";

export const WaveMarker = () =>{
    const [wav1, setWav1] = React.useState(true);
    const [wav2, setWav2] = React.useState(false);
    const [wav3, setWav3] = React.useState(false);
    const [wav4, setWav4] = React.useState(false);

    React.useEffect(()=>{
        const timer1 = setTimeout(()=>{
            setWav2(true)
        }, 1500)
        const timer2 = setTimeout(()=>{
            setWav3(true)
        }, 3000)

        const timer3 =  setTimeout(()=>{
            setWav4(true)
        }, 4500)
        return () =>{
            clearTimeout(timer1)
            clearTimeout(timer2)
            clearTimeout(timer3)
            setWav1(true);
            setWav2(false);
            setWav3(false);
            setWav4(false);
        }
    },[])

    React.useEffect(()=>{
        const timer = setTimeout(()=>{
            setWav1(!wav1);
            setWav1(true);
        },6000)
        return ()=>{
            clearTimeout(timer)
        }
    },[wav1])

    React.useEffect(()=>{
        const timer = setTimeout(()=>{
            setWav2(!wav2);
            setWav2(true);
        },6000)
        return ()=>{
            clearTimeout(timer)
        }
    },[wav2])

    React.useEffect(()=>{
        const timer = setTimeout(()=>{
            setWav3(!wav3);
            setWav3(true);
        },6000)
        return ()=>{
            clearTimeout(timer)
        }
    },[wav3])

    React.useEffect(()=>{
        const timer = setTimeout(()=>{
            setWav4(!wav4);
            setWav4(true);
        },6000)
        return ()=>{
            clearTimeout(timer)
        }
    },[wav4])

    return(
        <div
            className='d-flex justify-content-center align-items-center'
            style={{position:'relative', width: 0, height: 0}}
        >

            {
                wav1 && <span className='wav'/>
            }
            {
                wav2 && <span className='wav'/>
            }
            {
                wav3 && <span className='wav'/>
            }
            {
                wav4 && <span className='wav'/>
            }
            <div
                className='position-absolute'
                style={{
                    width: 50,
                    height:46,
                }}
            >
            <img
                style={{
                    position:'absolute',
                    bottom: 0,
                    width:'100%',
                    height:'100%',
                    objectFit:'contain'
                }}
                src={assets('/current.png')}
                alt={'marker'}
            />
        </div>
        </div>
    )
}
