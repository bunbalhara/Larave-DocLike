import React from "react";

import {SelectMethod} from "./SelectMethod";
import {SelectCategory} from "./SelectCategory";
import {SelectSubcategory} from "./SelectSubcategory";
import {SelectTime} from "./SelectTime";
import {SelectAge} from "./SelectAge";
import {ContactDetail} from "./ContactDetail";
import {SelectLocation} from "./SelectLocation";
import {ReviewAndConfirm} from "./ReviewAndConfirm";
import {useSelector} from "react-redux";

export const Content = () => {
    const activeStep = useSelector(state=> state.jobPost.activeStep)
    switch (activeStep) {
        case 1:
            return <SelectMethod />
        case 2:
            return <SelectLocation />
        case 3:
            return <SelectCategory />
        case 4:
            return <SelectSubcategory />
        case 5:
            return <SelectTime />
        case 6:
            return <SelectAge />
        case 7:
            return <ContactDetail />
        case 8:
            return <ReviewAndConfirm />
        default:
            return null;
    }
}
