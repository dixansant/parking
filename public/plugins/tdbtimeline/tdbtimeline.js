(function ($) {

    $.fn.tdbtimeline = function (options) {

        var todayP = 0;
        var mL = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var dW = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];


        var settings = $.extend({
            linehigh: '#004165',
            markcolor: '#c04b49',
            linecolor: '#DDD',

        }, options);

        // reorganizar la data segun la fecha
        settings.data = function (w) {
            r = [];
            c = 0;
            for (t in w) {
                c++;
                dt = new Date(w[t].datetime)
                tm = dt.getTime();
                w[t].time = tm;
                for (i in r)
                    if (tm < r[i].time) {
                        r.splice(i, 0, w[t]);
                        break;
                    }
                if (r.length != c) r.push(w[t]);
            }


            return r;
        }(settings.data)

        // asignarle porcientos

        first = settings.data[0].time;
        last = settings.data[settings.data.length - 1].time;
        dif = last - first + (last - first) * 0.30;

        settings.data = function (w) {

            lp = 10;
            for (t in w) {
                w[t].lastperc = lp;
                w[t].percent = 10 + parseInt((w[t].time - first) / dif * 10000) / 100
                lp = w[t].percent;
            }

            return w;
        }(settings.data)


        //console.log(settings.data)

        return this.each(function () {

            $(this).html(`
                <div class="mainline">
                <div class="svgcontainer">
                    <svg height="5" width="100%">
                        <line x1="0" y1="0" x2="100%" y2="0" style="stroke:${settings.linecolor};stroke-width:5;" />
                        Sorry, your browser does not support inline SVG.
                    </svg>
                </div>
                <div class="just-now blink" style="display: none"></div>
                </div>`);

            for (t in settings.data) {
                addPoint.call(this, t, settings.data[t])
            }

            if (settings.now) {
                now = new Date().getTime();
                startat = new Date(settings.now.start).getTime();

                if (now >= startat) {
                    todayP = 10 + parseInt((now - first) / dif * 10000) / 100
                    $(this).find('.just-now').css({left: 'calc(' + todayP + '% - 6px)', display: ''})
                    if (settings.now.start) {
                        startP = 10 + parseInt((startat - first) / dif * 10000) / 100

                        $sgv = $(this).find('.svgcontainer > svg')
                        addLine.call($sgv, {
                            x1: startP + '%',
                            y1: 0,
                            x2: todayP + '%',
                            y2: 0,
                            color: settings.now.line || settings.linehigh,
                            width: 5
                        })


                    }
                }
            }

        });


        function addLine(j) {
            add = `<line x1="${j.x1}" y1="${j.y1}" x2="${j.x2}" y2="${j.y2}" style="stroke:${j.color};stroke-width:${j.width};" />`;
            $(this).append(add);
            $svgC = $(this).parent();
            $svgC.html($svgC.html());
        }


        function addPoint(t, w) {

            ptype = w.type || 'bubble';

            dt = new Date(w.time);
            day = dt.getDate();
            day = (day < 10) ? '0' + day : day;
            mon = mL[dt.getMonth()];
            dWeek = dW[dt.getDay()];
            hr = dt.getHours()
            tt = (hr < 12) ? 'AM' : 'PM'
            hr = hr > 12 ? hr - 12 : hr

            year = dt.getFullYear();

            mm = dt.getMinutes();
            if (mm < 10) mm = '0' + mm;
            hrs = hr + ":" + mm

            author = w.author || '';


            cls = ((t % 2) == 0) ? 'eventup' : 'eventdown';
            clsaut = ((t % 2) == 0) ? 'eventAuthor' : 'event2Author';
            clstim = ((t % 2) == 0) ? 'time' : 'time2';


            if (w.line) {
                $sgv = $(this).find('.svgcontainer > svg')
                addLine.call($sgv, {
                    x1: w.lastperc + '%',
                    y1: 0,
                    x2: w.percent + '%',
                    y2: 0,
                    color: w.line,
                    width: 5
                })
            }

            addgray = w.gray ? 'future-gray' : '';
            addopac = w.gray ? 'future-opac' : '';



            switch (ptype) {
                case 'bubble':
                    fill = w.circle || settings.linehigh;
                    cont = `<div class="bubble">
                    <div class="${addopac}">
                        <div class="eventTime">
                            <div class="day-digit">${day}</div>
                            <div class="day-week">
                                <div class="month-year">${mon} ${year}</div>
                                ${dWeek}
                            </div>
                        </div>
                        <div class="event-title">${w.caption}</div>
                    </div>
                    <div class="hour-tt">
                        <label>
                            ${hrs} ${tt}
                        </label>
                    </div>
                    <div class="event-author">${author}</div>
                </div>`

                    break;
                default:
                    fill = w.circle || settings.markcolor;
                    cont = `<div class="point-mark" style="border-color: ${fill}">${w.caption}</div>`;
            }

            $(this).find('.svgcontainer').append(`<div class="tdbEvent ${cls} ${addgray}" style="left:${w.percent}%; ">
                ${cont}
                <svg height="20" width="20">
                    <circle cx="10" cy="11" r="7" fill="${fill}" stroke="white" stroke-width="3"/>
                </svg>
            </div>`);
        }

    };

}(jQuery));