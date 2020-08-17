export const assets = (path) =>{
    return '/assets/images/'+path;
}

export const FormatNumberLength = (num, length) => {
    let r = "" + num;
    while (r.length < length) {
        r = "0" + r;
    }
    return r;
}
