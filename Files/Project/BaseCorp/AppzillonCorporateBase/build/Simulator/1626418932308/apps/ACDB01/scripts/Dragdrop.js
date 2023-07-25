apz.dragdrop = {};
apz.dragdrop.droppable = function(a) {
    $(a).droppable({
        drop: function(a, c) {
            $(this).append(c.draggable)
        }
    })
};
apz.dragdrop.draggable = function(a) {
    $(a).draggable({
        helper: "clone"
    })
};
apz.dragdrop.touchHandler = function(a) {
    debugger;
    var b = a.changedTouches[0];
    switch (a.type) {
        case "touchstart":
            var c = "mousedown";
            break;
        case "touchmove":
            c = "mousemove";
            break;
        case "touchend":
            c = "mouseup";
            break;
        default:
            return
    }
    var d = document.createEvent("MouseEvent");
    d.initMouseEvent(c, !0, !0, window, 1, b.screenX, b.screenY, b.clientX, b.clientY, !1, !1, !1, !1, 0, null);
    b.target.dispatchEvent(d);
    //a.preventDefault()
    
 
};
apz.dragdrop.initTouch = function() {
    debugger;
    document.addEventListener("touchstart", apz.dragdrop.touchHandler, { passive: false });
    document.addEventListener("touchmove", apz.dragdrop.touchHandler, { passive: false });
    document.addEventListener("touchend", apz.dragdrop.touchHandler, { passive: false });
    document.addEventListener("touchcancel", apz.dragdrop.touchHandler, { passive: false })
};
