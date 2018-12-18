$.fn.required = function() {

    return this.each(function() {
        $(this).find('INPUT[required]').each(function(){
            id=$(this).attr('id')
            //console.log($('label[for='+id+']').length )
           $('label[for="'+id+'"]').after('<req></req>')
        })
    });

};