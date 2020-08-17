
const INIT_STATE = {
    locale: window.Laravel.locale
};

export default (state = INIT_STATE, action) => {
    switch (action.type) {
        default:
            return {...state}
    }
}
