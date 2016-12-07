(function ($) {
    var ms = {
        init: function (obj, args) {
            return (function () {
                ms.fillHtml(obj, args);
                ms.bindEvent(obj, args);
            })();
        },
        //填充html
        fillHtml: function (obj, args) {
            return (function () {
                obj.empty();
                obj.append('<a href="javascript:;" class="firstPage">首页</a>');//首页
                //上一页
                if (args.current > 1) {
                    obj.append('<a href="javascript:;" class="prevPage">上一页</a>');
                } else {
                    obj.remove('.prevPage');
                    obj.append('<span class="disabled">上一页</span>');
                }
                //中间页码
                if (args.current != 1 && args.current >= 4 && args.pageCount != 4) {
                    obj.append('<a href="javascript:;" class="tcdNumber">' + 1 + '</a>');
                }
                if (args.current - 2 > 2 && args.current <= args.pageCount && args.pageCount > 5) {
                    obj.append('<span>...</span>');
                }
                var start = args.current - 2,
					end = args.current + 2;
                if ((start > 1 && args.current < 4) || args.current == 1) {
                    end++;
                }
                if (args.current > args.pageCount - 4 && args.current >= args.pageCount) {
                    start--;
                }
                for (; start <= end; start++) {
                    if (start <= args.pageCount && start >= 1) {
                        if (start != args.current) {
                            obj.append('<a href="javascript:;" class="tcdNumber">' + start + '</a>');
                        } else {
                            obj.append('<span class="current">' + start + '</span>');
                        }
                    }
                }
                if (args.current + 2 < args.pageCount - 1 && args.current >= 1 && args.pageCount > 5) {
                    obj.append('<span>...</span>');
                }
                if (args.current != args.pageCount && args.current < args.pageCount - 2 && args.pageCount != 4) {
                    obj.append('<a href="javascript:;" class="tcdNumber">' + args.pageCount + '</a>');
                }
                //下一页
                if (args.current < args.pageCount) {
                    obj.append('<a href="javascript:;" class="nextPage">下一页</a>');
                } else {
                    obj.remove('.nextPage');
                    obj.append('<span class="disabled">下一页</span>');
                }
                obj.append('<a href="javascript:;" class="lastPage">尾页</a>');//尾页
                //obj.append('<a class="go_search">GO</a>');
                //obj.append('<input type="number" min="0" max="' + args.pageCount + '" class="search-input">');
            })();
        },
        //绑定事件
        bindEvent: function (obj, args) {
            return (function () {
                obj.unbind("click");
                $('.search-input').val(parseInt($('.current').html()))
                obj.on("click", "a.firstPage", function () {
                    var current = parseInt(obj.children("span.current").html());
                    ms.fillHtml(obj, {
                        "current": 1,
                        "pageCount": args.pageCount
                    });
                    if (typeof (args.backFn) == "function") {
                            args.backFn(1);
                    }
                    $('.search-input').val(parseInt(1))
                })
                obj.on("click", "a.lastPage", function () {
                    var current = parseInt(obj.children("span.current").html());
                    ms.fillHtml(obj, {
                        "current": args.pageCount,
                        "pageCount": args.pageCount
                    });
                    if (typeof (args.backFn) == "function") {
                        args.backFn(args.pageCount);

                    }
                    $('.search-input').val(parseInt(args.pageCount))
                })
                obj.on("click", "a.tcdNumber", function () {
                    var current = parseInt($(this).html());
                    ms.fillHtml(obj, {
                        "current": current,
                        "pageCount": args.pageCount
                    });
                    if (typeof (args.backFn) == "function") {
                        args.backFn(current);

                    }
                    $('.search-input').val(parseInt($('.current').html()))
                });
                obj.on("click", "a.go_search", function () {
                    var current = parseInt($('.search-input').val());
                    if (current != '' && current != 0 && current != null && current <= args.pageCount && current > 0) {
                        ms.fillHtml(obj, {
                            "current": current,
                            "pageCount": args.pageCount
                        });
                        if (typeof (args.backFn) == "function") {
                            args.backFn(current);

                        }
                        $('.search-input').val(parseInt($('.current').html()))
                    } else {
                        alert(' _(:зゝ∠)_\n大人，页数输错啦！');
                        $('.search-input').val('');
                    }
                });
                //上一页
                obj.on("click", "a.prevPage", function () {
                    var current = parseInt(obj.children("span.current").html());
                    ms.fillHtml(obj, {
                        "current": current - 1,
                        "pageCount": args.pageCount
                    });
                    if (typeof (args.backFn) == "function") {
                        args.backFn(current - 1);

                    }
                    $('.search-input').val(parseInt($('.current').html()))
                });
                //下一页
                obj.on("click", "a.nextPage", function () {
                    var current = parseInt(obj.children("span.current").html());
                    //					alert(current);
                    ms.fillHtml(obj, {
                        "current": current + 1,
                        "pageCount": args.pageCount
                    });
                    if (typeof (args.backFn) == "function") {
                        args.backFn(current + 1);

                    }
                    $('.search-input').val(parseInt($('.current').html()))
                });
            })();
        }
    }
    $.fn.createPage = function (options) {
        var args = $.extend({
            pageCount: 10,
            current: 1,
            backFn: function () { }
        }, options);
        ms.init(this, args);
    }
})(jQuery);