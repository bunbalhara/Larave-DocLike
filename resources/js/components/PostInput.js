import React, {useState, useEffect} from 'react'


const PostInput = ({categories, handleClick}) => {

    const [value, setValue] = useState(1)

    const handleChange = (e) =>{
        setValue(e.target.value)
    }
    
    return (
        <div className="post-box d-flex">
            <select
                onChange = {handleChange}
                className="post-input" placeholder="Insert your Category">
                {categories.map((category, index) => (
                        <option key={index} value={category.id}>{category.name}</option>
                ))}
            </select>
            <div className="post-submit d-flex">
                <div className="seperate"></div>
                <button type="button" onClick={()=>{handleClick(value)}}>
                    <i className="las la-search la-24-black"></i>
                </button>
            </div>
        </div>
    )
        
}


export default PostInput