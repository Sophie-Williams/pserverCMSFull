var xhr;
var timerCountdown = {};

function startClockTimer(element)
{
	clockTimer(element);
	window.setInterval( 'clockTimer("'+element+'")', 999 );
}

function clockTimer(element)
{
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
	jQuery(element).text(Stunden.toString()+':'+Minuten.toString()+':'+Sekunden.toString());
}


function tTimer(iEndTimeStamp, iTimeStamp, sElement)
{
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

function checkLength(sString)
{
	sString = sString.toString();
	if (sString.length === 1) {
		sString = '0' + sString;
	}
	return sString;
}

function loadCheck()
{
	jQuery.each(timerCountdown, function(sKey, iEntTime){
		if(!tTimer( iTimeStamp, iEntTime, sKey)){
			clearInterval(timerCountdown[sKey]);
		}
	});
}

function paginatorAjax( element, urlData )
{
	ajaxReload();
	xhr = jQuery.ajax({
		url : urlData,
		type: "POST",
		dataType: "html",
		success : function(data){
			jQuery(element).html(data);
		},
		error: function(e) {
			alert('smth wrong');
		}
	});
}


function ajaxReload()
{
	if(xhr && xhr.readystate !== 4){
		xhr.abort();
	}
}

function itemInfo()
{
	jQuery(document).tooltip({
		items: "[data-itemInfo], [title]",
		position: {my: "left+5 center", at: "right center"},
		content: function () {
			var element = jQuery(this);

			if (element.prop("tagName").toUpperCase() == 'IFRAME') {
				return;
			}

			if (element.is("[data-itemInfo]")) {
				if (element.parent().find('.info').html() == '') {
					return;
				}
				return element.parent().find('.info').html();
			}

			if (element.is("[title]")) {
				return element.attr("title");
			}
		}
	});
}

jQuery(document).ready(function(){
	jQuery('.timerCountdown').each(function() {
		sString = jQuery(this).attr('id');
		timerCountdown[sString] = jQuery(this).data('time');
		loadCheck();
	});
	window.setInterval('loadCheck();',999);
	itemInfo();

    jQuery('.captcha-reload').click(function() {
        icon = jQuery(this);
        parent = icon.addClass('fa-spin').parent('div');
        ajaxReload();
        xhr = jQuery.ajax({
            url : jQuery(this).data('url'),
            type: "POST",
            dataType: "json",
            success : function(data){
                parent.find('img').attr('src', data['url'] + data['id']);
                parent.find('input[name=\'captcha[id]\']').val(data['id']);
                parent.find('input[name=\'captcha[input]\']').val('');
                icon.removeClass('fa-spin');
            },
            error: function(e) {
                alert('smth wrong');
                icon.removeClass('fa-spin');
            }
        });
    });

    jQuery('.coins-widget-reload').click(function() {
        icon = jQuery(this);
        parent = icon.addClass('fa-spin').parent('div');
        ajaxReload();
        xhr = jQuery.ajax({
            url : jQuery(this).data('url'),
            type: "POST",
            dataType: "html",
            success : function(data){
                jQuery('#coinsWidgetSidebar').html(data);
                icon.removeClass('fa-spin');
            },
            error: function(e) {
                alert('smth wrong');
                icon.removeClass('fa-spin');
            }
        });
    });
});