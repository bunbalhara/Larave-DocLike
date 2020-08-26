import React from "react";
import {useSelector} from "react-redux";

export const ReviewAndConfirm = (props) =>{

    const post = useSelector(state=>state.jobPost.post);

    return (
        <div className='w-100 container flex flex-column align-items-center justify-content-around content-item'>
            <div className='w-100 d-flex justify-content-center align-items-center flex-column'>
                <div className='review-and-confirm'>
                    <h2>Review and Confirm</h2>
                    <div className='post-item'>
                        <span className='item-name'>Where</span>
                        <div className='item-value'><span>{post.method?.title}</span></div>
                    </div>
                    <div className='post-item'>
                        <span className='item-name'>Address</span>
                        <div className='item-value'><span>{post.address?.address}</span></div>
                    </div>
                    <div className='post-item'>
                        <div className='item-name'>Category</div>
                        <div className='item-value'><span>{post.category?.name}</span></div>
                    </div>
                    <div className='post-item'>
                        <div className='item-name'>Subcategory</div>
                        <div className='item-value'><span>{post.subcategory?.name}</span></div>
                    </div>
                    <div className='post-item'>
                        <div className='item-name'>When</div>
                        <div className='item-value'><span>{post.dateTime?.date}({post.dateTime.time})</span></div>
                    </div>
                    <div className='post-item'>
                        <div className='item-name'>Age</div>
                        <div className='item-value'><span>{post.age}</span></div>
                    </div>
                    <div className='post-item'>
                        <div className='item-name'>Contact</div>
                        <div className='item-value'>
                            <span>{post.contact?.fullName}</span><br/>
                            <span>{post.contact?.offerBy}</span><br/>
                            <span>{post.contact?.email}</span><br/>
                            <span>{post.contact?.phone}</span>
                        </div>
                    </div>
                    <div className='mt-3'>
                        <p>By submitting this request, you authorize the use of your data as necessary for offering this service to you and you acknowledge that you have read and accept our <br/> <a className='privacy-policy' href='/'>privacy policy</a></p>
                    </div>
                </div>
            </div>
        </div>
    )
}
