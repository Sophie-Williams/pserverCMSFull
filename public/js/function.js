
function startClockTimer(sElement){
	clockTimer(sElement);
	window.setInterval( 'clockTimer("'+sElement+'")', 999 );
}

function clockTimer(sElement){
	if (!document.all && !document.getElementById) {
		return;
	}
	var Stunden = ServerTime.getHours();
	var Minuten = ServerTime.getMinutes();
	var Sekunden = ServerTime.getSeconds();
	ServerTime.setSeconds(Sekunden + 1);
	if (Stunden <= 9) {
		Stunden = "0" + Stunden;
	}

	if (Minuten <= 9) {
		Minuten = "0" + Minuten;
	}
	if (Sekunden <= 9) {
		Sekunden = "0" + Sekunden;
	}
	jQuery(sElement).text(Stunden.toString()+':'+Minuten.toString()+':'+Sekunden.toString());
}


function tTimer(iEndTimeStamp, iTimeStamp, sElement) {
	iTimeStamp = iTimeStamp - Math.round(+new Date() / 1000) - iEndTimeStamp;
	oElement = jQuery('#'+sElement);
	if (iTimeStamp < 0) {
		oElement.html('00:00:00');
		return false;
	}
	diffDay = iTimeStamp / (3600 * 24 );
	diffDay = diffDay.toString();
	diffDay = diffDay.split(".");
	diffHour = iTimeStamp / 3600 % 24;
	diffHour = diffHour.toString();
	diffHour = diffHour.split(".");
	diffMin = iTimeStamp / 60 % 60;
	diffMin = diffMin.toString();
	diffMin = diffMin.split(".");
	diffSek = iTimeStamp % 60;
	diffSek = diffSek.toString();
	diffSek = diffSek.split(".");
	if(diffDay[0] != 0){
		oElement.html(diffDay[0] + 'd ' + checkLength(diffHour[0]) + ':' + checkLength(diffMin[0]) + ':' + checkLength(diffSek[0]));
		return true;
	}
	oElement.text(checkLength(diffHour[0]) + ':' + checkLength(diffMin[0]) + ':' + checkLength(diffSek[0]));
	return true;
}

function checkLength(sString) {
	sString = sString.toString();
	if (sString.length == 1) {
		sString = '0' + sString;
	}
	return sString;
}


var timerCountdown = {};

function loadCheck(){
	jQuery.each(timerCountdown, function(sKey, iEntTime){
		if(!tTimer( iTimeStamp, iEntTime, sKey)){
			clearInterval(timerCountdown[sKey]);
		}
	});
}

jQuery(document).ready(function(){
	jQuery('.timerCountdown').each(function(){
		sString = jQuery(this).attr('id');
		timerCountdown[sString] = jQuery(this).data('time');
		loadCheck();
	});
	window.setInterval('loadCheck();',999);
});