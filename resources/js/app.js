require('./bootstrap');
require("flatpickr");
require("perfect-scrollbar");

window.StickySidebar = require('sticky-sidebar');
var Chart = require('chart.js');

import { Romanian } from "flatpickr/dist/l10n/ro.js"

(function($) {
    $.QueryString = (function(paramsArray) {
        let params = {};

        for (let i = 0; i < paramsArray.length; ++i) {
            let param = paramsArray[i].split('=', 2);

            if (param.length !== 2)
                continue;

            params[param[0]] = decodeURIComponent(param[1].replace(/\+/g, " "));
        }

        return params;
    })(window.location.search.substr(1).split('&'))
})(jQuery);

(function($) {
    $.SetQueryStringParameter = function(parameter, value) {
        let filters = $.QueryString;

        if ('' === value) {
            delete filters[parameter];
        } else {
            filters[parameter] = value;
        }

        let queryString = Object.keys(filters).map(key => key + '=' + filters[key]).join('&');
        let historyUrl = location.pathname + '?' + queryString;

        history.replaceState(null, null, historyUrl);
    }
})(jQuery);

(function($) {
    $.TranslateAccommodationType = function(type) {
        switch (type) {
            case 'Studio':
                return 'Garsonieră';
            case 'Apartment':
                return 'Apartment';
            case 'House':
                return 'Casă';
            default:
                return type;
        }
    }
})(jQuery);

(function($) {
    $.TranslateRequestStatus = function(status) {
        switch (status) {
            case 'new':
            case 'padding':
                return 'Nouă';
            case 'in_progress':
                return 'În progres';
            case 'fulfilled':
                return 'Finalizată';
            case 'allocated':
                return 'Parțial alocată';
            default:
                return status;
        }
    }
})(jQuery);

$(document).ready(function () {
    flatpickr('.flatpickr-h4h', {
        "locale": Romanian // TODO @argon
    });

    //Sidebar on admin
    $("#sidebar-collapse").click(function(){
        $(".admin-area").toggleClass("sidebar-visible");
    });
});

// Reveal password

$('#revealCurrentPass').click(function(){
    if('password' == $('#currentPwd').attr('type')){
        $('#currentPwd').prop('type', 'text');
        $('#revealCurrentPass').removeClass('fa-eye').addClass('fa-eye-slash');
    }else{
        $('#currentPwd').prop('type', 'password');
        $('#revealCurrentPass').removeClass('fa-eye-slash').addClass('fa-eye');
    }
});

$('#revealNewPass').click(function(){
    if('password' == $('#newPwd').attr('type')){
        $('#newPwd').prop('type', 'text');
        $('#revealNewPass').removeClass('fa-eye').addClass('fa-eye-slash');
    }else{
        $('#newPwd').prop('type', 'password');
        $('#revealNewPass').removeClass('fa-eye-slash').addClass('fa-eye');
    }
});



$(document).ready(function () {

    var fc_today = moment();
    var fcalendar = $('#calendar');

    if(fcalendar !== undefined) {
        var availableDays = JSON.parse(window.calendar_config.availableDays);
        var bookedDays = JSON.parse(window.calendar_config.bookedDays);
        var max_guests = window.calendar_config.max_guests;
        var slotName = window.calendar_config.slotName;


        // console.log(availableDays,bookedDays,max_guests);

        fcalendar.fullCalendar({
            header: {
                right: 'prev,next today',
                left: 'title',
            },
            height : 550,
            showNonCurrentDates : false,
            fixedWeekCount : false,
            validRange : { "start" : fc_today.format('YYYY-MM-DD') },
            defaultView: 'month',
            dayRender: function (date, cell) {
                let current_date = date.format('DD-MM-YYYY');

                if(!availableDays.includes(current_date)){
                    cell.addClass('disabled');
                } else {
                    cell.addClass('available');

                    if(bookedDays[current_date] !== undefined) {
                        (max_guests > bookedDays[current_date])? cell.addClass('warning') : cell.addClass('danger');
                        let spots_left = max_guests - bookedDays[current_date];
                        cell.append('<span class="nr-badge" data-toggle="tooltip" data-placement="top" title="'+spots_left+' '+slotName+'">' + spots_left + '</span>');
                    } else{
                        cell.append('<span class="nr-badge" data-toggle="tooltip" data-placement="top" title="'+max_guests+' '+slotName+'">' + max_guests + '</span>');
                    }

                }
                // if (current_date === fc_today.format('DD-MM-YYYY')) {
                //     cell.css("background-color", "red");
                // }

            }
        });
    }

});
