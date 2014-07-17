
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