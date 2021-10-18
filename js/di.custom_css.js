ready((event) => {
    document.querySelector('#customCss').addEventListener('keyup', () => {
        document.querySelector('#di_css').value = editor.getSession().getValue();
    });

});

const editor = ace.edit("customCss");

editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/css");



/*
    ==============================
    |   Document Ready Function
    ==============================
*/
function ready(callbackFunction){
    if(document.readyState != 'loading') {
        callbackFunction(event);
    } else {
        document.addEventListener("DOMContentLoaded", callbackFunction);
    }
}