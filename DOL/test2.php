<?php //echo 'test' ?>
<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<br>
<script src="https://unpkg.com/bowser@2.7.0/es5.js"></script>


<script>

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

var browser=get_browser(); // browser.name = 'Chrome'
                           // browser.version = '40'

console.log(browser);

if(browser.version < '30'){
	alert("Browser is not support");
}
</script>