
import React from "react";
import {useDispatch, useSelector} from "react-redux";
import NavigateNextIcon from '@material-ui/icons/NavigateNext';
import SearchIcon from '@material-ui/icons/Search';
import {SET_JOB_POST_SUBCATEGORY} from "../../../actions/type";
import {Hidden} from "@material-ui/core";
import {JOB_POST_NEXT} from "../../../actions";
import $ from 'jquery'
const CategoryITem = ({item, active})=>{

    const dispatch = useDispatch();
    const activeStep = useSelector(state=>state.jobPost.activeStep);

    const setCategory = () =>{
        $('html, body').animate({scrollTop: 0})
        dispatch({type: SET_JOB_POST_SUBCATEGORY, payload: item})
        dispatch({type: JOB_POST_NEXT, payload:{activeStep: activeStep + 1}})
    }

    return(
        <>
            <Hidden smDown>
                <div
                    className='d-flex justify-content-between align-items-center select-subcategory-item'
                    style={{
                        maxWidth: 500,
                        width: '100%',
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
                        <div className='ml-2'>
                            <h5
                                className='name'
                                style={{
                                    color: active?'white':'black'
                                }}
                            >
                                {item.name}
                            </h5>
                            <span
                                className='description'
                                style={{
                                    color: active?'white':'black'
                                }}
                            >
                        {item.description}
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
                    className='select-subcategory-item'
                    style={{
                        width: 'max-content',
                        borderRadius: 20,
                        boxShadow:'0 0 2px 1px #8080803f',
                        marginTop: 10,
                        marginRight: 10,
                        cursor:'pointer',
                        padding:'5px 10px',
                        backgroundColor:active?'#299acf':'white'
                    }}
                    onClick={setCategory}
                >
                    <div
                        className='d-flex align-items-center flex-row justify-content-start'
                    >
                        <span
                            className='name'
                            style={{
                                color: active?'white':'black'
                            }}
                        >
                            {item.name}
                        </span>
                    </div>
                </div>
            </Hidden>
        </>
    )
}

export const SelectSubcategory = () => {

    const category = useSelector(state=> state.jobPost.post.category)
    const subCategories = useSelector(state=>state.jobPost.allCategories.filter(item=>item.parent === category.id ))
    const subcategory = useSelector(state=> state.jobPost.post.subcategory)
    const [searchResult, setSearchResult] = React.useState(null);
    const handleChange = (e) => {
        const searchText = e.target.value;
        const newCategories = subCategories.filter(item=>item.name.toLowerCase().includes(searchText.toLowerCase()))
        setSearchResult(newCategories);
    }
    return (
        <div
            className='container flex flex-column align-items-center justify-content-start content-item select-subcategory'
        >

            <div>
                <h4   style={{fontWeight: 600}} className='mt-3 title'>Choose a Subcategory.</h4>
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
                    placeholder='Search Subcategory...'
                    style={{
                        width:'100%',
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
                    (searchResult ? searchResult :(subCategories && subCategories)).map((item, index)=>(
                        <CategoryITem key={index} item={item} active={subcategory === item}/>
                    ))
                }
            </div>
        </div>
    )
}
