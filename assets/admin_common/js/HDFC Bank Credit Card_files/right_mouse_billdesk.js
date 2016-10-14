

   document.onmousedown = disablerightclick;
if (document.layers) {
	window.captureEvents(Event.MOUSEDOWN);
}
window.onmousedown = disablerightclick;

document.onkeydown = disablekeyboardnavigation;
if (document.layers) {
	document.captureEvents(Event.KEYDOWN);
}
document.keydown = disablekeyboardnavigation;

function disablerightclick(e)
{
	if (navigator.appName == 'Netscape' && (e.which == 3 || e.which == 2))
	{
		return false;
	}
	else if (navigator.appName == 'Microsoft Internet Explorer'
		&& (event.button == 2 || event.button == 3 || event.button == 4))
	{
		if ((event.button != 2) || (event.button == 2 && event.srcElement.tagName != "INPUT")) {
			////alert("Mouse Right Click Disabled");	//put an appropriate message in the //alert, message for IE only
			return false;
		}
	}
	return true;
}

function disablekeyboardnavigation(e) //supported only for IE
	{

		if (navigator.appName == 'Microsoft Internet Explorer') 
		{		
			if (event.keyCode == 8)
			{
				if ((event.keyCode == 8) && (event.srcElement.tagName != "INPUT"))
				{
					if (event.srcElement.tagName != "TEXTAREA")
					return false;
				}
			}
	/*		if ((event.keyCode == 13) && (event.srcElement.tagName == "INPUT"))
			{
				return false;
			}
   */
		}
		else if (navigator.appName == 'Netscape')
		{
			if (e.which == 93 || e.which == 0 || e.which == 3 || ((e.which ==	37 || e.which == 39) && e.altKey) || (e.which == 82 && e.ctrlKey )) {
				//alert("Keyboard Navigation Disabled"); //can be removed return false; //code for netscape to be added here
				return false;
			}
		}

	    if  (navigator.appName == "Microsoft Internet Explorer")
		{
			/**
			if ((event.keyCode == 96) || (event.keyCode == 97) || (event.keyCode == 98)) {
				 //alert ("not allowed");
				 return false;
			}
			**/
			if (event.keyCode == 93  || event.keyCode == 116
				|| event.keyCode == 122 || (event.keyCode == 121 && event.shiftKey)
					|| ((event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 39)
						&& event.altKey) || ((event.keyCode == 82 || event.keyCode == 78) && event.ctrlKey)
								|| (event.keyCode == 122 && event.shiftKey) || (event.keyCode == 72 && event.ctrlKey))
			{
				if (event.keyCode == 116 || event.keyCode == 121 || event.keyCode == 122)
				{
					event.keyCode = 0;
				}

				if((event.keyCode != 93) || (event.keyCode == 93 && event.srcElement.tagName != "INPUT"))
				{
					//alert('This operation is not allowed.');
					return false;
				}
			}
			if (event.keyCode == 18 && event.keyCode == 8
				&& event.srcElement.tagName != "INPUT" && event.srcElement.tagName != "TEXTAREA") {
				//alert('This operation is not allowed.');
				return false;
			}
		}

		return true;
	}
   	function moveover(txt) {
	   window.status = txt;
	   setTimeout("erase()",1);
	}
	function erase() {
	   window.status="";
}

   
   var message="Function Disabled!";

          function clickIE4(){
          if (event.button==2){
          alert(message);
          return false;
          }
          }

          function clickNS4(e){
          if (document.layers||document.getElementById&&!document.all){
          if (e.which==2||e.which==3){
          ////alert(message);
          return false;
          }
          }
          }

          if (document.layers){
          document.captureEvents(Event.MOUSEDOWN);
          document.onmousedown=clickNS4;
          }
          else if (document.all&&!document.getElementById){
          document.onmousedown=clickIE4;
          }

          document.oncontextmenu=new Function("return false")
          //End disable right click script.
// Done By Sachin Tomar   		 



function OpenCitiTerms()
{
window.open("https://www.billdesk.com/pgmerc/pgimages/citi-terms.htm")
}