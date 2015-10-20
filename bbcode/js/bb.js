function savesel(doc)
{
    if(document.selection)
    {                
        doc.sel = document.selection.createRange().duplicate();
    }               
}

function click_url()
{
    var url = prompt('Пожалуйста, ведите URL ссылки');
	var url2 = prompt('Пожалуйста, введите заголовок для этого пункта');
	if(url)
        click_bb1('text', 'url='+url, 'url',url2)
}

function click_email()
{
    var email = prompt('Пожалуйста, ведите email адрес');
	var email2 = prompt('Пожалуйста, введите заголовок для этого пункта');
	if(email)
        click_bb3('text', 'email='+email, 'email',email2)
}

function click_image()
{
    var image = prompt('Пожалуйста, введите URL адрес для этого изображения');
	if(image)
        click_bb2('text', 'img', 'img', image)
}

function click_zv(aid, Tag, Close)
{
    var Open = '[' + Tag + ']';
	
	if(!Close)
        var Close = '';
	else
	    Close = '[/' + Close + ']';
	
    var doc = document.getElementById(aid);
    doc.focus();
    
    if(Tag == 'link')
    {
        var Open = '[' + Tag + ']http://www.';
    }
    
    if(window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) 
    {                                        
        var s = doc.sel;  
        
        if(s)
        {                                  
            var l = s.text.length;
            s.text = Open + s.text;
            s.moveEnd("character", -Close.length);
            s.moveStart("character", -l);                                           
            s.select();                
         }
    } 
    else 
    {                                              
         var ss = doc.scrollTop;
         sel1 = doc.value.substr(0, doc.selectionStart);
         sel2 = doc.value.substr(doc.selectionEnd);
         sel = doc.value.substr(doc.selectionStart, doc.selectionEnd - doc.selectionStart);                                              
         doc.value = sel1 + Open + sel + sel2;
         doc.selectionStart = sel1.length + Open.length;
         doc.selectionEnd = doc.selectionStart + sel.length;
         doc.scrollTop = ss;                                             
    } 
    
    return false;
}

function click_bb1(aid, Tag, Close, url)
{
    var Open = '[' + Tag + ']' + url;
	
	if(!Close)
        var Close = '[/' + Tag + ']';
	else
	    Close = '[/' + Close + ']';
	
    var doc = document.getElementById(aid);
    doc.focus();
    
    if(Tag == 'link')
    {
        var Open = '[' + Tag + ']http://www.';
    }
    
    if(window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) 
    {                                        
        var s = doc.sel;  
        
        if(s)
        {                                  
            var l = s.text.length;
            s.text = Open + s.text + Close;
            s.moveEnd("character", -Close.length);
            s.moveStart("character", -l);                                           
            s.select();                
         }
    } 
    else 
    {                                              
         var ss = doc.scrollTop;
         sel1 = doc.value.substr(0, doc.selectionStart);
         sel2 = doc.value.substr(doc.selectionEnd);
         sel = doc.value.substr(doc.selectionStart, doc.selectionEnd - doc.selectionStart);                                              
         doc.value = sel1 + Open + sel + Close + sel2;
         doc.selectionStart = sel1.length + Open.length;
         doc.selectionEnd = doc.selectionStart + sel.length;
         doc.scrollTop = ss;                                             
    } 
    
    return false;
}

function click_bb3(aid, Tag, Close, email)
{
    var Open = '[' + Tag + ']' + email;
	
	if(!Close)
        var Close = '[/' + Tag + ']';
	else
	    Close = '[/' + Close + ']';
	
    var doc = document.getElementById(aid);
    doc.focus();
    
    if(Tag == 'link')
    {
        var Open = '[' + Tag + ']http://www.';
    }
    
    if(window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) 
    {                                        
        var s = doc.sel;  
        
        if(s)
        {                                  
            var l = s.text.length;
            s.text = Open + s.text + Close;
            s.moveEnd("character", -Close.length);
            s.moveStart("character", -l);                                           
            s.select();                
         }
    } 
    else 
    {                                              
         var ss = doc.scrollTop;
         sel1 = doc.value.substr(0, doc.selectionStart);
         sel2 = doc.value.substr(doc.selectionEnd);
         sel = doc.value.substr(doc.selectionStart, doc.selectionEnd - doc.selectionStart);                                              
         doc.value = sel1 + Open + sel + Close + sel2;
         doc.selectionStart = sel1.length + Open.length;
         doc.selectionEnd = doc.selectionStart + sel.length;
         doc.scrollTop = ss;                                             
    } 
    
    return false;
}

