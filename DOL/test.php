<?php //echo 'test' ?>
<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<script src="https://unpkg.com/bowser@2.7.0/es5.js"></script>
<br>

<input type="button" name="printBtn" id="printBtn" value="พิมพ์ใบคำขอ " onclick="printFrame()"/>

<br>

<script>

var result = bowser.getParser(window.navigator.userAgent);
console.log(result);
document.write("You are using " + result.parsedResult.browser.name +
               "<br> v" + result.parsedResult.browser.version + 
               "<br> on " + result.parsedResult.os.name);


function get_browser() {
    var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
    if(/trident/i.test(M[1])){
        tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
        return {name:'IE',version:(tem[1]||'')};
        }   
    if(M[1]==='Chrome'){
        tem=ua.match(/\bOPR|Edge\/(\d+)/)
        if(tem!=null)   {return {name:'Opera', version:tem[1]};}
        }   
    M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
    return {
      name: M[0],
      version: M[1]
    };
 }



	 function printFrame(id) {
			 var browser=get_browser();
			// console.log(browser.name);
			// console.log(browser.version);
			
		    // var is_chrome = ((navigator.userAgent.toLowerCase().indexOf('chrome') > -1) &&(navigator.vendor.toLowerCase().indexOf("google") > -1) || is_firefox != 'firefox');
			// if(is_chrome==false){
				// alert("ระบบรองรับการพิมพ์บน Google Chrome Browser และ Microsoft Edge Browser เท่านั้น");
				// return false;
			// }
			// console.log(is_chrome);
			// console.log(is_firefox == 'firefox' && f_ver >= '30');
			// console.log(browser.name == ('Firefox'&&'Chrome'));
			
			if(browser.version < '30'){
				alert("ระบบรองรับการพิมพ์บน Google Chrome Browser และ Microsoft Edge Browser หรือ Firefox Version 30 ขึ้นไปเท่านั้น");
				return false;
			}
			if (navigator.userAgent.toLowerCase().indexOf("opera") > -1) {
				alert("ระบบรองรับการพิมพ์บน Google Chrome Browser และ Microsoft Edge Browser หรือ Firefox Version 30 ขึ้นไปเท่านั้น");
				return false;
			}
			if(confirm("กรุณายืนยันการพิมพ์")){
				var frm = document.getElementById(id).contentWindow;
				frm.focus();// focus on contentWindow is needed on some ie versions
				frm.print();
			}
            return true;
	}


</script>