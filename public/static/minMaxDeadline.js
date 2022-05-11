let today = new Date();
let dd = today.getDate();
let mm = today.getMonth() + 1; // Месяца идут с 0, так что добавляем 1.
let yyyy = today.getFullYear();
let minutes = today.getMinutes();
let hour = today.getHours();
if(dd < 10){
    dd='0' + dd
}
if(mm < 10){
    mm='0' + mm
}
if(hour < 10){
    hour='0' + hour
}
if(minutes < 10){
    minutes='0' + minutes
}

today = yyyy + '-' + mm + '-' + dd + 'T' + hour + ':' + minutes;
let future = +yyyy + 1 + '-' + mm + '-' + dd + 'T' + hour + ':' + minutes;

let datetimes = document.querySelectorAll(".datetime");
datetimes.forEach(datetime => datetime.setAttribute("min", today))
datetimes.forEach(datetime => datetime.setAttribute("max", future))