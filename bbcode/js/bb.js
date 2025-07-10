function savesel(doc) {
    if (document.selection) {
        doc.sel = document.selection.createRange().duplicate();
    }
}

// Универсальная вставка BBCode
function insertBBCode(aid, open, close, content) {
    const doc = document.getElementById(aid);
    if (!doc) return false;

    doc.focus();

    if (window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) {
        const s = doc.sel;
        if (s) {
            const l = s.text.length;
            s.text = open + (content || s.text) + close;
            s.moveEnd("character", -close.length);
            s.moveStart("character", -l);
            s.select();
        }
    } else {
        const ss = doc.scrollTop;
        const sel1 = doc.value.substring(0, doc.selectionStart);
        const sel2 = doc.value.substring(doc.selectionEnd);
        const sel = doc.value.substring(doc.selectionStart, doc.selectionEnd);
        const middle = content || sel;
        doc.value = sel1 + open + middle + close + sel2;
        doc.selectionStart = sel1.length + open.length;
        doc.selectionEnd = doc.selectionStart + middle.length;
        doc.scrollTop = ss;
    }

    return false;
}

// Вставка ссылок
function click_url() {
    const url = prompt('Пожалуйста, введите URL ссылки');
    const text = prompt('Пожалуйста, введите заголовок для ссылки');
    if (url) insertBBCode('text', `[url=${url}]`, '[/url]', text);
}

// Вставка email
function click_email() {
    const email = prompt('Пожалуйста, введите email адрес');
    const text = prompt('Пожалуйста, введите заголовок для email');
    if (email) insertBBCode('text', `[email=${email}]`, '[/email]', text);
}

// Вставка изображения
function click_image() {
    const image = prompt('Пожалуйста, введите URL изображения');
    if (image) insertBBCode('text', `[img]`, `[/img]`, image);
}

// Вставка спецтега типа [size=12]
function click_zv(aid, tag, close) {
    const open = `[${tag}]`;
    const end = close ? `[/${close}]` : '';
    insertBBCode(aid, open, end);
}

// Общая вставка BB
function click_bb(aid, tag, close) {
    const open = `[${tag}]`;
    const end = close ? `[/${close}]` : `[/${tag}]`;
    insertBBCode(aid, open, end);
}

// Вставка BB с внешним содержимым (URL, email и т.д.)
function click_bb1(aid, tag, close, content) {
    const open = `[${tag}]${content}`;
    const end = close ? `[/${close}]` : `[/${tag}]`;
    insertBBCode(aid, open, end);
}

function click_bb2(aid, tag, close, content) {
    const open = `[${tag}]${content}`;
    const end = close ? `[/${close}]` : `[/${tag}]`;
    insertBBCode(aid, open, end);
}

function click_bb3(aid, tag, close, content) {
    const open = `[${tag}]${content}`;
    const end = close ? `[/${close}]` : `[/${tag}]`;
    insertBBCode(aid, open, end);
}

// Вставка смайлика
function click_sm(aid, smile) {
    const code = `[${smile}]`;
    insertBBCode(aid, code, '', '');
}

// Замена изображения кнопки
function change(id, img) {
    const el = document.getElementById(id);
    if (el) {
        el.src = (typeof irb_bb_path !== 'undefined' ? irb_bb_path : '') + img + '.gif';
    }
}