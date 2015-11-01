  $(function() {
			  
				//call progress bar constructor
			  $("#progress").progressbar({ change: function() {
				
				  //update amount label when value changes
				  $("#amount").text($("#progress").progressbar("option", "value") + "%");
				} });
				
				//set click handler for next button
				$("#next").click(function(e) {
				  
					//stop form submission
					e.preventDefault();
				  
					//look at each panel
				  $(".form-panel").each(function() {
					  
						//if it's not the first panel enable the back button
            ($(this).attr("id") != "panel1") ? null : $("#back").attr("disabled", "");
																		
						//if the panel is visible fade it out
					  ($(this).hasClass("ui-helper-hidden")) ? null : $(this).fadeOut("fast", function() {
						  
							//add hidden class and show the next panel
							$(this).addClass("ui-helper-hidden").next().fadeIn("fast", function() {
							  
								//if it's the last panel disable the next button
    						($(this).attr("id") != "thanks") ? null : $("#next").attr("disabled", "disabled");
							($(this).attr("id") != "thanks") ? null : $("#submit").attr("disabled", "");
																
								//remove hidden class from new panel
								$(this).removeClass("ui-helper-hidden");
								
								//update progress bar
								$("#progress").progressbar("option", "value", $("#progress").progressbar("option", "value") + 50);
							});
						});
					});
				});			
				
				//set click handler for back button
				$("#back").click(function(e) {
				  
					//stop form submission
					e.preventDefault();
					
					//look at each panel
				  $(".form-panel").each(function() {
					  					
					  //if it's not the last panel enable the next button
						($(this).attr("id") != "thanks") ? null : $("#next").attr("disabled", "");
						($(this).attr("id") != "thanks") ? null : $("#submit").attr("disabled", "disabled");
					  
						//if the panel is visible fade it out
					  ($(this).hasClass("ui-helper-hidden")) ? null : $(this).fadeOut("fast", function() {
						  
							//add hidden class and show the next panel
							$(this).addClass("ui-helper-hidden").prev().fadeIn("fast", function() {
							
							  //if it's the first panel disable the back button
    						($(this).attr("id") != "panel1") ? null : $("#back").attr("disabled", "disabled");
										
								//remove hidden class from new panel
								$(this).removeClass("ui-helper-hidden");
								
								//update progress bar
								$("#progress").progressbar("option", "value", $("#progress").progressbar("option", "value") - 50);
							});
						});
					});
				});					
			


// Собираем данные в кучу  и посылаем на poehali.php!
$("#submit").click(function() {
								
$.ajax({
type: "POST",
url: "index.php?c=register",
data: "name_post="+$('#name').attr('value')+"&fam="+$("#fam").attr('value')+"&pass="+$("#pass").attr('value')+"&repass="+$("#repass").attr('value')+"&email="+$("#email").attr('value')+"&telefon="+$("#telefon").attr('value')+"&adr="+$("#adr").attr('value'),
success: function(answer){$("#thanks p").html(answer);}
	  });
	});
	$("#submit").click(function() {
		return false;
	});
$("#loading img").ajaxStart(function(){$(this).show();});  
$("#loading img").ajaxStop(function(){$(this).hide();});  
			});
			
