(function() {
    JSLINQ = window.JSLINQ = function(a) {
        return new JSLINQ.fn.init(a)
    };
    JSLINQ.fn = JSLINQ.prototype = {
        init: function(a) {
            this.items = a
        },
        jslinq: "2.10",
        ToArray: function() {
            return this.items
        },
        Where: function(d) {
            var c;
            var a = new Array();
            for (var b = 0; b < this.items.length; b++) {
                if (d(this.items[b], b)) {
                    a[a.length] = this.items[b]
                }
            }
            return new JSLINQ(a)
        },
        Select: function(d) {
            var c;
            var a = new Array();
            for (var b = 0; b < this.items.length; b++) {
                if (d(this.items[b])) {
                    a[a.length] = d(this.items[b])
                }
            }
            return new JSLINQ(a)
        },
        OrderBy: function(c) {
            var b = new Array();
            for (var a = 0; a < this.items.length; a++) {
                b[b.length] = this.items[a]
            }
            return new JSLINQ(b.sort(function(f, e) {
                var d = c(f);
                var g = c(e);
                return ((d < g) ? -1 : ((d > g) ? 1 : 0))
            }))
        },
        OrderByDescending: function(c) {
            var b = new Array();
            for (var a = 0; a < this.items.length; a++) {
                b[b.length] = this.items[a]
            }
            return new JSLINQ(b.sort(function(f, e) {
                var d = c(e);
                var g = c(f);
                return ((d < g) ? -1 : ((d > g) ? 1 : 0))
            }))
        },
        SelectMany: function(c) {
            var b = new Array();
            for (var a = 0; a < this.items.length; a++) {
                b = b.concat(c(this.items[a]))
            }
            return new JSLINQ(b)
        },
        Count: function(a) {
            if (a == null) {
                return this.items.length
            } else {
                return this.Where(a).items.length
            }
        },
        Distinct: function(d) {
            var b;
            var e = new Object();
            var c = new Array();
            for (var a = 0; a < this.items.length; a++) {
                b = d(this.items[a]);
                if (e[b] == null) {
                    e[b] = true;
                    c[c.length] = b
                }
            }
            e = null;
            return new JSLINQ(c)
        },
        Any: function(b) {
            for (var a = 0; a < this.items.length; a++) {
                if (b(this.items[a], a)) {
                    return true
                }
            }
            return false
        },
        All: function(b) {
            for (var a = 0; a < this.items.length; a++) {
                if (!b(this.items[a], a)) {
                    return false
                }
            }
            return true
        },
        Reverse: function() {
            var b = new Array();
            for (var a = this.items.length - 1; a > -1; a--) {
                b[b.length] = this.items[a]
            }
            return new JSLINQ(b)
        },
        First: function(a) {
            if (a != null) {
                return this.Where(a).First()
            } else {
                if (this.items.length > 0) {
                    return this.items[0]
                } else {
                    return null
                }
            }
        },
        Last: function(a) {
            if (a != null) {
                return this.Where(a).Last()
            } else {
                if (this.items.length > 0) {
                    return this.items[this.items.length - 1]
                } else {
                    return null
                }
            }
        },
        ElementAt: function(a) {
            return this.items[a]
        },
        Concat: function(b) {
            var a = b.items || b;
            return new JSLINQ(this.items.concat(a))
        },
        Intersect: function(g, i) {
            var h;
            if (i != undefined) {
                h = i
            } else {
                h = function(j, b, a, k) {
                    return j == a
                }
            }
            var e = g.items || g;
            var d = new Array();
            for (var f = 0; f < this.items.length; f++) {
                for (var c = 0; c < e.length; c++) {
                    if (h(this.items[f], f, e[c], c)) {
                        d[d.length] = this.items[f]
                    }
                }
            }
            return new JSLINQ(d)
        },
        DefaultIfEmpty: function(a) {
            if (this.items.length == 0) {
                return a
            }
            return this
        },
        ElementAtOrDefault: function(b, a) {
            if (b >= 0 && b < this.items.length) {
                return this.items[b]
            }
            return a
        },
        FirstOrDefault: function(a) {
            return this.First() || a
        },
        LastOrDefault: function(a) {
            return this.Last() || a
        }
    };
    JSLINQ.fn.init.prototype = JSLINQ.fn
})();
