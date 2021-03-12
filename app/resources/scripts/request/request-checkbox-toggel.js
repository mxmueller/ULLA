$(function () {
    const $request_interface_dom = 'request-interface-form';
    if ('#' + $request_interface_dom) {

        //pageload
        let $range = $('#range-input');
        let $day = $('#day-input');
        let $sum = $("#sum-input");
        let $sumHalf = $("#sum-half-input");

        $range.show();
        $day.hide();
        $sum.show();
        $sumHalf.hide();

        $("#toggle-date").change(function () {
            if ($range.is(":visible")) {
                $range.hide();
                $day.show();
                $sum.hide();
                $sumHalf.show();
            } else {
                $range.show();
                $day.hide();
                $sum.show();
                $sumHalf.hide();
            }
        });
    }
});
