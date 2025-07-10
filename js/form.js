// script.js

$(function() {

    // Инициализация прогресс-бара и обновление лейбла при изменении значения
    $("#progress").progressbar({
        change: function() {
            $("#amount").text($("#progress").progressbar("option", "value") + "%");
        }
    });

    // Обработчик кнопки "Далее"
    $("#next").click(function(e) {
        e.preventDefault();

        const $currentPanel = $(".form-panel").not(".ui-helper-hidden").first();

        if ($currentPanel.attr("id") !== "thanks") {

            $currentPanel.fadeOut("fast", function() {
                $(this).addClass("ui-helper-hidden");
                const $nextPanel = $(this).next(".form-panel");
                $nextPanel.fadeIn("fast", function() {
                    $(this).removeClass("ui-helper-hidden");

                    // Кнопки управления
                    if ($nextPanel.attr("id") === "thanks") {
                        $("#next").attr("disabled", "disabled");
                        $("#submit").removeAttr("disabled");
                    } else {
                        $("#next").removeAttr("disabled");
                        $("#submit").attr("disabled", "disabled");
                    }

                    if ($nextPanel.attr("id") !== "panel1") {
                        $("#back").removeAttr("disabled");
                    }

                    // Обновляем прогрессбар +50
                    let val = $("#progress").progressbar("option", "value");
                    $("#progress").progressbar("option", "value", val + 50);
                });
            });

        }
    });

    // Обработчик кнопки "Назад"
    $("#back").click(function(e) {
        e.preventDefault();

        const $currentPanel = $(".form-panel").not(".ui-helper-hidden").first();

        if ($currentPanel.attr("id") !== "panel1") {

            $currentPanel.fadeOut("fast", function() {
                $(this).addClass("ui-helper-hidden");
                const $prevPanel = $(this).prev(".form-panel");
                $prevPanel.fadeIn("fast", function() {
                    $(this).removeClass("ui-helper-hidden");

                    if ($prevPanel.attr("id") === "panel1") {
                        $("#back").attr("disabled", "disabled");
                    } else {
                        $("#back").removeAttr("disabled");
                    }

                    if ($prevPanel.attr("id") !== "thanks") {
                        $("#next").removeAttr("disabled");
                        $("#submit").attr("disabled", "disabled");
                    }

                    // Обновляем прогрессбар -50
                    let val = $("#progress").progressbar("option", "value");
                    $("#progress").progressbar("option", "value", val - 50);
                });
            });

        }
    });

    // Изначально блокируем кнопку submit
    $("#submit").attr("disabled", "disabled");

    // Обработчик кнопки "Отправить"
    $("#submit").click(function(e) {
        e.preventDefault();

        const postData = {
            name_post: $('#name').val(),
            fam: $("#fam").val(),
            pass: $("#pass").val(),
            repass: $("#repass").val(),
            email: $("#email").val(),
            telefon: $("#telefon").val(),
            adr: $("#adr").val()
        };

        $.ajax({
            type: "POST",
            url: "index.php?c=register",
            data: postData,
            beforeSend: function() {
                $("#loading img").show();
            },
            complete: function() {
                $("#loading img").hide();
            },
            success: function(answer) {
                $("#thanks p").html(answer);
            },
            error: function() {
                $("#thanks p").html("Ошибка отправки данных. Попробуйте позже.");
            }
        });
    });

});

// --- Остальные вспомогательные функции ---

function SubmitControl(tocheck){
    if (document.all || document.getElementById) {
        for (let i = 0; i < tocheck.length; i++) {
            let obj = tocheck.elements[i];
            if (obj.type.toLowerCase() === "submit" || obj.type.toLowerCase() === "reset") {
                obj.disabled = true;
            }
        }
    }
}

function UnCheckButtons(){
    if(document.getElementsByTagName) {
        var els = document.getElementsByTagName('input');
        for(var i=0; i<els.length; i++) {
            if((els[i].type=='submit'||els[i].type=='reset') && els[i].disabled) els[i].disabled = false;
        }
    }
}
setTimeout(UnCheckButtons, 1000);

function CreateWnd(url, width, height, wndname){
    if (wndname != ''){
        for (var i=0; i < parent.frames.length; i++){
            if (parent.frames[i].name == wndname){
                parent.frames[i].focus();
                return;
            }
        }
    }
    window.open(url, wndname, 'width=' + width + ',height=' + height + ',resizable=1,scrollbars=yes,menubar=yes,status=yes');
}

function Formchecker(tocheck){
    if (tocheck.post && tocheck.post.value.length == 0){
        alert('Пожалуйста, заполните сообщение!');
        tocheck.post.focus();
        return false;
    }
    if (tocheck.membername && tocheck.membername.value.length == 0){
        alert('Пожалуйста, заполните имя!');
        tocheck.membername.focus();
        return false;
    }
    if (typeof check_tags == 'function' && !check_tags(tocheck)) return false;
    if (false && !check_message_style(tocheck.post.value)) {
        tocheck.post.focus();
        return false;
    }
    return true;
}

// Функции для куков с улучшением
function Set_Cookie(name,value,expires,path,domain,secure) {
    var today=new Date();
    today.setTime(today.getTime());
    if (expires) expires=expires*1000*60*60*24;
    var expires_date=new Date(today.getTime()+(expires));
    document.cookie=name+"="+encodeURIComponent(value)+
        ((expires)?";expires="+expires_date.toGMTString():"")+
        ((path)?";path="+path:"")+
        ((domain)?";domain="+domain:"")+
        ((secure)?";secure":"");
}

function Get_Cookie(name){
    var start=document.cookie.indexOf(name+"=");
    var len=start+name.length+1;
    if ((!start)&&(name!=document.cookie.substring(0,name.length))) return null;
    if (start==-1) return null;
    var end=document.cookie.indexOf(";",len);
    if (end==-1) end=document.cookie.length;
    return decodeURIComponent(document.cookie.substring(len,end));
}