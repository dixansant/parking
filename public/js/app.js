String.prototype.indexPart = function (index, separ) {
    index = index || 0;
    separ = separ || ',';
    var pt = this.split(separ);
    return pt[index];
}

var querys = {};


var failed = {
    'register': function (j) {
        m = '';
        for (t in j.errors) m += `&#9679; ${j.errors[t]}<br>`
        toastr.error(m, j.message)
        grecaptcha.reset();
    }
}; // array of failed forms

$(function () {



    //alert(location.href)
    /*Eventos de Document*/

    $(document).on('reset', 'FORM', function () {
        if ($(this).attr('addquery') == 'true') {
            remove_querys($(this).serializeFormJSON());
        }

    }).on('submit', 'FORM', function (e) { // cuando se envia un formulario, que sea por ajax
            if ($(this).attr('enctype') != null) return true; // para que se envie los adjuntos
            btx = $(':focus').get(0);
            check_alert(btx); // si el boton presionado tiene alert...
            if ($(btx).attr('confirm')) { // hay que confirmar
                check_confirm(btx);
                return false;
            }
            // ver si hay validacion en el boton que se presionó
            if (ex = $(this).find('[name="g-recaptcha-response"]')) {
                if (ex.val() == '') {
                    toastr.warning('Please check Captcha field', 'Captcha...')
                    return false;
                }
            }

            if ($(this).attr('addquery') == 'true') {
                add_query($(this).serializeFormJSON());
            } else {


                _ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: $(this).attr('method') || 'POST',
                    failed: $(this).attr('failed')
                })
            }


            return false;
        }
    ).on('click', 'BUTTON.close', function (event) { // para los modales
        $(this).parents('.modal').prop('target', this);
    }).on('click', '.modal BUTTON[type]', function () {
        $(this).parents('.modal').prop('target', this);
    }).on('hide.bs.modal', '.modal', function (event) {

        //Evitar que se cierre el modal si es fijo

        $target = $($(this).prop('target'));
        if ($target.get(0) == null && $(this).attr('fixed') == "1" && $(':focus').parents('.modal').get(0) != this)
            event.preventDefault();

    }).on('hidden.bs.modal', '.modal', function (event) {

        $target = $($(this).prop('target'));
        bk = $(this).attr('back');
        war_remove_q = remove_querys('dialog');
        no_actions = $target.is('.close') || $target.get(0) == null;

        if (no_actions) {
            if (war_remove_q) ; // era un query (dialog) no hay que hacer nada
            else {
                if ($(this).attr('reference') == get_path()) { // uri es mi reference

                    goHome(bk);
                }
            }
        }
        if ($(this).attr('autoremove'))  // es un dialog que se elimina solo
            $(this).remove();

        $(this).prop('target', null); // vaciar la prop

    }).on('click', '[type=submit]', function () { /* No permitir envio de formulario si esta desabilitado*/
        if ($(this).is('.disabled')) return false;
    }).on('click', '[href]', function () { // CLICK EN UN HREF



        if ($(this).attr('href').indexOf('javascript:') != -1) return;
        check_alert(this);

        if ($(this).attr('confirm')) {
            check_confirm(this);
            return false;
        } else {
            return hrefaction.call(this)
        }

    }).on('change', '.fileupload', function () {
        $form = $(this).parents('form');
        //console.log($form.length)
        $form.submit();
        //console.log("-->"+$(form).attr('action'))

    });

    $(window).on('hashchange', function (e) {
        relocate(location.href)
    });

    $(window).trigger('hashchange')

    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 3000
    };


    /* MENU */

    //dropdown-menu-content


    // evitar que al dar click en el contenido de un menu
    // se oculte

    $('.dropdown-menu-content').click(function(e){
        if($(':focus[href]').get(0)==null)
        e.stopPropagation();
    })


    $('.dropdown-submenu A').click(function (e) {
       li=$(this).parent();
        li.toggleClass('open');
        if (li.find('UL').length>0) {
            li.find('LI').removeClass('open')
            e.stopPropagation();
            return false;
        }
    })


    checkQuery();



});


/* chequea si un obj tiene confirm y la muestra*/
function check_confirm(self) {

    confirm = $(self).attr('confirm');

    var info = getconfirm(confirm)
    $.alertly({
        title: info.title,
        content: info.content,
        buttons: [
            {}, // cancel button
            {
                caption: info.caption || 'OK',
                type: 'primary',
                handle: function () {
                    if (info.onconfirm != null) info.onconfirm.call(self);
                    if ($(self).attr('href')) hrefaction.call(self)
                }
            }
        ]
    });

    //return true;
}

