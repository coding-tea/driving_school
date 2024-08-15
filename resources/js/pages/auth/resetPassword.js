let date = $('[data-date]').attr('data-date');
let countDownDate = new Date(date).getTime();
setInterval(function () {
    let now = new Date().getTime();
    let distance = countDownDate - now;
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    if (distance < 0) {
        location.reload();
    } else {
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";
    }
}, 1000);
