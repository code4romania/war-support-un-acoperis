require('./bootstrap');
require("flatpickr");
$(document).ready(function () {
    flatpickr('.flatpickr', {});
    //Sidebar on admin
    $("#sidebar-collapse").click(function(){
        $(".admin-area").toggleClass("sidebar-visible");
    });
});