/* chequea si un obj tiene alerta y la muestra*/
function check_alert(w) {
    if (_alert = $(w).attr('alert')) {
        setTimeout(function () {
            $.alertly({
                title: alerts[_alert].title,
                content: alerts[_alert].content,
                buttons: [
                    {
                        caption: 'OK',
                        type: 'primary'
                    }
                ]
            });

            if (alerts[_alert].onrun != null) alerts[_alert].onrun()
        }, 1)
    }
}


var lasthref = null

function hrefaction(isValidate) {

    if (isValidate == null) {

        if (toValidate = $(this).attr('validate')) {
            //alert(toValidate)
            if (tovalidate = validations[toValidate]) {
                if (tovalidate.call(this)) hrefaction.call(this, true);
                return false;
            }

        }
    }



    $(this).parents('.modal').prop('target', this);

    if ($(this).attr('data-toggle')) return;
    href = $(this).attr('href');
    lasthref = href

    if (tovalidate = validations[href]) {
        tovalidate.call(this);
        return false;
    }

    if (href.indexOf('¡') == 0) {   // es lenguaje
        changeLang(href);           // en fnts.js
        return false;
    }

    if (href.indexOf('?') == 0) { // es local
        j = get_query(href);
        add_query(j);
        return false;
    }

    if (href.indexOf('!') == 0) { // llamada ajax

        //alert(get_query())
        _ajax({
            //data: get_query(),
            url: href.substr(1)
        })

        $('.open').removeClass('open'); //
        return false;
    }


    if (href.indexOf('http://') == 0 || href.indexOf('https://') == 0) {
        bp = href.split(base_path + "/home");
        href = bp[1];

    }


    if (href.indexOf('http://') == -1 && href.indexOf('https://') == -1) {
        if (href.indexOf('#') == 0) {
            if (href.indexOf('#!') != 0)
                href = href.substr(1)
        } else if (href.indexOf('/') != 0) {
            href = "/" + href
        }
        href = '#!/home' + href
        if (href.substr(href.length - 1) == "/") href = href.substr(0, href.length - 1)


        location.href = href;
        return false;
    }
}


function goHome(uri) {
    if (uri == '-1') {
        window.history.back();
    } else {

        uri = uri || '#!/home';
        location.href = uri;
    }
}


function relocate(xh) {

    $('.alertly-bg').remove();

    xh = xh.split('?');
    lh = xh[0];

    bp = lh.split(base_path);


    var ph = bp[1].split('/');


    ph[1] = (ph[1] == '#' || ph[1] == '') ? '#!' : ph[1]


    if (ph[1] != '#!' && ph[1].substr(0, 1) != '#') {
        ph[1] = '#!/home/' + ph[1];
    }
    else if (ph[1].substr(0, 1) == '#' && ph[1] != '#!') {
        return; // nada que hacer
    }

    else if (ph[2] == null) {
        ph[2] = 'home'
    }
    else if (ph[2] != 'home') {
        ph[2] = 'home'

    }




    //var go = base_path + ph.join('/')+(xh[1]?'?'+xh[1]:'')
    var go = base_path + ph.join('/')



    if (go == lh) {

        showscene(lh)

        $('[autoexpired="1"]').each(function () {

            $(this).remove();

            if (!$(this).is(':visible')) {
                //sceneExpired(this)
                $(this).attr({autoexpired: '0'});
            }
        })

        return;
    } else {



        //return
        checkQuery()



        //alert(go + ' ' + lh + " "+1)


        location.href = go;


    }


}


function get_path() {
    var pt = location.href.split('#!')
    r = (pt[1]) ? pt[1] : '';
    pt = r.split('?');
    return pt[0]
}


function showscene(w, load = true) {

    $('.modal:visible').modal('hide');


    var pt = w.split('#!')
    var pt = pt[1].split('?')


    //alert(pt[0])

    if (exist = $('[reference="' + pt[0] + '"]').get(0)) { // existe
        if ($(exist).is('.scene')) { // es scene
            $('.scene').hide();

            if (!$(exist).is(":visible")) {
                $(exist).show()

            }
        } else if ($(exist).is('.modal')) { // es modal

            if (!$(exist).is(":visible")) {
                $(exist).modal('show')
                href = $(exist).attr('reference')
                qry = $(exist).attr('forward') || ''

                //alert('qry ='+qry )
                href += (qry == '') ? '' : '?forward=' + qry;

                if ($(exist).attr('relative')) {
                    return;
                }
                else {
                    location.href = '#!' + href
                    $('.scene').hide();
                }

            }

        }

        checkQuery();
        return;
    }


    if (load) loadscene(pt)


    //else alert(pt[0])
}


