(function ($) {

    $.fn.hidetoinput = function (opts) {
        var self = this;

        pt=$(this).val().split(',');

        for(t in pt)
            if (pt[t]!='') $(opts.inputs +'[tag='+pt[t]+']').attr('checked',true)

        return this.each(function () {
            $(opts.inputs).change(function()
            {

                res = [];
                $(opts.inputs).each(function () {
                    switch ($(this).attr('type')) {
                        case 'checkbox':
                            if ($(this).is(':checked')) {
                                if (v = getInputValue(this)) {
                                    res.push(v);
                                }
                            }
                            break;
                    }
                })
                //alert(res.join(','))
                $(self).val(res.join(','))
            })

        });

        function getInputValue(w){
            if (tag = $(w).attr('tag')) return tag;
            return false;
        }
    };

}(jQuery));