apz.demonew = {};
var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var monthEndDate = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
var startYear = 2020;
var endYear = 2030;
var month = 0;
var year = 0;
var selectedDays = new Array();
var selectedMonth = new Array();
var daysSelected = new Array();
var dateID = [];
var currentDate = "";
var allDayText = "On";
var startDate = "";
var endDate = "";
var newArrayYearIndex = new Array(365);
var rowno = "";
var tobeDeletedIndex = "";
var dateSplitEnd = "";
var freq = "";
var monthNew = "";
var dateSplitNew = "";
var datasetNew = "";
apz.demonew.sparams = {};
apz.app.onLoad_demonew = function(params) {
    debugger;
    apz.demonew.sparams = params;
    apz.data.loadJsonData("Events", "Calend");
    $("#Calend__demonew__calender").append(
        '\n <div id="months" class="months dropdown" onclick=$("#months").toggle("fast") ></div> <div id="years" class="years dropdown"onclick=$("#years").toggle("fast") ></div><div class="calendar-btn month-btn"onclick=$("#months").toggle("fast")  ><span id="curMonth"></span> </div><div class="calendar-btn year-btn" onclick=$("#years").toggle("fast")><span id="curYear"></span> </div>  <div class="clear"></div><div class="calendar-dates"><div class="days"><div class="day label">SUN</div><div class="day label">MON</div><div class="day label">TUE</div>  <div class="day label">WED</div> <div class="day label">THU</div><div class="day label">FRI</div> <div class="day label">SAT</div><div class="clear"></div> </div><div id="calendarDays" class="days"> </div></div></div> \n'
    );
    var date = new Date();
    currentDate = date.getDate();
    month = date.getMonth();
    year = date.getFullYear();
    document.getElementById("curMonth").innerHTML = months[month];
    document.getElementById("curYear").innerHTML = year;
    for (let i = 0; i < 366; i++) {
        newArrayYearIndex[i] = [];
    }
    var now = new Date();
    mobiscroll.calendar('#Calend__demonew__eventStart', {
        controls: ['calendar'],
        dateFormat: 'dd/mm/yyy',
        onInit: function(event, inst) {
            debugger; // More info about onInit: https://docs.mobiscroll.com/4-7-3/javascript/datetime#event-onInit
            inst.setVal(now, true);
        }
    });
    mobiscroll.calendar('#Calend__demonew__endInput', {
        controls: ['calendar'],
        dateFormat: 'dd/mm/yyyy',
        onInit: function(event, inst) {
            inst.setVal(now, true);
        }
    });
    apz.demonew.loadCalendarMonths();
    apz.demonew.loadCalendarYears();
    apz.demonew.loadCalendarDays();
}
apz.demonew.loadCalendarMonths = function() {
    debugger;
    for (var i = 0; i < months.length; i++) {
        var doc = document.createElement("div");
        doc.innerHTML = months[i];
        doc.classList.add("dropdown-item");
        doc.onclick = (function() {
            var selectedMonth = i;
            return function() {
                month = selectedMonth;
                document.getElementById("curMonth").innerHTML = months[month];
                apz.demonew.loadCalendarDays();
                return month;
            }
        })();
        document.getElementById("months").appendChild(doc);
    }
}
apz.demonew.loadCalendarYears = function() {
    debugger;
    document.getElementById("years").innerHTML = "";
    for (var i = startYear; i <= endYear; i++) {
        var doc = document.createElement("div");
        doc.innerHTML = i;
        doc.classList.add("dropdown-item");
        doc.onclick = (function() {
            var selectedYear = i;
            return function() {
                year = selectedYear;
                document.getElementById("curYear").innerHTML = year;
                apz.demonew.loadCalendarDays();
                return year;
            }
        })();
        document.getElementById("years").appendChild(doc);
    }
}
apz.demonew.loadCalendarDays = function() {
    debugger;
    document.getElementById("calendarDays").innerHTML = "";
    var tmpDate = new Date(year, month, 0);
    var num = apz.demonew.daysInMonth(month, year);
    var dayofweek = tmpDate.getDay(); // find where to start calendar day of week
    for (var i = 0; i <= dayofweek; i++) {
        var d = document.createElement("div");
        d.classList.add("day");
        d.classList.add("blank");
        document.getElementById("calendarDays").appendChild(d);
    }
    for (var i = 0; i < num; i++) {
        var tmp = i + 1;
        var d = document.createElement("div");
        d.id = "calendarday_" + tmp + "_" + months[month];
        d.className = "day";
        d.innerHTML = tmp;
        d.dataset.day = tmp;
            apz.demonew.fnLoadBillPaymentEvents();

        d.addEventListener('click', function() {
            dateID = this.id;
            let dateSplit = dateID.split("_");
            debugger;
            allDayText = "On";
            if (!selectedDays.includes(this.dataset.day)) {
                selectedDays.push(this.dataset.day);
            }
            
            apz.demonew.fnEnableAttributes();
            apz.demonew.fnclearModalData();
             if(month < 10)
            {
                monthNew = (month +1);
                if(monthNew < 10)
                {
                    monthNew = "0" + monthNew;
                }
                
            }
            else
            {
                monthNew = month + 1;
            }
            if(dateSplit[1] < 10)
            {
                dateSplitNew = "0" + dateSplit[1];
            }
            else
            {
                dateSplitNew = dateSplit[1];
            }
            if(this.dataset.day < 10)
            {
             datasetNew = "0" + this.dataset.day;
            }
            else
            {
                datasetNew = this.dataset.day;
            }
                var now = new Date();

            apz.setElmValue("Calend__demonew__eventStartTime", dateSplitNew + "/" + monthNew + "/" + year + " " + "12:00 PM")
            apz.setElmValue("Calend__demonew__endInputTime", dateSplitNew + "/" + monthNew + "/" + year + " " + "1:00 PM")
            apz.setElmValue("Calend__demonew__eventStart", datasetNew + "/" + monthNew + "/" + year);
            apz.setElmValue("Calend__demonew__endInput", datasetNew + "/" + monthNew + "/" + year);
            let index = apz.demonew.fnCalculateIndex(this.dataset.day, (month + 1), year);
            tobeDeletedIndex = index;
            if (newArrayYearIndex[index].length >= 1) {
                apz.data.scrdata.Calend__EventManager_Res.details = newArrayYearIndex[index];
    $("#Calend__demonew__gr_row_3").addClass("sno");

                apz.data.loadData("EventManager", "Calend");
                $("#Calend__demonew__eventDetails").removeClass("sno");
                $("#" + apz.demonew.sparams.li + " > span > span:nth-child(1)").addClass("sno");
                $("#" + apz.demonew.sparams.li).addClass("event-wrap ");
                $("#Calend__demonew__gr_row_1").addClass("sno");
            } else {
                $("#Calend__demonew__pu_mdl_1_window > ul > li > h1").text("Add Event");
                $("#Calend__demonew__saveButton").addClass("sno");
                $("#Calend__demonew__sc_row_16").removeClass("sno");
                                $("#Calend__demonew__ct_nav_6").addClass("sno");

                apz.toggleModal({
                    targetId: "Calend__demonew__pu_mdl_1"
                })
                if(apz.deviceGroup == "Mobile")
                {
                apz.setElmValue("Calend__demonew__el_txt_1", "Add Event");
                }
                $("#Calend__demonew__ct_nav_7").addClass("sno");
                $("#Calend__demonew__mobileView").removeClass("sno");
            }
        });
        document.getElementById("calendarDays").appendChild(d);
    }
    $("#calendarday_" + currentDate + "_" + months[month - 1]).addClass("selected");
    if (freq != "") {
        for (let i = 0; i < daysSelected.length; i++) {
            $("#calendarday_" + daysSelected[i] + "_" + selectedMonth[i]).addClass("event-hilight");
        }
    }
    var clear = document.createElement("div");
    clear.className = "clear";
    document.getElementById("calendarDays").appendChild(clear);
    let freq1 = apz.getElmValue("Calend__demonew__frequency");
    if (freq1 != "") {
        apz.demonew.fncalculateFreq(freq);
    }
}
apz.demonew.daysInMonth = function(month, year) {
    debugger;
    var d = new Date(year, month + 1, 0);
    return d.getDate();
}
apz.demonew.fnaddEvent = function() {
    debugger;
    if(allDayText == "All Day")
    {
        allDayText = "On";
    }
    if (allDayText == "On") {
        let startDate = apz.getElmValue("Calend__demonew__eventStart");
        let endDate = apz.getElmValue("Calend__demonew__endInput");
        freq = apz.getElmValue("Calend__demonew__frequency");
        apz.demonew.fncalculateFreq(freq, startDate, endDate);
        apz.dispMsg({
            "message": "The event has been added ",
            "type": "S"
        });
        apz.toggleModal({
            targetId: "Calend__demonew__pu_mdl_1"
        })
        $("#Calend__demonew__mobileView").addClass("sno");
    } else if (allDayText == "Off") {
        let startDate = apz.getElmValue("Calend__demonew__eventStartTime");
        let endDate = apz.getElmValue("Calend__demonew__endInputTime");
        let startDatesplit = startDate.split(" ");
        let endDatesplit = endDate.split(" ");
        let st = Date.parse(startDate);
        let et = Date.parse(endDate);
        if (startDatesplit[0] == endDatesplit[0]) {
            if (st > et) {
                apz.dispMsg({
                    "message": "End time should be after start time"
                });
            } else {
                freq = apz.getElmValue("Calend__demonew__frequency");
                apz.demonew.fncalculateFreq(freq, startDatesplit[0], endDatesplit[0]);
                apz.dispMsg({
                    "message": "The event has been added ",
                    "type": "S"
                });
                if (apz.deviceGroup == "Web") {
                    apz.toggleModal({
                        targetId: "Calend__demonew__pu_mdl_1"
                    })
                } else if (apz.deviceGroup == "Mobile") {
                    $("#Calend__demonew__mobileView").addClass("sno");
                }
            }
        } else {
            freq = apz.getElmValue("Calend__demonew__frequency");
            apz.demonew.fncalculateFreq(freq, startDatesplit[0], endDatesplit[0]);
            apz.dispMsg({
                "message": "The event has been added ",
                "type": "S"
            });
            apz.toggleModal({
                targetId: "Calend__demonew__pu_mdl_1"
            })
            $("#Calend__demonew__mobileView").addClass("sno");
        }
    }
}
apz.demonew.fnIndexMonth = function(month) {
    debugger;
    switch (month) {
        case 1:
            return "Jan";
        case 2:
            return "Feb";
        case 3:
            return "Mar";
        case 4:
            return "Apr";
        case 5:
            return "May";
        case 6:
            return "Jun";
        case 7:
            return "Jul";
        case 8:
            return "Aug";
        case 9:
            return "Sep";
        case 10:
            return "Oct";
        case 11:
            return "Nov";
        case 12:
            return "Dec";
    }
}
apz.demonew.fnDateGivenIndex = function(index) {
    debugger;
    let monthIndex = 0;
    while (index > monthEndDate[monthIndex]) {
        index -= monthEndDate[monthIndex];
        monthIndex++;
    }
    return [index, apz.demonew.fnIndexMonth(monthIndex + 1)];
}
apz.demonew.fncalculateFreq = function(freq, startDate, endDate) {
    debugger;
    if (allDayText == "On") {
        allDayText = "All Day";
    } else if (allDayText == "Off") {
        let fromTime = apz.getElmValue("Calend__demonew__eventStartTime");
        fromTime = fromTime.split(" ");
        let toTime = apz.getElmValue("Calend__demonew__endInputTime");
        toTime = toTime.split(" ");
        allDayText = fromTime[1] + fromTime[2] + " - " + toTime[1] + toTime[2];
    }
    let datesplit = startDate.split("/");
    let startDayIndex = apz.demonew.fnCalculateIndex(parseInt(datesplit[0]), parseInt(datesplit[1]), parseInt(datesplit[2]));
    datesplit = endDate.split("/");
    let endDayIndex = apz.demonew.fnCalculateIndex(parseInt(datesplit[0]), parseInt(datesplit[1]), parseInt(datesplit[2]));
    if (freq == "Daily") {
        for (i = startDayIndex; i <= endDayIndex; ++i) {
            let date = apz.demonew.fnDateGivenIndex(i);
            $("#calendarday_" + date[0] + "_" + date[1]).addClass("event-hilight");
            daysSelected.push(date[0]);
            selectedMonth.push(date[1]);
            date = date[0] + "-" + date[1] + "-" + year;
            apz.demonew.fnpushEventData(date, i);
        }
    } else if (freq == "Weekly") {
        for (i = startDayIndex; i <= endDayIndex; i = i + 7) {
            let date = apz.demonew.fnDateGivenIndex(i);
            $("#calendarday_" + date[0] + "_" + date[1]).addClass("event-hilight");
            daysSelected.push(date[0]);
            selectedMonth.push(date[1]);
            date = date[0] + "-" + date[1] + "-" + year;
            apz.demonew.fnpushEventData(date, i);
        }
    } else if (freq == "Monthly") {
        for (i = startDayIndex; i <= endDayIndex; i = i + monthEndDate[month]) {
            let date = apz.demonew.fnDateGivenIndex(i);
            $("#calendarday_" + date[0] + "_" + date[1]).addClass("event-hilight");
            daysSelected.push(date[0]);
            selectedMonth.push(date[1]);
            date = date[0] + "-" + date[1] + "-" + year;
            apz.demonew.fnpushEventData(date, i);
        }
    } else if (freq == "Once") {
        let date = apz.demonew.fnDateGivenIndex(startDayIndex);
        $("#calendarday_" + date[0] + "_" + date[1]).addClass("event-hilight");
        daysSelected.push(date[0]);
        selectedMonth.push(date[1]);
        date = date[0] + "-" + date[1] + "-" + year;
        apz.demonew.fnpushEventData(date, startDayIndex);
    }
}
apz.demonew.fnChangeAllDay = function() {
    debugger;
    allDayText = apz.getElmValue("Calend__demonew__allDay");
    if (dateID.length == 0) {
        var start = apz.getElmValue("Calend__demonew__eventStart");
        var startFirst = start.split("/");
        if (startFirst[0] < 9) {
            var startDate = startFirst[0][1];
        } else {
            var startDate = startFirst[0];
        }
        dateID = "calendarday_" + startDate + "_" + apz.demonew.fnIndexMonth(month + 1);
    } else {
        let dateSplit = dateID.split("_");
    }
    if (allDayText == "Off") {
        $("#Calend__demonew__dateTime").removeClass("sno");
        $("#Calend__demonew__date").addClass("sno");
        let dateSplit = dateID.split("_");
        var now = new Date();
        if(dateSplit[1] < 10)
        {
            var dateSplitNew = "0" + dateSplit[1];
        }
        else
        {
            var dateSplitNew = dateSplit[1]
        }
        if(month < 10)
        {
            var monthNew = month + 1;
             monthNew = "0" + monthNew;
        }
        else
        {
            var monthNew = month + 1;
        }
        mobiscroll.calendar('#Calend__demonew__eventStartTime', {
            controls: ['calendar', 'time'],
            dateFormat: 'dd/mm/yyyy',
            onInit: function(event, inst) {
               inst.setVal(now, true);
               apz.setElmValue("Calend__demonew__eventStartTime", dateSplitNew + "/" + monthNew + "/" + year + " " + "12:00 PM")
            }
        });
        mobiscroll.calendar('#Calend__demonew__endInputTime', {
            controls: ['calendar', 'time'],
            dateFormat: 'dd/mm/yyyy',
            onInit: function(event, inst) {
                inst.setVal(now, true);
                apz.setElmValue("Calend__demonew__endInputTime", dateSplitNew + "/" + monthNew + "/" + year + " " + "1:00 PM")
            }
        });
        startDate = apz.getElmValue("Calend__demonew__eventStartTime");
        endDate = apz.getElmValue("Calend__demonew__endInputTime");
    } else if (allDayText == "On") {
        $("#Calend__demonew__dateTime").addClass("sno");
        $("#Calend__demonew__date").removeClass("sno");
        startDate = apz.getElmValue("Calend__demonew__eventStart");
        endDate = apz.getElmValue("Calend__demonew__endInput");
    }
}
apz.demonew.fnaddAnotherEvent = function() {
    debugger;
    $("#Calend__demonew__pu_mdl_1_window > ul > li > h1").text("Add Event");
    if(apz.deviceGroup == "Mobile")
    {
    apz.setElmValue("Calend__demonew__el_txt_1", "Add Event");
    }
    $("#" + apz.demonew.sparams.li + " > span > span:nth-child(1)").removeClass("sno");
    $("#" + apz.demonew.sparams.li).removeClass("event-wrap ");
    $("#Calend__demonew__ct_nav_6").addClass("sno");
    $("#Calend__demonew__ct_nav_7").addClass("sno");
    $("#Calend__demonew__sc_row_16").removeClass("sno");
    $("#Calend__demonew__eventDetails").addClass("sno");
    $("#Calend__demonew__gr_row_1").removeClass("sno");
    apz.toggleModal({
        targetId: "Calend__demonew__pu_mdl_1"
    })
    $("#Calend__demonew__mobileView").removeClass("sno");
}
apz.demonew.fnpushEventData = function(date, i) {
    debugger;
    let index = i;
    var obj = {};
    var desc = apz.getElmValue("Calend__demonew__eventDesc");
    var title = apz.getElmValue("Calend__demonew__eventText");
    var date = date;
    var startEvent = apz.getElmValue("Calend__demonew__eventStart");
    var endEvent = apz.getElmValue("Calend__demonew__endInput");
    var startEventTime = apz.getElmValue("Calend__demonew__eventStartTime");
    var endEventTime = apz.getElmValue("Calend__demonew__endInputTime");
    freq = apz.getElmValue("Calend__demonew__frequency");
    var notify = apz.getElmValue("Calend__demonew__Notify");
    var allDayStatus = apz.getElmValue("Calend__demonew__allDay");
    //   var id = this.id;
    obj["AllDay"] = allDayText;
    obj["Description"] = desc;
    obj["date"] = date;
    obj["title"] = title;
    obj["frequency"] = freq;
    obj["Notify"] = notify
    obj["startEvent"] = startEvent;
    obj["endEvent"] = endEvent;
    obj["startEventTime"] = startEventTime;
    obj["endEventTime"] = endEventTime;
    obj["allDayStatus"] = allDayStatus;
    newArrayYearIndex[index].push(obj);
    //apz.data.loadData("EventManager");
}
apz.demonew.fnDisplayEvent = function(ths) {
    debugger;
    $("#Calend__demonew__pu_mdl_1_window > ul > li > h1").text("Event Details");
        $("#Calend__demonew__gr_row_3").removeClass("sno");

    $("#" + apz.demonew.sparams.li + " > span > span:nth-child(1)").removeClass("sno");
    $("#" + apz.demonew.sparams.li).removeClass("event-wrap ");
    $("#Calend__demonew__editButton").removeClass("sno");
    $("#Calend__demonew__saveButton").addClass("sno");
    $("#Calend__demonew__ct_nav_6").removeClass("sno");
    $("#Calend__demonew__ct_nav_7").removeClass("sno");
    $("#Calend__demonew__sc_row_16").addClass("sno");
    rowno = $(ths).attr("rowno");
    $("#Calend__demonew__eventDetails").addClass("sno");
    $("#Calend__demonew__gr_row_1").removeClass("sno");
    $('#Calend__demonew__eventText').attr('readonly', true);
    $('#Calend__demonew__eventDesc').attr('readonly', true);
    document.getElementById("Calend__demonew__eventStart").disabled = true;
    document.getElementById("Calend__demonew__endInput").disabled = true;
    document.getElementById("Calend__demonew__eventStartTime").disabled = true;
    document.getElementById("Calend__demonew__endInputTime").disabled = true;
    $("#Calend__demonew__allDay").addClass("disabled");
    document.getElementById("Calend__demonew__frequency_option_Once").disabled = true;
    document.getElementById("Calend__demonew__frequency_option_Daily").disabled = true;
    document.getElementById("Calend__demonew__frequency_option_Monthly").disabled = true;
    document.getElementById("Calend__demonew__frequency_option_Weekly").disabled = true;
    document.getElementById("Calend__demonew__Notify_option_10 min before").disabled = true;
    document.getElementById("Calend__demonew__Notify_option_1 hour before").disabled = true;
    document.getElementById("Calend__demonew__Notify_option_2 hours before").disabled = true;
    apz.setElmValue("Calend__demonew__eventText", newArrayYearIndex[index][rowno].title);
    apz.setElmValue("Calend__demonew__eventDesc", newArrayYearIndex[index][rowno].Description);
    apz.setElmValue("Calend__demonew__allDay", newArrayYearIndex[index][rowno].allDayStatus);
    apz.setElmValue("Calend__demonew__frequency", newArrayYearIndex[index][rowno].frequency);
    apz.setElmValue("Calend__demonew__Notify", newArrayYearIndex[index][rowno].Notify);
    if (newArrayYearIndex[index][rowno].allDayStatus == "Off") {
        $("#Calend__demonew__dateTime").removeClass("sno");
        $("#Calend__demonew__date").addClass("sno");
        apz.setElmValue("Calend__demonew__eventStartTime", newArrayYearIndex[index][rowno].startEventTime);
        apz.setElmValue("Calend__demonew__endInputTime", newArrayYearIndex[index][rowno].endEventTime);
        startDate = apz.getElmValue("Calend__demonew__eventStartTime");
        let startDateSplit = startDate.split(" ");
        startDate = startDateSplit[0];
        endDate = apz.getElmValue("Calend__demonew__endInputTime");
        let endDateSplit = endDate.split(" ");
        endDate = endDateSplit[0];
    } else {
        $("#Calend__demonew__dateTime").addClass("sno");
        $("#Calend__demonew__date").removeClass("sno");
        apz.setElmValue("Calend__demonew__eventStart", newArrayYearIndex[index][rowno].startEvent);
        apz.setElmValue("Calend__demonew__endInput", newArrayYearIndex[index][rowno].endEvent);
        startDate = apz.getElmValue("Calend__demonew__eventStart");
        endDate = apz.getElmValue("Calend__demonew__endInput");
    }
    apz.toggleModal({
        targetId: "Calend__demonew__pu_mdl_1"
    })
    $("#Calend__demonew__mobileView").removeClass("sno");
    if(apz.deviceGroup == "Mobile")
    {
    apz.setElmValue("Calend__demonew__el_txt_1", "Edit Event");
    }
    
}
apz.demonew.fnCalculateIndex = function(date, month, year) { //month needs to be one indexed
    debugger;
    var leapYear = (year % 100 === 0) ? (year % 400 === 0) : (year % 4 === 0);
    if (leapYear == true) {
        monthEndDate[1] = 29;
    }
    var dateIndex = 0;
    for (let i = 0; i < (month - 1); i++) {
        dateIndex = dateIndex + monthEndDate[i];
    }
    
            index = dateIndex + parseInt(date);

   
   // index = dateIndex + parseInt(date) - 1;
    //}//-1 as index is 0 indexed
    monthEndDate[1] = 28; //setting back february to 28
    return index;
}
apz.demonew.fnEditEventData = function() {
    debugger;
    $("#Calend__demonew__saveButton").removeClass("sno");
    $("#Calend__demonew__editButton").addClass("sno");
    apz.demonew.fnEnableAttributes();
}
apz.demonew.fnSaveEventData = function() {
    debugger;
    //apz.demonew.fnEditEventData();
    let freq = apz.getElmValue("Calend__demonew__frequency");
    let allDay = apz.getElmValue("Calend__demonew__allDay");
    if (allDay == "On") {
        var startDate = apz.getElmValue("Calend__demonew__eventStart");
        var endDate = apz.getElmValue("Calend__demonew__endInput");
        var allDayText1 = "All Day"
    } else if (allDay == "Off") {
        var startDate = apz.getElmValue("Calend__demonew__eventStartTime");
        fromTime = startDate.split(" ");
        var endDate = apz.getElmValue("Calend__demonew__endInputTime");
        toTime = endDate.split(" ");
        allDayText1 = fromTime[1] + fromTime[2] + " - " + toTime[1] + toTime[2];
    }
    var obj1 = {};
    let datesplit = startDate.split("/");
    let startDayIndex = apz.demonew.fnCalculateIndex(parseInt(datesplit[0]), parseInt(datesplit[1]), parseInt(datesplit[2]));
    datesplit = endDate.split("/");
    let endDayIndex = apz.demonew.fnCalculateIndex(parseInt(datesplit[0]), parseInt(datesplit[1]), parseInt(datesplit[2]));
    if ((freq == "Daily") || (freq == "Monthly") || (freq == "Weekly") && (startDayIndex != tobeDeletedIndex)) {
        var x = dateID.split("_");
        $("#calendarday_" + x[1] + "_" + months[month]).removeClass("event-hilight");
    }
    if (startDayIndex == tobeDeletedIndex && (freq != "Daily") && (freq != "Monthly") && (freq != "Weekly")) {
        newArrayYearIndex[tobeDeletedIndex][rowno].title = apz.getElmValue("Calend__demonew__eventText");
        newArrayYearIndex[tobeDeletedIndex][rowno].Description = apz.getElmValue("Calend__demonew__eventDesc");
        newArrayYearIndex[tobeDeletedIndex][rowno].allDayStatus = apz.getElmValue("Calend__demonew__allDay");
        newArrayYearIndex[tobeDeletedIndex][rowno].startEvent = apz.getElmValue("Calend__demonew__eventStart");
        newArrayYearIndex[tobeDeletedIndex][rowno].endEvent = apz.getElmValue("Calend__demonew__endInput");
        newArrayYearIndex[tobeDeletedIndex][rowno].startEventTime = apz.getElmValue("Calend__demonew__eventStartTime");
        newArrayYearIndex[tobeDeletedIndex][rowno].endEventTime = apz.getElmValue("Calend__demonew__endInputTime");
        newArrayYearIndex[tobeDeletedIndex][rowno].frequency = apz.getElmValue("Calend__demonew__frequency");
        newArrayYearIndex[tobeDeletedIndex][rowno].Notify = apz.getElmValue("Calend__demonew__Notify");
        newArrayYearIndex[tobeDeletedIndex][rowno].AllDay = allDayText1;
    } else if ((freq == "Once") || (freq == "Daily") || (freq == "Monthly") || (freq == "Weekly")) {
        newArrayYearIndex[tobeDeletedIndex].splice(rowno, 1);
        apz.demonew.fncalculateFreq(freq, startDate, endDate);
    }
    apz.dispMsg({
        "message": "The event has been saved",
        "type": "S"
    })
    apz.demonew.fnclearModalData();
    apz.toggleModal({
        targetId: "Calend__demonew__pu_mdl_1"
    })
    $("#Calend__demonew__mobileView").addClass("sno");
    $("#Calend__demonew__ct_nav_6").addClass("sno");
    $("#Calend__demonew__ct_nav_7").addClass("sno");
    $("#Calend__demonew__sc_row_16").removeClass("sno");
    $("#Calend__demonew__pu_mdl_1_window > ul > li > h1").text("Add Event");
    if(apz.deviceGroup == "Mobile")
    {
    apz.setElmValue("Calend__demonew__el_txt_1", "Add Event");
    }
}
apz.demonew.fnDeleteEventData = function() {
    debugger;
    newArrayYearIndex[tobeDeletedIndex].splice(rowno, 1);
    apz.dispMsg({
        "message": "The event has been deleted",
        "type": "S"
    })
    apz.toggleModal({
        targetId: "Calend__demonew__pu_mdl_1"
    })
    $("#Calend__demonew__mobileView").addClass("sno");
    if (newArrayYearIndex[tobeDeletedIndex].length == 0) {
        var x = dateID.split("_");
        $("#calendarday_" + x[1] + "_" + months[month]).removeClass("event-hilight");
        apz.demonew.fnEnableAttributes();
        apz.demonew.fnclearModalData();
        $("#Calend__demonew__ct_nav_6").addClass("sno");
        $("#Calend__demonew__ct_nav_7").addClass("sno");
        $("#Calend__demonew__sc_row_16").removeClass("sno");
        $("#Calend__demonew__pu_mdl_1_window > ul > li > h1").text("Add Event");
        if(apz.deviceGroup == "Mobile")
        {
        apz.setElmValue("Calend__demonew__el_txt_1", "Add Event");
        }
    }
}
apz.demonew.fnclearModalData = function() {
    debugger;
    document.getElementById("Calend__demonew__frequency_option_Once").checked = false;
    document.getElementById("Calend__demonew__frequency_option_Daily").checked = false;
    document.getElementById("Calend__demonew__frequency_option_Monthly").checked = false;
    document.getElementById("Calend__demonew__frequency_option_Weekly").checked = false;
    document.getElementById("Calend__demonew__Notify_option_10 min before").checked = false;
    document.getElementById("Calend__demonew__Notify_option_1 hour before").checked = false;
    document.getElementById("Calend__demonew__Notify_option_2 hours before").checked = false;
    apz.setElmValue("Calend__demonew__eventText", "");
    apz.setElmValue("Calend__demonew__eventDesc", "");
    apz.setElmValue("Calend__demonew__allDay", "On");
    $("#Calend__demonew__dateTime").addClass("sno");
    $("#Calend__demonew__date").removeClass("sno");
}
apz.demonew.fnCloseEventDetailsScreen = function() {
    debugger;
    $("#Calend__demonew__eventDetails").addClass("sno");
    $("#Calend__demonew__gr_row_1").removeClass("sno");
    $("#" + apz.demonew.sparams.li + " > span > span:nth-child(1)").removeClass("sno");
    $("#" + apz.demonew.sparams.li).removeClass("event-wrap ");
}
apz.demonew.fnsetEndDate = function() {
    debugger;
    let now = new Date();
    let start = apz.getElmValue("Calend__demonew__eventStart");
    let startsplit = start.split("/");
    mobiscroll.calendar('#Calend__demonew__endInput', {
        controls: ['calendar'],
        dateFormat: 'dd/mm/yyy',
        min: new Date(startsplit[2], (startsplit[1] - 1), (startsplit[0] - 1), now.getHours(), now.getMinutes()),
        onInit: function(event, inst) {
            inst.setVal(now, true);
        }
    });
}
apz.demonew.fnsetEndDateTime = function() {
    debugger;
    let now = new Date();
    let startDate = apz.getElmValue("Calend__demonew__eventStartTime");
    let endDate = apz.getElmValue("Calend__demonew__endInputTime");
    let startsplit = startDate.split("/");
    let startsplitTime = startsplit[2].split(" ")
    mobiscroll.calendar('#Calend__demonew__endInputTime', {
        controls: ['calendar', 'time'],
        dateFormat: 'dd/mm/yyy',
        min: new Date(startsplitTime[0], (startsplit[1] - 1), (startsplit[0]), now.getHours(), now.getMinutes()),
        onInit: function(event, inst) {
            inst.setVal(now, true);
            
        }
    });
}
apz.demonew.fnCloseMobileView = function() {
    debugger;
    $("#Calend__demonew__mobileView").addClass("sno");
    $("#Calend__demonew__gr_row_3").removeClass("sno");
}
apz.demonew.fnShowMobileView = function() {
    debugger;
    $("#Calend__demonew__mobileView").removeClass("sno");
    apz.setElmValue("Calend__demonew__el_txt_1", "Add Event");
    apz.demonew.fnEnableAttributes();
    apz.demonew.fnclearModalData();
}
apz.demonew.fnEnableAttributes = function() {
    debugger;
    $('#Calend__demonew__eventText').attr('readonly', false);
    $('#Calend__demonew__eventDesc').attr('readonly', false);
    document.getElementById("Calend__demonew__eventStart").disabled = false;
    document.getElementById("Calend__demonew__endInput").disabled = false;
    document.getElementById("Calend__demonew__eventStartTime").disabled = false;
    document.getElementById("Calend__demonew__endInputTime").disabled = false;
    $("#Calend__demonew__allDay").removeClass("disabled");
    document.getElementById("Calend__demonew__frequency_option_Once").disabled = false;
    document.getElementById("Calend__demonew__frequency_option_Daily").disabled = false;
    document.getElementById("Calend__demonew__frequency_option_Monthly").disabled = false;
    document.getElementById("Calend__demonew__frequency_option_Weekly").disabled = false;
    document.getElementById("Calend__demonew__Notify_option_10 min before").disabled = false;
    document.getElementById("Calend__demonew__Notify_option_1 hour before").disabled = false;
    document.getElementById("Calend__demonew__Notify_option_2 hours before").disabled = false;
}