function loadscene(w) {

    u = w[0] + (w[1] ? '?' + w[1] : '')

    _ajax({
        url: u
    })
}

function _ajax(j) {


    url = (j.url.indexOf('http://') == 0 || j.url.indexOf('https://') == 0) ? j.url : base_path + j.url


    if (j.loading != false) $('.loading').show().fadeTo(200, 1)
    $.ajax({
        type: j.type || 'GET',
        data: j.data || [],
        url: url,
        success: function (w) {
            $j = $(w);

            $j.find('.partial').each(function () {


                self = this
                checkFamily(this)

                ex = $('#' + $(self).attr('id')).get(0);
                prev = false;
                prn = null;
                if (ex != null) { // existe
                    prn = $(ex).parent();
                    self = $(this).clone(true);
                    prev = $(ex).prev().get(0);
                    $(this).remove();
                    if ($(ex).is('.requireonce')) {
                        return;
                    }

                    //console.log($(self).attr('id') + " " +prev.get(0));
                }

                $(ex).remove();
                var prn = prn ? prn : $(self).attr('parent');
                prnobj = (prn) ? prn : document.body


                if (prn == null || (prn != null && $(prn).get(0) != null)) {

                    if (prev == false)
                        $(prnobj).append(self);
                    else {
                        if (prev == null)
                            $(prnobj).prepend(self);
                        else
                            $(prev).after(self);

                    }


                } else {
                    if ($(self).parent().is('.partial')) $(self).remove();
                }

            })


            if (rfrc = $j.attr('reference')) { // si viene una scena o modal
                checkFamily($j)
                $('[reference="' + rfrc + '"]').remove()
                parent = $($j.attr('parent')).get(0) || ($j.is('.scene') ? $('#scenes').get(0) : document.body)
                $(parent).append($j)
                showscene('#!' + rfrc, false);
            }

            create_help_ballons(); // crear botones de ayudas en los formularios traidos
            $('.loading').fadeTo(200, 0, function () {
                $(this).hide();
            })

            enability();
        }, error: function (e) {

            _j = e.responseJSON
            o = true
            if (j.failed) if (fn = failed[j.failed]) {
                fn(_j);
                o = false
            }
            if (o) {
                t = _j.message || 'Some was wrong';
                m = 'Please check your information';
                toastr.error(m, t)
                //window.history.back();
            }

            $('.loading').fadeTo(500, 0, function () {
                $(this).hide();
            })
        }
    })
}


function checkFamily(self) {

    if (fml = $(self).attr('family')) {

        console.log('trae family: ' + fml);

        $('[family="' + fml + '"]').each(function () {
            console.log('expira: ' + $(this).attr('ref'));
            sceneExpired(this)
        });
    }
}

/* Modulo para escenas expiradas */
function sceneExpired(w) {
    $ff = $(w);
    $html = $($("[reference='errortemplate']").html());

    //console.log($("[reference='errortemplate']").html());

    $html.find('.link').html($ff.attr('reference'));
    $ff.html($html);
}

function deleteExcept(w) {

    $('#matches').html(w.length)
    o = [];
    for (t in w) o.push('card_' + w[t])

    $('.profile').each(function () {
        $(this).remove();
    })
}


function location_query(w, force, modify) {
    j = get_query(w);
    add_query(j, modify);
    if (force) checkQuery();
    refreshGraphics();
}

querys['dialog'] = function () {
    j = get_query();
    showscene('#!/' + j.dialog.substr(1));// + "?ID=" + btoa(get_query(location.href, true)))
    return true; // para que no ejecute mas ninguna querys

}


querys['page'] = function () {

    j =

    pt=location.href.split('#!/');


    _ajax({
        url: '/'+pt[1] ,

        type: 'get'
    })
}

function get_query(q, path) {

    q = (q) ? q : location.href
    q = q.split('?');
    if (path) return q[0];

    q[1] = (q[1]) ? q[1] : '';
    q = q[1].split('&');
    j = {};

    for (t in q) {
        if (q[t]) {
            pt = q[t].split('=')
            vr = pt.shift();
            j[vr] = pt.join('=');
        }
    }

    return j;
}

function add_query(j, force) {

    hr = location.href
    q = get_query();

    for (t in j) {
        if (force == null || (force == false && q[t] == null))
            q[t] = j[t];
        else {
            console.log(force + " " + q[t])
        }
    }

    set_query(q);
}


function set_query(q) {
    hr = location.href
    r = '?'
    for (var t in q)
        r += ((r == '?') ? '' : '&') + (t + "=" + q[t]);

    location.href = get_query(hr, true) + r;
}

