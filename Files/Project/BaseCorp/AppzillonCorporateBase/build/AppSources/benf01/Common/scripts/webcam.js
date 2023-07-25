// WebcamJS v1.0.22 - http://github.com/jhuckaby/webcamjs - MIT Licensed
(function(e) {
    var t;

    function a() {
        var e = Error.apply(this, arguments);
        e.name = this.name = "FlashError";
        this.stack = e.stack;
        this.message = e.message
    }

    function i() {
        var e = Error.apply(this, arguments);
        e.name = this.name = "WebcamError";
        this.stack = e.stack;
        this.message = e.message
    }
    IntermediateInheritor = function() {};
    IntermediateInheritor.prototype = Error.prototype;
    a.prototype = new IntermediateInheritor;
    i.prototype = new IntermediateInheritor;
    var Webcam = {
        version: "1.0.22",
        protocol: location.protocol.match(/https/i) ? "https" : "http",
        loaded: false,
        live: false,
        userMedia: true,
        iOS: /iPad|iPhone|iPod/.test(navigator.userAgent) && !e.MSStream,
        params: {
            width: 0,
            height: 0,
            dest_width: 0,
            dest_height: 0,
            image_format: "jpeg",
            jpeg_quality: 90,
            enable_flash: true,
            force_flash: false,
            flip_horiz: false,
            fps: 30,
            upload_name: "webcam",
            constraints: null,
            swfURL: "",
            flashNotDetectedText: "ERROR: No Adobe Flash Player detected.  Webcam.js relies on Flash for browsers that do not support getUserMedia (like yours).",
            noInterfaceFoundText: "No supported webcam interface found.",
            unfreeze_snap: true,
            iosPlaceholderText: "Click here to open camera.",
            user_callback: null,
            user_canvas: null
        },
        errors: {
            FlashError: a,
            WebcamError: i
        },
        hooks: {},
        init: function() {
            var t = this;
            this.mediaDevices = navigator.mediaDevices && navigator.mediaDevices.getUserMedia ? navigator.mediaDevices : navigator.mozGetUserMedia ||
                navigator.webkitGetUserMedia ? {
                    getUserMedia: function(e) {
                        return new Promise(function(t, a) {
                            (navigator.mozGetUserMedia || navigator.webkitGetUserMedia).call(navigator, e, t, a)
                        })
                    }
            } : null;
            e.URL = e.URL || e.webkitURL || e.mozURL || e.msURL;
            this.userMedia = this.userMedia && !! this.mediaDevices && !! e.URL;
            if (navigator.userAgent.match(/Firefox\D+(\d+)/)) {
                if (parseInt(RegExp.$1, 10) < 21) this.userMedia = null
            }
            if (this.userMedia) {
                e.addEventListener("beforeunload", function(e) {
                    t.reset()
                })
            }
        },
        exifOrientation: function(e) {
            var t = new DataView(e);
            if (t.getUint8(0) != 255 || t.getUint8(1) != 216) {
                console.log("Not a valid JPEG file");
                return 0
            }
            var a = 2;
            var i = null;
            while (a < e.byteLength) {
                if (t.getUint8(a) != 255) {
                    console.log("Not a valid marker at offset " + a + ", found: " + t.getUint8(a));
                    return 0
                }
                i = t.getUint8(a + 1);
                if (i == 225) {
                    a += 4;
                    var s = "";
                    for (n = 0; n < 4; n++) {
                        s += String.fromCharCode(t.getUint8(a + n))
                    }
                    if (s != "Exif") {
                        console.log("Not valid EXIF data found");
                        return 0
                    }
                    a += 6;
                    var r = null;
                    if (t.getUint16(a) == 18761) {
                        r = false
                    } else if (t.getUint16(a) == 19789) {
                        r = true
                    } else {
                        console.log("Not valid TIFF data! (no 0x4949 or 0x4D4D)");
                        return 0
                    } if (t.getUint16(a + 2, !r) != 42) {
                        console.log("Not valid TIFF data! (no 0x002A)");
                        return 0
                    }
                    var o = t.getUint32(a + 4, !r);
                    if (o < 8) {
                        console.log("Not valid TIFF data! (First offset less than 8)", t.getUint32(a + 4, !r));
                        return 0
                    }
                    var h = a + o;
                    var l = t.getUint16(h, !r);
                    for (var c = 0; c < l; c++) {
                        var d = h + c * 12 + 2;
                        if (t.getUint16(d, !r) == 274) {
                            var f = t.getUint16(d + 2, !r);
                            var m = t.getUint32(d + 4, !r);
                            if (f != 3 && m != 1) {
                                console.log("Invalid EXIF orientation value type (" + f + ") or count (" + m + ")");
                                return 0
                            }
                            var p = t.getUint16(d + 8, !r);
                            if (p < 1 || p > 8) {
                                console.log("Invalid EXIF orientation value (" + p + ")");
                                return 0
                            }
                            return p
                        }
                    }
                } else {
                    a += 2 + t.getUint16(a + 2)
                }
            }
            return 0
        },
        fixOrientation: function(e, t, a) {
            var i = new Image;
            i.addEventListener("load", function(e) {
                var s = document.createElement("canvas");
                var r = s.getContext("2d");
                if (t < 5) {
                    s.width = i.width;
                    s.height = i.height
                } else {
                    s.width = i.height;
                    s.height = i.width
                }
                switch (t) {
                    case 2:
                        r.transform(-1, 0, 0, 1, i.width, 0);
                        break;
                    case 3:
                        r.transform(-1, 0, 0, -1, i.width, i.height);
                        break;
                    case 4:
                        r.transform(1, 0, 0, -1, 0, i.height);
                        break;
                    case 5:
                        r.transform(0, 1, 1, 0, 0, 0);
                        break;
                    case 6:
                        r.transform(0, 1, -1, 0, i.height, 0);
                        break;
                    case 7:
                        r.transform(0, -1, -1, 0, i.height, i.width);
                        break;
                    case 8:
                        r.transform(0, -1, 1, 0, 0, i.width);
                        break
                }
                r.drawImage(i, 0, 0);
                a.src = s.toDataURL()
            }, false);
            i.src = e
        },
        attach: function(a) {
            if (typeof a == "string") {
                a = document.getElementById(a) || document.querySelector(a)
            }
            if (!a) {
                return this.dispatch("error", new i("Could not locate DOM element to attach to."))
            }
            this.container = a;
            a.innerHTML = "";
            var s = document.createElement("div");
            a.appendChild(s);
            this.peg = s;
            if (!this.params.width) this.params.width = a.offsetWidth;
            if (!this.params.height) this.params.height = a.offsetHeight;
            if (!this.params.width || !this.params.height) {
                return this.dispatch("error", new i(
                    "No width and/or height for webcam.  Please call set() first, or attach to a visible element."))
            }
            if (!this.params.dest_width) this.params.dest_width = this.params.width;
            if (!this.params.dest_height) this.params.dest_height = this.params.height;
            this.userMedia = t === undefined ? this.userMedia : t;
            if (this.params.force_flash) {
                t = this.userMedia;
                this.userMedia = null
            }
            if (typeof this.params.fps !== "number") this.params.fps = 30;
            var r = this.params.width / this.params.dest_width;
            var o = this.params.height / this.params.dest_height;
            if (this.userMedia) {
                var n = document.createElement("video");
                n.setAttribute("autoplay", "autoplay");
                n.style.width = "" + this.params.dest_width + "px";
                n.style.height = "" + this.params.dest_height + "px";
                if (r != 1 || o != 1) {
                    a.style.overflow = "hidden";
                    n.style.webkitTransformOrigin = "0px 0px";
                    n.style.mozTransformOrigin = "0px 0px";
                    n.style.msTransformOrigin = "0px 0px";
                    n.style.oTransformOrigin = "0px 0px";
                    n.style.transformOrigin = "0px 0px";
                    n.style.webkitTransform = "scaleX(" + r + ") scaleY(" + o + ")";
                    n.style.mozTransform = "scaleX(" + r + ") scaleY(" + o + ")";
                    n.style.msTransform = "scaleX(" + r + ") scaleY(" + o + ")";
                    n.style.oTransform = "scaleX(" + r + ") scaleY(" + o + ")";
                    n.style.transform = "scaleX(" + r + ") scaleY(" + o + ")"
                }
                a.appendChild(n);
                this.video = n;
                var h = this;
                this.mediaDevices.getUserMedia({
                    audio: false,
                    video: this.params.constraints || {
                        mandatory: {
                            minWidth: this.params.dest_width,
                            minHeight: this.params.dest_height
                        }
                    }
                }).then(function(t) {
                    n.onloadedmetadata = function(e) {
                        h.stream = t;
                        h.loaded = true;
                        h.live = true;
                        h.dispatch("load");
                        h.dispatch("live");
                        h.flip()
                    };
                    n.src = e.URL.createObjectURL(t) || t
                }).
                catch (function(e) {
                    if (h.params.enable_flash && h.detectFlash()) {
                        setTimeout(function() {
                            h.params.force_flash = 1;
                            h.attach(a)
                        }, 1)
                    } else {
                        h.dispatch("error", e)
                    }
                })
            } else if (this.iOS) {
                var l = document.createElement("div");
                l.id = this.container.id + "-ios_div";
                l.className = "webcamjs-ios-placeholder";
                l.style.width = "" + this.params.width + "px";
                l.style.height = "" + this.params.height + "px";
                l.style.textAlign = "center";
                l.style.display = "table-cell";
                l.style.verticalAlign = "middle";
                l.style.backgroundRepeat = "no-repeat";
                l.style.backgroundSize = "contain";
                l.style.backgroundPosition = "center";
                var c = document.createElement("span");
                c.className = "webcamjs-ios-text";
                c.innerHTML = this.params.iosPlaceholderText;
                l.appendChild(c);
                var d = document.createElement("img");
                d.id = this.container.id + "-ios_img";
                d.style.width = "" + this.params.dest_width + "px";
                d.style.height = "" + this.params.dest_height + "px";
                d.style.display = "none";
                l.appendChild(d);
                var f = document.createElement("input");
                f.id = this.container.id + "-ios_input";
                f.setAttribute("type", "file");
                f.setAttribute("accept", "image/*");
                f.setAttribute("capture", "camera");
                var h = this;
                var m = this.params;
                f.addEventListener("change", function(e) {
                    if (e.target.files.length > 0 && e.target.files[0].type.indexOf("image/") == 0) {
                        var t = URL.createObjectURL(e.target.files[0]);
                        var a = new Image;
                        a.addEventListener("load", function(e) {
                            var t = document.createElement("canvas");
                            t.width = m.dest_width;
                            t.height = m.dest_height;
                            var i = t.getContext("2d");
                            ratio = Math.min(a.width / m.dest_width, a.height / m.dest_height);
                            var s = m.dest_width * ratio;
                            var r = m.dest_height * ratio;
                            var o = (a.width - s) / 2;
                            var n = (a.height - r) / 2;
                            i.drawImage(a, o, n, s, r, 0, 0, m.dest_width, m.dest_height);
                            var h = t.toDataURL();
                            d.src = h;
                            l.style.backgroundImage = "url('" + h + "')"
                        }, false);
                        var i = new FileReader;
                        i.addEventListener("load", function(e) {
                            var i = h.exifOrientation(e.target.result);
                            if (i > 1) {
                                h.fixOrientation(t, i, a)
                            } else {
                                a.src = t
                            }
                        }, false);
                        var s = new XMLHttpRequest;
                        s.open("GET", t, true);
                        s.responseType = "blob";
                        s.onload = function(e) {
                            if (this.status == 200 || this.status === 0) {
                                i.readAsArrayBuffer(this.response)
                            }
                        };
                        s.send()
                    }
                }, false);
                f.style.display = "none";
                a.appendChild(f);
                l.addEventListener("click", function(e) {
                    if (m.user_callback) {
                        h.snap(m.user_callback, m.user_canvas)
                    } else {
                        f.style.display = "block";
                        f.focus();
                        f.click();
                        f.style.display = "none"
                    }
                }, false);
                a.appendChild(l);
                this.loaded = true;
                this.live = true
            } else if (this.params.enable_flash && this.detectFlash()) {
                e.Webcam = Webcam;
                var l = document.createElement("div");
                l.innerHTML = this.getSWFHTML();
                a.appendChild(l)
            } else {
                this.dispatch("error", new i(this.params.noInterfaceFoundText))
            } if (this.params.crop_width && this.params.crop_height) {
                var p = Math.floor(this.params.crop_width * r);
                var u = Math.floor(this.params.crop_height * o);
                a.style.width = "" + p + "px";
                a.style.height = "" + u + "px";
                a.style.overflow = "hidden";
                a.scrollLeft = Math.floor(this.params.width / 2 - p / 2);
                a.scrollTop = Math.floor(this.params.height / 2 - u / 2)
            } else {
                a.style.width = "" + this.params.width + "px";
                a.style.height = "" + this.params.height + "px"
            }
        },
        reset: function() {
            if (this.preview_active) this.unfreeze();
            this.unflip();
            if (this.userMedia) {
                if (this.stream) {
                    if (this.stream.getVideoTracks) {
                        var e = this.stream.getVideoTracks();
                        if (e && e[0] && e[0].stop) e[0].stop()
                    } else if (this.stream.stop) {
                        this.stream.stop()
                    }
                }
                delete this.stream;
                delete this.video
            }
            if (this.userMedia !== true && this.loaded && !this.iOS) {
                var t = this.getMovie();
                if (t && t._releaseCamera) t._releaseCamera()
            }
            if (this.container) {
                this.container.innerHTML = "";
                delete this.container
            }
            this.loaded = false;
            this.live = false
        },
        set: function() {
            if (arguments.length == 1) {
                for (var e in arguments[0]) {
                    this.params[e] = arguments[0][e]
                }
            } else {
                this.params[arguments[0]] = arguments[1]
            }
        },
        on: function(e, t) {
            e = e.replace(/^on/i, "").toLowerCase();
            if (!this.hooks[e]) this.hooks[e] = [];
            this.hooks[e].push(t)
        },
        off: function(e, t) {
            e = e.replace(/^on/i, "").toLowerCase();
            if (this.hooks[e]) {
                if (t) {
                    var a = this.hooks[e].indexOf(t);
                    if (a > -1) this.hooks[e].splice(a, 1)
                } else {
                    this.hooks[e] = []
                }
            }
        },
        dispatch: function() {
            var t = arguments[0].replace(/^on/i, "").toLowerCase();
            var s = Array.prototype.slice.call(arguments, 1);
            if (this.hooks[t] && this.hooks[t].length) {
                for (var r = 0, o = this.hooks[t].length; r < o; r++) {
                    var n = this.hooks[t][r];
                    if (typeof n == "function") {
                        n.apply(this, s)
                    } else if (typeof n == "object" && n.length == 2) {
                        n[0][n[1]].apply(n[0], s)
                    } else if (e[n]) {
                        e[n].apply(e, s)
                    }
                }
                return true
            } else if (t == "error") {
                if (s[0] instanceof a || s[0] instanceof i) {
                    message = s[0].message
                } else {
                    message = "Could not access webcam: " + s[0].name + ": " + s[0].message + " " + s[0].toString()
                }
                alert("Webcam.js Error: " + message)
            }
            return false
        },
        setSWFLocation: function(e) {
            this.set("swfURL", e)
        },
        detectFlash: function() {
            var t = "Shockwave Flash",
                a = "ShockwaveFlash.ShockwaveFlash",
                i = "application/x-shockwave-flash",
                s = e,
                r = navigator,
                o = false;
            if (typeof r.plugins !== "undefined" && typeof r.plugins[t] === "object") {
                var n = r.plugins[t].description;
                if (n && (typeof r.mimeTypes !== "undefined" && r.mimeTypes[i] && r.mimeTypes[i].enabledPlugin)) {
                    o = true
                }
            } else if (typeof s.ActiveXObject !== "undefined") {
                try {
                    var h = new ActiveXObject(a);
                    if (h) {
                        var l = h.GetVariable("$version");
                        if (l) o = true
                    }
                } catch (e) {}
            }
            return o
        },
        getSWFHTML: function() {
            var t = "",
                i = this.params.swfURL;
            if (location.protocol.match(/file/)) {
                this.dispatch("error", new a("Flash does not work from local disk.  Please run from a web server."));
                return '<h3 style="color:red">ERROR: the Webcam.js Flash fallback does not work from local disk.  Please run it from a web server.</h3>'
            }
            if (!this.detectFlash()) {
                this.dispatch("error", new a("Adobe Flash Player not found.  Please install from get.adobe.com/flashplayer and try again."));
                return '<h3 style="color:red">' + this.params.flashNotDetectedText + "</h3>"
            }
            if (!i) {
                var s = "";
                var r = document.getElementsByTagName("script");
                for (var o = 0, n = r.length; o < n; o++) {
                    var h = r[o].getAttribute("src");
                    if (h && h.match(/\/webcam(\.min)?\.js/)) {
                        s = h.replace(/\/webcam(\.min)?\.js.*$/, "");
                        o = n
                    }
                }
                if (s) i = s + "/webcam.swf";
                else i = "webcam.swf"
            }
            if (e.localStorage && !localStorage.getItem("visited")) {
                this.params.new_user = 1;
                localStorage.setItem("visited", 1)
            }
            var l = "";
            for (var c in this.params) {
                if (l) l += "&";
                l += c + "=" + escape(this.params[c])
            }
            t += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" type="application/x-shockwave-flash" codebase="' + this.protocol +
                '://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="' + this.params.width + '" height="' +
                this.params.height +
                '" id="webcam_movie_obj" align="middle"><param name="wmode" value="opaque" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="' +
                i +
                '" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="' +
                l + '"/><embed id="webcam_movie_embed" src="' + i +
                '" wmode="opaque" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="' + this.params.width + '" height="' + this.params
                .height +
                '" name="webcam_movie_embed" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="' +
                l + '"></embed></object>';
            return t
        },
        getMovie: function() {
            if (!this.loaded) return this.dispatch("error", new a("Flash Movie is not loaded yet"));
            var e = document.getElementById("webcam_movie_obj");
            if (!e || !e._snap) e = document.getElementById("webcam_movie_embed");
            if (!e) this.dispatch("error", new a("Cannot locate Flash movie in DOM"));
            return e
        },
        freeze: function() {
            var e = this;
            var t = this.params;
            if (this.preview_active) this.unfreeze();
            var a = this.params.width / this.params.dest_width;
            var i = this.params.height / this.params.dest_height;
            this.unflip();
            var s = t.crop_width || t.dest_width;
            var r = t.crop_height || t.dest_height;
            var o = document.createElement("canvas");
            o.width = s;
            o.height = r;
            var n = o.getContext("2d");
            this.preview_canvas = o;
            this.preview_context = n;
            if (a != 1 || i != 1) {
                o.style.webkitTransformOrigin = "0px 0px";
                o.style.mozTransformOrigin = "0px 0px";
                o.style.msTransformOrigin = "0px 0px";
                o.style.oTransformOrigin = "0px 0px";
                o.style.transformOrigin = "0px 0px";
                o.style.webkitTransform = "scaleX(" + a + ") scaleY(" + i + ")";
                o.style.mozTransform = "scaleX(" + a + ") scaleY(" + i + ")";
                o.style.msTransform = "scaleX(" + a + ") scaleY(" + i + ")";
                o.style.oTransform = "scaleX(" + a + ") scaleY(" + i + ")";
                o.style.transform = "scaleX(" + a + ") scaleY(" + i + ")"
            }
            this.snap(function() {
                o.style.position = "relative";
                o.style.left = "" + e.container.scrollLeft + "px";
                o.style.top = "" + e.container.scrollTop + "px";
                e.container.insertBefore(o, e.peg);
                e.container.style.overflow = "hidden";
                e.preview_active = true
            }, o)
        },
        unfreeze: function() {
            if (this.preview_active) {
                this.container.removeChild(this.preview_canvas);
                delete this.preview_context;
                delete this.preview_canvas;
                this.preview_active = false;
                this.flip()
            }
        },
        flip: function() {
            if (this.params.flip_horiz) {
                var e = this.container.style;
                e.webkitTransform = "scaleX(-1)";
                e.mozTransform = "scaleX(-1)";
                e.msTransform = "scaleX(-1)";
                e.oTransform = "scaleX(-1)";
                e.transform = "scaleX(-1)";
                e.filter = "FlipH";
                e.msFilter = "FlipH"
            }
        },
        unflip: function() {
            if (this.params.flip_horiz) {
                var e = this.container.style;
                e.webkitTransform = "scaleX(1)";
                e.mozTransform = "scaleX(1)";
                e.msTransform = "scaleX(1)";
                e.oTransform = "scaleX(1)";
                e.transform = "scaleX(1)";
                e.filter = "";
                e.msFilter = ""
            }
        },
        savePreview: function(e, t) {
            var a = this.params;
            var i = this.preview_canvas;
            var s = this.preview_context;
            if (t) {
                var r = t.getContext("2d");
                r.drawImage(i, 0, 0)
            }
            e(t ? null : i.toDataURL("image/" + a.image_format, a.jpeg_quality / 100), i, s);
            if (this.params.unfreeze_snap) this.unfreeze()
        },
        snap: function(e, t) {
            if (!e) e = this.params.user_callback;
            if (!t) t = this.params.user_canvas;
            var a = this;
            var s = this.params;
            if (!this.loaded) return this.dispatch("error", new i("Webcam is not loaded yet"));
            if (!e) return this.dispatch("error", new i("Please provide a callback function or canvas to snap()"));
            if (this.preview_active) {
                this.savePreview(e, t);
                return null
            }
            var r = document.createElement("canvas");
            r.width = this.params.dest_width;
            r.height = this.params.dest_height;
            var o = r.getContext("2d");
            if (this.params.flip_horiz) {
                o.translate(s.dest_width, 0);
                o.scale(-1, 1)
            }
            var n = function() {
                if (this.src && this.width && this.height) {
                    o.drawImage(this, 0, 0, s.dest_width, s.dest_height)
                }
                if (s.crop_width && s.crop_height) {
                    var a = document.createElement("canvas");
                    a.width = s.crop_width;
                    a.height = s.crop_height;
                    var i = a.getContext("2d");
                    i.drawImage(r, Math.floor(s.dest_width / 2 - s.crop_width / 2), Math.floor(s.dest_height / 2 - s.crop_height / 2), s.crop_width,
                        s.crop_height, 0, 0, s.crop_width, s.crop_height);
                    o = i;
                    r = a
                }
                if (t) {
                    var n = t.getContext("2d");
                    n.drawImage(r, 0, 0)
                }
                e(t ? null : r.toDataURL("image/" + s.image_format, s.jpeg_quality / 100), r, o)
            };
            if (this.userMedia) {
                o.drawImage(this.video, 0, 0, this.params.dest_width, this.params.dest_height);
                n()
            } else if (this.iOS) {
                var h = document.getElementById(this.container.id + "-ios_div");
                var l = document.getElementById(this.container.id + "-ios_img");
                var c = document.getElementById(this.container.id + "-ios_input");
                iFunc = function(e) {
                    n.call(l);
                    l.removeEventListener("load", iFunc);
                    h.style.backgroundImage = "none";
                    l.removeAttribute("src");
                    c.value = null
                };
                if (!c.value) {
                    l.addEventListener("load", iFunc);
                    c.style.display = "block";
                    c.focus();
                    c.click();
                    c.style.display = "none"
                } else {
                    iFunc(null)
                }
            } else {
                var d = this.getMovie()._snap();
                var l = new Image;
                l.onload = n;
                l.src = "data:image/" + this.params.image_format + ";base64," + d
            }
            return null
        },
        configure: function(e) {
            if (!e) e = "camera";
            this.getMovie()._configure(e)
        },
        flashNotify: function(e, t) {
            switch (e) {
                case "flashLoadComplete":
                    this.loaded = true;
                    this.dispatch("load");
                    break;
                case "cameraLive":
                    this.live = true;
                    this.dispatch("live");
                    break;
                case "error":
                    this.dispatch("error", new a(t));
                    break;
                default:
                    break
            }
        },
        b64ToUint6: function(e) {
            return e > 64 && e < 91 ? e - 65 : e > 96 && e < 123 ? e - 71 : e > 47 && e < 58 ? e + 4 : e === 43 ? 62 : e === 47 ? 63 : 0
        },
        base64DecToArr: function(e, t) {
            var a = e.replace(/[^A-Za-z0-9\+\/]/g, ""),
                i = a.length,
                s = t ? Math.ceil((i * 3 + 1 >> 2) / t) * t : i * 3 + 1 >> 2,
                r = new Uint8Array(s);
            for (var o, n, h = 0, l = 0, c = 0; c < i; c++) {
                n = c & 3;
                h |= this.b64ToUint6(a.charCodeAt(c)) << 18 - 6 * n;
                if (n === 3 || i - c === 1) {
                    for (o = 0; o < 3 && l < s; o++, l++) {
                        r[l] = h >>> (16 >>> o & 24) & 255
                    }
                    h = 0
                }
            }
            return r
        },
        upload: function(e, t, a) {
            var i = this.params.upload_name || "webcam";
            var s = "";
            if (e.match(/^data\:image\/(\w+)/)) s = RegExp.$1;
            else throw "Cannot locate image format in Data URI";
            var r = e.replace(/^data\:image\/\w+\;base64\,/, "");
            var o = new XMLHttpRequest;
            o.open("POST", t, true);
            if (o.upload && o.upload.addEventListener) {
                o.upload.addEventListener("progress", function(e) {
                    if (e.lengthComputable) {
                        var t = e.loaded / e.total;
                        Webcam.dispatch("uploadProgress", t, e)
                    }
                }, false)
            }
            var n = this;
            o.onload = function() {
                if (a) a.apply(n, [o.status, o.responseText, o.statusText]);
                Webcam.dispatch("uploadComplete", o.status, o.responseText, o.statusText)
            };
            var h = new Blob([this.base64DecToArr(r)], {
                type: "image/" + s
            });
            var l = new FormData;
            l.append(i, h, i + "." + s.replace(/e/, ""));
            o.send(l)
        }
    };
    Webcam.init();
    if (typeof define === "function" && define.amd) {
        define(function() {
            return Webcam
        })
    } else if (typeof module === "object" && module.exports) {
        module.exports = Webcam
    } else {
        e.Webcam = Webcam
    }
})(window);