function SubmitControl(tocheck){
 if (document.all||document.getElementById){
     for (i=0;i<tocheck.length;i++){
          obj=tocheck.elements[i]
          if(obj.type.toLowerCase()=="submit"||obj.type.toLowerCase()=="reset") {
             obj.disabled=true
            }}}
}
function UnCheckButtons(){
 if(document.getElementsByTagName)
 {var els=document.getElementsByTagName('input')
  for(i=0;i<els.length;i++)
   if((els[i].type=='submit'||els[i].type=='reset')&&els[i].disabled) els[i].disabled=false
 }
}
setTimeout('UnCheckButtons()',1000)
function CreateWnd(url, width, height, wndname){
  if (wndname != ''){
      for (var i=0; i < parent.frames.length; i++){
           if (parent.frame[i].name == wndname){
               parent.frame[i].focus()
               return
              }
          }
    }
  window.open(url, wndname,'width=' + width + ',height=' + height + ',resizable=1,scrollbars=yes,menubar=yes,status=yes')
}
function Formchecker(tocheck){
  if (tocheck.post&&tocheck.post.value.length == 0){
      alert('Пожалуйста, введите текст сообщения!!');tocheck.post.focus()
      return false}
  if (tocheck.membername&&tocheck.membername.value.length == 0){
      alert('Пожалуйста, введите ваше имя!!');tocheck.membername.focus()
      return false}
  if (typeof check_tags=='function'&&!check_tags(tocheck)) return false
  if (false&&!check_message_style(tocheck.post.value)) {tocheck.post.focus();return false}
return true
}
function check_message_style(txt)
{
var mess=""
try {
 txt=txt.replace(/\r?\n/g,'').replace(/\[(#|q|url|img|code).*\].*\[\/\1\]/gi,'')
 var cnt=txt.match(/[a-zа-я]/gi).length
 tmp=txt.match(/[а-я]/gi)
 if (tmp==null||(tmp.length/cnt<0.2&&tmp.length>15)) mess+="п.2.5.1 - Слишком мало русского текста ("+percent(tmp,cnt)+"). Если у вас нет клавиатуры с русской раскладкой, то воспользуйтесь, к примеру, сервисом www.translit.ru или виртуальной клавиатурой слева от поля ввода. (You may skip this message if you do not speak russian, but remember that this forum is dedicated to the russian-speaking community)\n"
 tmp=txt.match(/[A-ZА-Я]/g)
 if(tmp!=null&&tmp.length/cnt>0.3)  mess+="п.2.5.7 - Ваше сообщение содержит большое количество ЗАГЛАВНЫХ БУКВ ("+percent(tmp,cnt)+"). Попробуйте его отредактировать и привести в нормальный вид. (Please do not overuse CAPITAL LETTERS in your message)"
 }catch(e){}
if(mess!='') return confirm("Вы уверены, что хотите отправить данное сообщение?\n(Are you sure you're ready to submit your message?)\nОно может не соответствовать главе VIII Соглашения по Использованию Форума по причине:\n"+mess)
return true
function percent(d,c)
{return (d==null?0:Math.round(d.length/c*1000)/10)+"%"}
}

if (document.selection||document.getSelection||window.getSelection) {Q=true} else {var Q=false}
var txt=''
function copyQ() {
        txt=''
        if (window.getSelection&&!window.opera) txt = window.getSelection() 
        else if (document.getSelection) txt=document.getSelection()
        else if (document.selection) txt=document.selection.createRange().text
        txt='[quote]'+txt+'[/quote]\n'
}
function setCaret(textObj) {
        if (textObj.createTextRange) {
        textObj.caretPos = document.selection.createRange().duplicate()
        }
        el_has_focus=textObj 
}
function insertAtCaret(tObj,textV){    
    textV=textV.replace(/\s\[\?\]/g,'')
    if (textV==''||!tObj) return
    var ver=8
    if(document.all && !window.opera){
      if (tObj.createTextRange&&tObj.caretPos) {
          var caretPos=tObj.caretPos
          caretPos.text=textV
        }else tObj.value+= textV
        }else
        {var brows=navigator.userAgent.toString()
         var scrollTop, scrollLeft
         if (tObj.type=='textarea'&&tObj.scrollTop)
         {scrollTop=tObj.scrollTop;scrollLeft=tObj.scrollLeft}                
          if(brows.search(/opera\/?(\d*.\d*)/i)!=-1) ver=RegExp.$1 
          if(tObj.selectionStart>=0&&ver>=8){
          if(tObj.textLength!=undefined||tObj.value.length!=undefined) 
           {var selLength=tObj.textLength!=undefined?tObj.textLength:tObj.value.length 
            var selStart=tObj.selectionStart
            var selEnd=tObj.selectionEnd 
            if (selEnd==1||selEnd==2)selEnd=selLength  
            var s1=(tObj.value).substring(0,selStart) 
            var s2=(tObj.value).substring(selEnd,selLength)
            tObj.value=s1+textV+s2
            tObj.setSelectionRange(selStart+textV.length,selStart+textV.length) 
            } 
            if (typeof scrollTop != 'undefined')
            {tObj.scrollTop=scrollTop;tObj.scrollLeft=scrollLeft}
           }else tObj.value+=textV
        }
}
function pasteQ(){
    if (txt!='' && document.getElementById('text'))
    insertAtCaret(document.getElementById("text"),txt)
}
function pasteN(text){
    if (text!='' && document.getElementById('text'))
    insertAtCaret(document.getElementById("text"),"[b]" + text + "[/b]"+(window.opera?"\r":"")+"\n")
}

function SelectAll(chbox, chtext){
 for(var i =0; i < chbox.form.elements.length; i++){
     if(chbox.form.elements[i].name.indexOf(chtext) == 0){
        chbox.form.elements[i].checked = chbox.checked
       }
    }
}
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'")
  if (restore) selObj.selectedIndex=0
}

function getcookievalue(name){
        var temp=document.cookie+";"
        var Pos=temp.indexOf("=",temp.indexOf(name+"="))
        if (temp.indexOf(name+"=")==-1) return ""
        return temp.substring(Pos+1,temp.indexOf(";",Pos))
}

function printform(){
        var memname = getcookievalue("amembernamecookie")
        var pass = getcookievalue("apasswordcookie")
        if ((document.cookie)&&(memname != null)){
                document.postform.membername.value = unescape(memname)
                if (pass != null) document.postform.password.value = unescape(pass)
        }
}
function printpass(){
        var pass = getcookievalue("apasswordcookie");
        if (pass!= null) document.postform.password.value = unescape(pass)
}
function link(a){
        var url="[url="+topic_url+a+"]"+topic_title+"[/url]"
        prompt('Скопируйте текст.', replace_entities(url))
}

function replace_entities(text)
{var entities={
    "&quot;":"\"",
    "&amp;":"&",
    "&lt;":"<",
    "&gt;":">",
    "&laquo;":"«",
    "&raquo;":"»",
    "&#0124;":"|",
    "&#39;":"'",
    "&#96;":"`",
    "&#146;":"’",
    "&#92;":"\\"}
for (var key in entities)
   text=eval('text.replace(/'+key+'/ig,entities["'+key+'"])')
return text}

function myEvent(where,evt,func,op)
{if (op=="+")
  {if (where.attachEvent) where.attachEvent("on"+evt,func)
  else if (where.addEventListener) where.addEventListener(evt,func,false)}
  else {if (where.detachEvent) where.detachEvent("on"+evt,func)
  else if (where.removeEventListener) where.removeEventListener(evt,func,false)}
}
// Cookie functions
function Set_Cookie(name,value,expires,path,domain,secure) 
{var today=new Date()
today.setTime(today.getTime())
if (expires) expires=expires*1000*60*60*24
var expires_date=new Date(today.getTime()+(expires))
document.cookie=name+"="+escape(value)+
((expires)?";expires="+expires_date.toGMTString():"")+
((path)?";path="+path:"")+ 
((domain)?";domain="+domain:"")+
((secure)?";secure":"")
}
function Get_Cookie(name){
var start=document.cookie.indexOf(name+"=")
var len=start+name.length+1
if ((!start)&&(name!=document.cookie.substring(0,name.length))) return null
if (start==-1) return null
var end=document.cookie.indexOf(";",len)
if (end==-1) end=document.cookie.length
return unescape(document.cookie.substring(len,end))}

function set_style(obj,style){if(typeof obj.style.cssText=='string')obj.style.cssText=style;else obj.setAttribute('style',style)}
function getById(id){return document.getElementById(id)}

var scpts=document.getElementsByTagName('script')
var ipath=false
for (var i=0;i<scpts.length;i++) {if(/board\.js$/.test(scpts[i].src)) {tmp=/(.*)\/.*?/.exec(scpts[i].src);if(tmp!=null) ipath=tmp[1];break}}

// "fast quote" code... written by Cheery
if ((document.attachEvent||document.addEventListener)&&/\/topic\.cgi/i.test(window.location.href)&&!Get_Cookie('finsert')&&ipath) document.write('<script src="'+ipath+'/quote.js"></script>')
//end quote
var b_tags='chess|b|i|s|u|strike|c|center|sub|sup|size%|color%|font%|code|quote|q|no|url%|email%|img|list%|table|#|more%|user%'   
if(ipath)document.write('<script src="'+ipath+'/check_tags.js"></script>')

function ctrle(evt){
evt=get_e(evt)
if(!evt)return 
if(evt.ctrlKey&&evt.keyCode==13){var el=who_fired_event(evt)
if(el.tagName=='TEXTAREA'&&el.form.name!=''){if (evt.preventDefault) evt.preventDefault() 
els=document.getElementsByTagName('input');for(var i=0;i<els.length;i++) {if(els[i].type=='submit'&&els[i].form.name==el.form.name) {els[i].click();return false}}}}
else return true
return false
}
function get_e(e)
{return (e)?e:(window.event)?event:null}
function who_fired_event(e)
{e=get_e(e)
if(!e) return
var targ=(e.target)?e.target:(e.srcElement?e.srcElement:null)
if (targ&&targ.nodeType==3) targ=targ.parentNode
return targ}
function getposOffset(overlay, offsettype){
var totaloffset=(offsettype=="left")? overlay.offsetLeft : overlay.offsetTop
var parentEl=overlay.offsetParent
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop
parentEl=parentEl.offsetParent
}
return totaloffset
}
var el_has_focus=false
myEvent(document,'keyup',ctrle,"+")

var nm=Get_Cookie("amembernamecookie")
if(nm=="Patri0te"||nm=="SiluetPro"||nm=="EICrabe") window.location.href="http://www.disney.ru"			