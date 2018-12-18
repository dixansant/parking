@extends('layouts.scene')
@section('content_scene')
    @php($level=[])
    <div class="row dragdrop">

        <div class="col-md-6">
            <div class="col-md-12">
                <a class="btn btn-default" onclick="newMenu()">{{ __('admin.new_menu') }}</a>
                <hr>
            </div>
            <div class="col-md-6">
                @include('owner.mnubuilder.treeview')
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <a id="saveForm" class="btn btn-default disabled"
                   onclick="$('#mnuForm').submit()">{{ __('admin.save_menu') }}</a>
                <hr>
            </div>
            <div class="col-md-12">
                @include('owner.mnubuilder.form')
            </div>

            <ul>
                @foreach($menus as $family=> $menues)
                    @foreach($menues as $k=>$mnu)
                        <li>{{$mnu->id}} {{$mnu->title}} <b>{{$mnu->parent}}</b></li>
                    @endforeach
                @endforeach
            </ul>


        </div>

    </div>


    </div>

    <ul id="dropmenu" style="display: none; position: absolute;">
        <li>
            <div action="movehere">Move Here...</div>

        </li>
        <li>
            <div action="createref">Create Reference...</div>
        </li>

    </ul>

    <ul id="contextmenu" style="display: none; position: absolute;">
        <li>
            <div action="remove">Remove</div>
        </li>
    </ul>


    <script>


        $(document).on('click', '.item', function () {

            // validar si es una referencia
            if (itemref = $(this).attr('itenref')) {
                $('#item_' + itemref).trigger('click')
                return;
            }

            $('.cursel').removeClass('cursel');
            $(this).parent().addClass('cursel')

            if (data = $(this).attr('data')) {

                base = atob(data)
                j = $.parseJSON(base);

                $('#mnuForm').get(0).reset()
                $('#mnuForm input:checkbox').attr('checked',false)
                $('#mnuForm input').each(function () {

                    nme = $(this).attr('name');
                    if (j[nme]) {
                        switch ($(this).attr('type')) {
                            case 'checkbox':
                                $(this).attr('checked', (j[nme] == '1'))
                                break

                            default:
                                $(this).val(j[nme])
                        }
                    }

                })

                $('#saveForm').removeClass('disabled')
            }


        }).on('mousedown', function (e) {

            if (action = $(e.target).attr('action')) {
                actions[action].call(e.target)
                $('.ui-menu:visible').hide();
            }

            //if ($(e.target).is('.item, [action]')) return;
            removeClasses()
            $('.animated').removeClass('animated');
            $('.ui-menu:visible').hide();

            console.log('bye')
        });

        var actions = {
            'movehere': function () {
                $dest = $('.curdrop');

                if ($('.dragitem').find($fater).get(0) != null) {
                    return;
                }

                $next = $('.dragitem > A').parent().next();
                $dest.after($next);
                $dest.after($('.dragitem > A').parent())

                reorder($('.dragitem > A').attr('ref'),$dest.attr('dest'))
            },

            'createref': function () {
                $fater = $('.curdrop');

                if ($('.dragitem').find($fater).get(0) != null) return;


                $next = $('.dragitem').next().clone();


                $fater.after($next);
                draganddrop.call($next.find('A'))

                li = $('.dragitem > A').parent().clone();
                li.find('ul').remove()
                a = li.find('.item')
                id = a.attr('ref');
                a.removeAttr('ref').removeAttr('data').attr('refered', id)
                a.addClass('itemref').addClass('animated').addClass('flash')

                draganddrop.call(a)
                $fater.after(li)
                reorder()
            },

            'remove': function () {

                _ajax({
                    type: 'post',
                    data: {
                        _token : '{{ csrf_token() }}',
                        item : $('.item-sel').attr('ref'),
                    },
                    url : '{{ route('admin.removemenu',[],false) }}'
                })
            },

            'droppable': {
                over: function (event, ui) {
                    if ($('.lastdrag').get(0) != this) {
                        $('.lastdrag').removeClass('lastdrag');
                        $(this).parent().addClass('lastdrag');
                    }
                },
                accept: '.item',
                hoverClass: 'overme',

                drop: function (ev, ui) {

                    $fater = $(this).parent().is('.last') ? $(this).parent() : $('.first:visible');
                    $fater.find('A').trigger('dragonme')


                }
            },

            'dragable': {
                helper: 'clone',
                start: function (event, ui) {
                    $(this).parent().addClass('dragitem')
                },
                stop: function () {
                    if ($('.ui-menu:visible').get(0) == null)
                        removeClasses()

                },
            },
            'contextmenu': function () {
                p = $(this).offset();
                $(this).addClass('item-sel')
                $("#contextmenu").css({
                    display: '',
                    left: (p.left + $(this).width()) + 'px',
                    top: (p.top) + 'px'
                }).menu({})
                event.preventDefault();

                return false;

            }

        }

        draganddrop.call($('.item'))


        function reorder(item, dest){
            console.log(item)
            console.log(dest)
            dev=[];

            $('A[ref]').each(function(){
                dev.push($(this).attr('ref'));
            })

            _ajax({
                type: 'post',
                data: {
                    _token : '{{ csrf_token() }}',
                    item : item,
                    dest : dest,
                    order : dev.join(',')
                },
                url : '{{ route('admin.movemenu',[],false) }}'
            })
        }

        function draganddrop() {
            $(this).contextmenu(
                actions.contextmenu
            ).draggable(
                actions.dragable
            ).droppable(
                actions.droppable
            ).on('dragonme', function (e) {


                $(this).parent().addClass('curdrop')
                $('.lastdrag').removeClass('lastdrag');
                p = $(this).offset();
                $("#dropmenu").css({display: '', left: (p.left + $(this).width()) + 'px', top: (p.top) + 'px'}).menu({})


            })
        }

        function newFamily() {
            $newli = $('<li><a class="item animated flash">New Menu</a>\n' +
                '<ul>\n' +
                '<li class="first">\n' +
                '<a class="item">&nbsp;</a>\n' +
                '</li></ul></li><li class="last">\n' +
                '<a class="item">&nbsp;</a>\n' +
                '</li>');

            $('#item_0').append($newli)
            draganddrop.call($newli.find('A'))
        }

        function removeClasses() {
            $('.lastdrag').removeClass('lastdrag');
            $('.curdrop').removeClass('curdrop');
            $('.dragitem').removeClass('dragitem');
            $('.item-sel').removeClass('item-sel');
        }

        function newMenu(){
            _ajax({
                type: 'post',
                data: {
                    _token : '{{ csrf_token() }}',
                    parent : $('.cursel A').attr('ref'),
                },
                url : '{{ route('admin.newmenu',[],false) }}'
            })
        }
    </script>
    <style>

        .dragdrop A {
            cursor: pointer;
        }

        .dragitem > A {
            border: 1px solid #ddd;
            border-radius: 4px;
            opacity: 0.5;
        }

        .dragdrop .last, .dragdrop .first {
            display: none;

        }

        .first A, .item-sel {
            background: #eee;
            display: inline-block;
            min-width: 100px;
            margin-right: 10px;
        }

        .cursel > A {
            background-color: #bfdff9;
            display: inline-block;
            min-width: 100px;
        }

        .last A {
            display: inline-block;
            width: 100px;
        }

        .lastdrag + LI.last, .lastdrag > UL > .first {
            display: list-item !important;
        }

        .curdrop {
            display: list-item !important;
        }

        .last :before {
            padding: 0px 3px;
            border: 1px dashed #276cbc;
            content: 'Drop Here';
            position: absolute;
            font-size: 10px;
        }

        .item.hovering {
            background: #b6d6fb;
            border: 1px dashed #276cbc;
        }

        .ui-menu-item {
            white-space: nowrap;
            min-width: 140px;
        }

        /* es una referencia */
        .itemref {
            background-color: #eaedce;
            padding-left: 14px;
            padding-right: 4px;
        }

        .itemref:before {
            content: '@';
            font-size: 10px;
            position: absolute;
            margin-left: -10px;
            margin-top: 2px;
        }

        #ul_menu, #ul_menu UL {
            padding-left: 20px;
        }

        #ul_menu LI {
            list-style: none;
            padding: 4px;
            white-space: nowrap;
        }

        /* TREE VIEW*/

        div.treeview {
            min-width: 100px;
            min-height: 100px;

            max-height: 256px;
            overflow: auto;

            padding: 4px;

            margin-bottom: 20px;

            border-radius: 4px;
        }

        div.treeview ul:first-child:before {
            display: none;

        }

        .treeview, .treeview ul {
            margin: 0;
            padding: 0;
            list-style: none;

        }

        .treeview ul {
            margin-left: 1em;
            position: relative
        }

        .treeview ul ul {
            margin-left: .5em
        }

        .treeview ul:before {
            content: "";

            display: block;
            width: 0;
            position: absolute;
            top: 0;
            left: 0;
            border-left: 1px dashed #ccc;

            /* creates a more theme-ready standard for the bootstrap themes */
            bottom: 15px;
        }

        .treeview li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            font-weight: 700;
            position: relative
        }

        .treeview ul li:before {
            content: "";
            display: block;
            width: 20px;
            height: 0;
            border-top: 1px dashed #ccc;
            margin-top: -1px;
            position: absolute;
            top: 18px;
            left: -20px

        }

        .tree-indicator {
            margin-right: 5px;

            cursor: pointer;
        }

        .treeview li a {
            text-decoration: none;
            color: inherit;

            cursor: pointer;
        }

        .treeview li button, .treeview li button:active, .treeview li button:focus {
            text-decoration: none;
            color: inherit;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }


    </style>
@endsection