function click_bb2(aid, Tag, Close, image)
{
    var Open = '[' + Tag + ']' + image;
	
	if(!Close)
        var Close = '[/' + Tag + ']';
	else
	    Close = '[/' + Close + ']';
	
    var doc = document.getElementById(aid);
    doc.focus();
    
    if(Tag == 'link')
    {
        var Open = '[' + Tag + ']http://www.';
    }
    
    if(window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) 
    {                                        
        var s = doc.sel;  
        
        if(s)
        {                                  
            var l = s.text.length;
            s.text = Open + s.text + Close;
            s.moveEnd("character", -Close.length);
            s.moveStart("character", -l);                                           
            s.select();                
         }
    } 
    else 
    {                                              
         var ss = doc.scrollTop;
         sel1 = doc.value.substr(0, doc.selectionStart);
         sel2 = doc.value.substr(doc.selectionEnd);
         sel = doc.value.substr(doc.selectionStart, doc.selectionEnd - doc.selectionStart);                                              
         doc.value = sel1 + Open + sel + Close + sel2;
         doc.selectionStart = sel1.length + Open.length;
         doc.selectionEnd = doc.selectionStart + sel.length;
         doc.scrollTop = ss;                                             
    } 
    
    return false;
}


function click_bb(aid, Tag, Close)
{
    var Open = '[' + Tag + ']';
	
	if(!Close)
        var Close = '[/' + Tag + ']';
	else
	    Close = '[/' + Close + ']';
	
    var doc = document.getElementById(aid);
    doc.focus();
    
    if(Tag == 'link')
    {
        var Open = '[' + Tag + ']http://www.';
    }
    
    if(window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) 
    {                                        
        var s = doc.sel;  
        
        if(s)
        {                                  
            var l = s.text.length;
            s.text = Open + s.text + Close;
            s.moveEnd("character", -Close.length);
            s.moveStart("character", -l);                                           
            s.select();                
         }
    } 
    else 
    {                                              
         var ss = doc.scrollTop;
         sel1 = doc.value.substr(0, doc.selectionStart);
         sel2 = doc.value.substr(doc.selectionEnd);
         sel = doc.value.substr(doc.selectionStart, doc.selectionEnd - doc.selectionStart);                                              
         doc.value = sel1 + Open + sel + Close + sel2;
         doc.selectionStart = sel1.length + Open.length;
         doc.selectionEnd = doc.selectionStart + sel.length;
         doc.scrollTop = ss;                                             
    } 
    
    return false;
}

function click_sm(aid,smile)
{
    var sm ='[' + smile + ']';      
    var doc = document.getElementById(aid);
    doc.focus();
    
    if(window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) 
    {                                        
        var s = doc.sel;  
        
        if(s)
        {                                  
            var l = s.text.length;
            s.text = sm + s.text;
            s.moveStart("character", -l);                                           
            s.select();                
         }
    } 
    else 
    {                                              
         var ss = doc.scrollTop;
         sel1 = doc.value.substr(0, doc.selectionStart);
         sel = doc.value.substr(doc.selectionStart, doc.selectionEnd - doc.selectionStart);                                              
         doc.value = sel1 + sm+ sel;
         doc.selectionStart = sel1.length + sm.length;
         doc.selectionEnd = doc.selectionStart + sel.length;
         doc.scrollTop = ss;                                             
    } 
    
    return false;
}


function change(id, img)
{ 
    document.getElementById(id).src = irb_bb_path + img + '.gif';
} 