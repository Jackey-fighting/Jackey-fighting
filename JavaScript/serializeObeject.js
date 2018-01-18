/*
    要使用的时候直接引入这个js，直接调用，获取表单值并最终转化成 string类型的JSON
    var json = $('form').serializeObject(); //这样就获得了json数据
    json = JSON.stringify(json); //string 化json;
*/
$.fn.serializeObject = function()
            {
                var o = {};
                var a = this.serializeArray();
                $.each(a, function() {
                    if (o[this.name] !== undefined) {
                        if (!o[this.name].push) {
                            o[this.name] = [o[this.name]];
                        }
                        o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                });
                return o;
};
