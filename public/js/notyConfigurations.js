function generate(type, text) {
    var n = noty({
        text        : text,
        type        : type,
        dismissQueue: true,
        timeout     : 1800,
        closeWith   : ['click'],
        layout      : 'topCenter',
        theme       : 'defaultTheme',
        maxVisible  : 10,
        animation: {
            open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
            close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
            easing: 'swing',
            speed: 5 // opening & closing animation speed
        },
    });
}
