
import React from "react";
import {useDispatch, useSelector} from "react-redux";
import NavigateNextIcon from '@material-ui/icons/NavigateNext';
import SearchIcon from '@material-ui/icons/Search';
import {SET_JOB_POST_CATEGORY} from "../../../actions/type";
import {Hidden} from "@material-ui/core";
import {JOB_POST_NEXT} from "../../../actions";

const CategoryITem = ({item, active})=>{

    const dispatch = useDispatch();
    const activeStep = useSelector(state=>state.jobPost.activeStep);

    const setCategory = () =>{
        dispatch({type: SET_JOB_POST_CATEGORY, payload: item})
        dispatch({type: JOB_POST_NEXT, payload:{activeStep: activeStep + 1}})
    }

    return(
        <>
            <Hidden smDown>
                <div
                    className='d-flex justify-content-between align-items-center category-item'
                    style={{
                        width: '100%',
                        maxWidth: 500,
                        borderRadius: 20,
                        boxShadow:'0 0 2px 1px #8080803f',
                        marginTop: 20,
                        cursor:'pointer',
                        backgroundColor:active?'#299acf':'white'
                    }}
                    onClick={setCategory}
                >
                    <div
                        className='d-flex align-items-center flex-row justify-content-start p-lg-4 p-2'
                    >
                        <div
                            className='d-flex justify-content-center align-items-center'
                            style={{
                                width: 50,
                                height: 50,
                                borderRadius: 10,
                                backgroundColor:item.color,
                            }}
                        >
                            <img src={item.image} alt={item.name}/>
                        </div>
                        <div className='ml-2'>
                            <h5
                                style={{
                                    color: active?'white':'black'
                                }}
                                className='title'
                            >
                                {item.name}
                            </h5>
                            <span
                                style={{
                                    color: active?'white':'black'
                                }}
                            >
                        {item.doctor.length} doctors
                    </span>
                        </div>
                    </div>
                    <div className='d-flex justify-content-center align-items-center pr-lg-4 pr-2'>
                        <NavigateNextIcon
                            style={{
                                color: active?'white':'black'
                            }}
                        />
                    </div>
                </div>
            </Hidden>
            <Hidden mdUp>
                <div
                    className='category-item'
                    style={{
                        width: 'max-content',
                        borderRadius: 9999999,
                        boxShadow:'0 0 2px 1px #8080803f',
                        cursor:'pointer',
                        padding:'2px 10px',
                        marginTop: 15,
                        backgroundColor:active?'#299acf':'white',
                        marginRight: 10,
                    }}
                    onClick={setCategory}
                >
                    <div
                        className='d-flex align-items-center flex-row justify-content-start'
                    >
                        <div
                            className='d-flex justify-content-center align-items-center'
                            style={{
                                width: 20,
                                height: 20,
                                borderRadius: 5,
                                backgroundColor:item.color,
                            }}
                        >
                            <img src={item.image} alt={item.name}/>
                        </div>
                        <div className='ml-1'>
                            <h5
                                style={{
                                    color: active?'white':'black'
                                }}
                                className='title'
                            >
                                {item.name}
                            </h5>
                        </div>
                    </div>
                </div>
            </Hidden>
        </>
    )
}

export const SelectCategory = () => {

    const categories = useSelector(state=>state.jobPost.allCategories.filter(item=>item.parent === 0 && item.doctor.length > 0))
    const category = useSelector(state=> state.jobPost.post.category)
    const [searchResult, setSearchResult] = React.useState(null);
    const handleChange = (e) => {
        const searchText = e.target.value;
        const newCategories = categories.filter(item=>item.name.toLowerCase().includes(searchText.toLowerCase()))
        setSearchResult(newCategories);
    }
    return (
        <div
            className='container flex flex-column align-items-center justify-content-start content-item select-category'
        >
            <div>
                <h4  style={{fontWeight: 600}} className='title'>Choose a Category.</h4>
            </div>
            <div
                className='mt-2 mb-2 d-flex align-items-center flex-row form-control'
                style={{
                    width:'100%',
                    maxWidth: 500
                }}
            >
                <SearchIcon />
                <input
                    placeholder='Search Category...'
                    style={{
                        width: '100%',
                        maxWidth: 450,
                        border: 'none',
                        outline:'none',
                    }}
                    onChange={handleChange}
                />
            </div>
            <div
                className='row'
                style={{
                    width:'100%',
                    maxWidth: 500,
                    maxHeight:'100%',
                    overflow:'auto',
                    padding: 10,
                    paddingBottom: 50,
                }}
            >
                {
                    (searchResult ? searchResult :(categories && categories)).map((item, index)=>(
                        <CategoryITem key={index} item={item} active={category===item}/>
                    ))
                }
            </div>
        </div>
    )
}
