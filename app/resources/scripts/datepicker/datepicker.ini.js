$(function () {
    const $request_interface_dom = 'request-interface-form';

    if ('#' + $request_interface_dom) {

        let $half_day_pick = new Lightpick({
            field: document.getElementById('half-day'),
            onSelect: function(date){
                document.getElementById('half-day').innerHTML = date.format('Do MMMM YYYY');
            }
        });

        let $range = new Lightpick({
            field: document.getElementById('range'),
            singleDate: false,
            onSelect: function(start, end){
                let str = '';
                str += start ? start.format('Do MMMM YYYY') + ' to ' : '';
                str += end ? end.format('Do MMMM YYYY') : '...';
                document.getElementById('range').innerHTML = str;
            }
        });

    }
});
