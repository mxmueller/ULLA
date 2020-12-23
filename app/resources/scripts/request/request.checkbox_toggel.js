$(function () {
    const $request_interface_dom = 'request-interface-form';
    if ('#' + $request_interface_dom) {

        //pageload
        let $range = $('#range-input');
        let $day = $('#day-input');

        $range.show();
        $day.hide();

        $("#toggle-date").change(function () {
            if ($range.is(":visible")) {
                $range.hide();
                $day.show();
            } else {
                $range.show();
                $day.hide();
            }
        });
    }
});