apz.demonew.fnLoadBillPaymentEvents = function()
{
    debugger;
    newArrayYearIndex[292] = [{"AllDay" : "All Day" , "Description" : "Electricity Payment", "Notify" : "10 min before", "allDayStatus":"On", "date" : "20-Oct-2020","endEvent" :"20/10/2020", "frequency":"Once","startEvent":"20/10/2020","title":"BESCOM "}];
                $("#calendarday_20_Oct").addClass("event-hilight");

newArrayYearIndex[294] = [{"AllDay" : "All Day" , "Description" : "Mobile Payment",  "Notify" : "10 min before", "allDayStatus":"On", "date" : "22-Oct-2020","endEvent" :"22/10/2020", "frequency":"Once","startEvent":"22/10/2020","title":"Vodafone"}];
                $("#calendarday_22_Oct").addClass("event-hilight");

newArrayYearIndex[297] = [{"AllDay" : "All Day" , "Description" : "DishTV Payment", "Notify" : "10 min before", "allDayStatus":"On", "date" : "25-Oct-2020","endEvent" :"25/10/2020", "frequency":"Once","startEvent":"25/10/2020","title":"Tata Sky "}];
                $("#calendarday_25_Oct").addClass("event-hilight");

newArrayYearIndex[302] = [{"AllDay" : "All Day" , "Description" : "Insurance Payment",  "Notify" : "10 min before", "allDayStatus":"On", "date" : "30-Oct-2020","endEvent" :"30/10/2020", "frequency":"Once","startEvent":"30/10/2020","title":"AXA"}];
                $("#calendarday_30_Oct").addClass("event-hilight");

}

