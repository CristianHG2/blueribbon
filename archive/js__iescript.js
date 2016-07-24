function hasClass(element, className) {
    return element.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(element.className);
}

test = document.getElementsByTagName("html");
classes = ['ie6', 'ie7', 'ie8', 'ie9'];

for(var i = 0, j = classes.length; i < j; i++) {
    if(hasClass(test, classes[i])) {
       	window.location.href = 'http://www.studiowolfree.com/blueribbon5/old_browser.php';
        break;
    }
}