export function countdown(ele, seconds, tips) {
    let timer;
    const originTxt = ele.innerHTML;
    timer = setInterval(function () {
        seconds--;
        if (seconds <= 0) {
            ele.innerHTML = originTxt;
            clearInterval(timer);
            ele.disabled = false
        } else {
            ele.innerHTML = seconds.toString() + '秒' + tips;
            ele.disabled = true
        }
    }, 1000)
}

export function isMobile(mobile) {
    let reg = /^1[0-9]{10}$/;
    return reg.test(mobile);
}