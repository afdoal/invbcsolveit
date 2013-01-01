function dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
}

function disableSelection(target){
if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	target.style.MozUserSelect="none"
else //All other route (ie: Opera)
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}

function m2h(mins){
	var Hours = Math.floor(mins/60);
	if (Hours < 10){
		Hours = "0"+Hours;
	}
	var Minutes = mins%60;	
	if (Minutes < 10){
		Minutes = "0"+Minutes;
	}
	var Time = Hours + "." + Minutes;
	if (Time!='00.00'){
	return Time;}
	else {return "";}
}
		
function h2m(hours){
	var t = new Array();
	t = hours.split('.');
	if (t[0]=="08"){
	  t[0]="8";
	} else if (t[0]=="09"){
	  t[0]="9";	
	}
	h=parseInt(t[0]);	
	if (t[1] != null || t[1] != ''){
	 var m = t[1];
	} else {
	 var m = "00";
	}
	mnt=parseInt(m);	
	return ((h*60)+mnt);
	
}

function m2h2(mins){	
	h=mins/60;	
	return h.toFixed(2);
}
		
function h2m2(hours){	
	if ((hours == "") || (hours == null) || isNaN(hours))
	{hours="0";}
	m=parseFloat(hours);
	return (m*60);	
}

function formatCurrency(num,curr) {			
	curr = curr.toUpperCase();
	
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*1000+0.50000000001);
	cents = num%1000;
	num = Math.floor(num/1000).toString();			
	if(cents<10){
		cents = "00" + cents;
	} else if(cents<100) {
		cents = "0" + cents;
	}
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	
	if (curr=='USD'){
		return num + '.' + cents;
	} else {
		return num;
	} 
}

function formatCurrency2(num,curr) {			
	curr = curr.toUpperCase();
	
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%1000;
	num = Math.floor(num/100).toString();			
	if(cents<10){
		cents = "00" + cents;
	} else if(cents<100) {
		cents = "0" + cents;
	}
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	
	if (curr=='USD'){
		return (((sign)?'':'-') + curr + ' ' + num + '.' + cents);
	} else {
		return (((sign)?'':'-') + curr + ' ' + num);
	} 
	
}

function formatNumber (pnumber,decimals) {
	if (isNaN(pnumber)) { return 0};
	    if (pnumber=='') { return 0};
	    var snum = new String(pnumber);
	    var sec = snum.split('.');
	    var whole = parseFloat(sec[0]);
	    var result = '';
	    if(sec.length > 1){
	        var dec = new String(sec[1]);
	        dec = String(parseFloat(sec[1])/Math.pow(10,(dec.length - decimals)));
	        dec = String(whole + Math.round(parseFloat(dec))/Math.pow(10,decimals));
	        var dot = dec.indexOf('.');
	        if(dot == -1){
	            dec += '.';
	            dot = dec.indexOf('.');
	        }
	        while(dec.length <= dot + decimals) { dec += '0'; }
	        result = dec;
	    } else{
	        var dot;
	        var dec = new String(whole);
	        dec += '.';
	        dot = dec.indexOf('.');
	        while(dec.length <= dot + decimals) { dec += '0'; }
	        result = dec;
	    }
	    return result;
}

function nformat(nNumber){
	format_number = new Number(nNumber.replace(".", "").replace(",", "."));
	return format_number;
}

function nformat2(num,curr) {				
	
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	
	cents2 = num%100;
	num = Math.floor(num/100).toString();			
	if(cents2<10){
		cents2 = "0" + cents2;
	} 
	
	/*cents3 = num%1000;
	num = Math.floor(num/1000).toString();			
	if(cents3<10){
		cents3 = "00" + cents3;
	} else if(cents3<100) {
		cents3 = "0" + cents3;
	}*/
	
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	
	if (curr==3){
		return num + '.' + cents3;
	} else if (curr==2){
		return num + '.' + cents2;
	} else {
		return num;
	} 
}

function nformat3(num, dec){
	var result = num*Math.pow(10,dec)/Math.pow(10,dec);
	return nformat(result.toFixed(dec));
}



function dmys2ymd(str){
	var xOx =  new String(str);
	var xIx = xOx.split("/");
	return xIx[2] + "-" + xIx[1] + "-" + xIx[0];
}

function formatPrice(value,rowData){  
	val=value.replace(',','');
    if (val < 1){  
        return '<span style="color:red;">('+nformat2(val)+')</span>';  
    } else {  
        return val;  
    }  
}

function openurl(url){
	window.open(url,'_blank');
}

function enInput(){	
	$(':input').attr('disabled',false);
}

function dsInput(){
	$(":input").attr('disabled',true);
}