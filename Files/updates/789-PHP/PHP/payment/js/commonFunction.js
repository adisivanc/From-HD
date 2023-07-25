// JavaScript Document


/*$(function() {
	
	$(".checkinDate").datepicker({
		changeMonth: true,
		minDate: new Date(),
		onSelect: function(dateText, inst) {
			dateDifference();
		}
	});
	
	$(".checkoutDate").datepicker({
		changeMonth: true,
		minDate: new Date(),
		onSelect: function(dateText, inst) {
			dateDifference();
		}
	});
	
	dateDifference();
	
});*/

function getDatePicker() {
	
    $.datepicker.setDefaults({minDate: new Date()});
    $('.checkinDate').datepicker({ 
		onSelect: function(date) {
			date = $(this).datepicker('getDate');
			var maxDate = new Date(date.getTime());
			$('.checkoutDate').datepicker('option', {minDate: date});
			dateDifference();
    	}
		
	});
	$('.checkoutDate').datepicker({ 
		onSelect: function(date) {
			dateDifference();
    	}
	});
	
    dateDifference();
}

function dateDifference() {
   /* if($(".checkinDate").val()!='' && $(".checkoutDate").val()!='') {
        var diff = ($(".checkoutDate").datepicker("getDate") - $(".checkinDate").datepicker("getDate")) / 1000 / 60 / 60 / 24;
        $('#label').html(diff+" Days");
    }*/
	
	var weekday=new Array(7);
	weekday[0]="Sunday";
	weekday[1]="Monday";
	weekday[2]="Tuesday";
	weekday[3]="Wednesday";
	weekday[4]="Thursday";
	weekday[5]="Friday";
	weekday[6]="Saturday";

	if($(".checkinDate").val()!='' && $(".checkoutDate").val()!='') {
		var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
		var checkindate = $(".checkinDate").datepicker("getDate");
		var checkoutdate = $(".checkoutDate").datepicker("getDate");
		
		var firstDate = new Date(checkindate);
		var secondDate = new Date(checkoutdate);
		
		var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
        var checkinday = $('#checkinday').html(weekday[checkindate.getDay()]);
		var checkoutday = $('#checkoutday').html(weekday[checkoutdate.getDay()]);
		$('#totaldaystxt').show();
		$('#noofdays').html(diffDays+" Days");
	} else {
		$('#totaldaystxt').hide();
	}
	
}