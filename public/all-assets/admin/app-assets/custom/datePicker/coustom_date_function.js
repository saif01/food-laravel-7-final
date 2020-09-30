jQuery(document).ready(function(){

    jQuery("#datepicker, #datepicker2").datepicker({

        //"showAnim" : "bounce"

        //calendar show animation 
        "showAnim" : "clip",

        //can change month
        "changeMonth": true,

        //can change years
        "changeYear": true,

        //Can not select past date
        //"minDate" : -0,

        //data Format set
        "dateFormat" : "yy-mm-dd"

        //max selected date
        //"maxDate" : "+1M +10D",

    });

});