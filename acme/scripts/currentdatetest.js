var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var d = new Date();
    var dayofWeek = weekday[d.getDay()];
    var day = d.getDate();
    var monthName = months[d.getMonth()];
    var year = d.getFullYear();

document.getElementById("currentdate").innerHTML = dayofWeek + ", " + monthName + " " + day + " " + year;