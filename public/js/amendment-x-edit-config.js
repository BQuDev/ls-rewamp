$.fn.editable.defaults.mode = 'inline';


$('#username').editable();          
$('#initials_1').editable();          
$('#initials_2').editable();          
$('#initials_3').editable();          
 $('#ams_date').editable({
		url: '/post',
        format: 'DD-MM-YYYY',    
        viewformat: 'DD.MM.YYYY',    
        template: 'DD - MM - YYYY',    
        combodate: {
                minYear: 2015,
                maxYear: 2025,
                minuteStep: 1
           }
        });  