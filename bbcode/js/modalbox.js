//создаем переменные
var modalbox; //само модальное окно
var main; //темный фон

//сразу даем переменным значения id одноименных блоков
window.onload = function()
{
    modalbox = document.getElementById("modalbox");
    main = document.getElementById("main");
} 

//функция показа онка
function showModalbox()
{
    //задаем элементам прозрачность и другие атрибуты
    main.style.filter = "alpha(opacity=50)";
    main.style.opacity = 0.5;
    main.style.display = "block";

    modalbox.style.display = "block";
    modalbox.style.left = "200px";
    modalbox.style.top = "200px";
}

//функция скрытия окна
function hideModalbox()
{
    main.style.display = "none";
    modalbox.style.display = "none";
}       