function remove_querys(q_name) {
    arr = [];
    if (typeof q_name == 'string') {
        arr = [q_name]
    } else {
        for (t in q_name) {
            arr.push(t)
        }
    }
    ex = false;
    q = get_query();
    r = '?'
    for (t in q) {
        if (arr.indexOf(t) == -1)
            r += ((r == '?') ? '' : '&') + (t + "=" + q[t]);
        else ex = true;
    }

    if (ex) location.href = get_query(null, true) + ((r == '?') ? '' : r);
    return ex;
}

// esta funcion chequea las funciones para los query
// las ordena de ultimas a primera
// si existe la ejecuta
// si devuelve true no ejecuta mas ninguna

function checkQuery() {
    q = get_query();

    reverse = [];

    for (t in q) {
        if (querys[t])
            reverse.unshift([querys[t], q[t]]);
        //if (querys[t](q[t])) break;
    }

    for (t in reverse)
        if (reverse[t][0](reverse[t][1])) return true;

    return false;

}


function create_help_ballons() {
    $('[help-content]').each(function () {

        $next = $(this).next()
        if (!$next.is('.help-ballon')) {
            helpc = $(this).attr('help-content');
            html = `<label class="help-ballon" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="${helpc}"></label>`;
            $(html).insertAfter(this)
        }
    })
    $('[data-toggle="popover"]').popover();
}


/* selections */

function in_my_team(id, w) {
    if (w) {
        $('#card_' + id + ' .the-actions .btn-warning').addClass('hidden')
        $('#card_' + id + ' .the-actions .btn-default').removeClass('hidden')
    } else {
        $('#card_' + id + ' .the-actions .btn-success').removeClass('hidden')
        $('#card_' + id + ' .the-actions .btn-default').addClass('hidden')
        $('.ccard_' + id).remove();
    }
}

function totalInMyTeam(w) {

    $('.tot-memb').each(function () {
        if (w === "-1") w = parseInt($(this).html()) - 1;
        if (w === "+1") w = parseInt($(this).html()) + 1;
        $(this).html(w)
        $('.member-a').html(_member + ((w == 1) ? '' : 's'))
        number_effect(this)
    })

}


function number_effect(w) {

    num = $(w).html();
    os = $(w).offset()

    left = os.left;
    _top = os.top;

    $(document.body).append(`<div class="effect1" style=";left:${left}px;top:${_top}px">${num}</div>`)
    $(".effect1").animate({
        opacity: '0',
        'font-size': '60px',
        'margin-left': '-10px',
        'margin-top': '-28px'
    }, function () {
        $(this).remove();
    });

}

/* se usa en los selectpickers que los options tienen href*/
function runActionMode(w, q) {
    $(w.options[w.selectedIndex]).trigger('click');
    //if (q==null) {
    w.selectedIndex = 0;

    //if (fix = $(w).attr('fixed')) {
        //$('.selectpicker').selectpicker('val', fix);
    //}


    //}
    //console.log("---->" + q)
}

hwn = [];

function enability() {

    /*$('[editable="1"] INPUT').removeAttr('disabled')
    $('[editable="0"] INPUT').attr('disabled', 'disabled')
    $('[editable="1"] SELECT').removeAttr('disabled').selectpicker('refresh')
    $('[editable="0"] SELECT').attr('disabled', true).selectpicker('refresh')*/


    for (t in hwn) clearInterval(hwn[t])

    if ($('.cronom:visible').length != 0) {

        console.log('entro')

        hwn[hwn.length] = setInterval(() => {


            $('.cronom').each(function () {
                today = new Date();
                total = parseInt((parseInt($(this).attr('enddate')) - today.getTime()) / 1000);
                sec = (total % 60);
                min = parseInt(total / 60);
                hrs = parseInt(min / 60);
                min = (min % 60);

                falta = hrs + ':' + ('0' + min).slice(-2) + ':' + ('0' + sec).slice(-2)
                $(this).html(falta);

                console.log(falta)
                //$(this).html(myDate)
            })
        }, 1000)
    }


}


/* Borra todas las scenas, al salir o entrar al sistema */
function clearScenes(except) {
    $('.scene[reference], .modal[reference]').each(function () {
        ref = $(this).attr('reference');
        //if (ref != '/home' && ref != '/home/logout' && ref != 'errortemplate' $$ ref!=current)
        if (ref != '/home/logout' && ref != 'errortemplate' && ref != except) {
            //if ($(this).is('.modal') && $(this).is(':visible')) $(this).remove();  //$(this).prop('target',true).modal('hide')
            if ($(this).is('.modal')) $('.modal-backdrop').hide();  //$(this).prop('target',true).modal('hide')
            $(this).remove();
        }
    });
}