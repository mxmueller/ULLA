$(function () {

    const $request_interface_dom = 'request-interface-form';
    if ('#' + $request_interface_dom) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const $form_submit_btn = $('#form-submit');
        const $backend_from_request = {};
        let $stand_in_collection = [];
        let $stand_in = [];

        $form_submit_btn.on('click', function () {

            Object.assign($backend_from_request, {
                applicant_id: $('#applicant').attr('user_id')
            }, {
                executive_id: $('#executive').val()
            });

            $('.' + $add_on_identifier).each(function ($key, $value) {
                let $timestamp = $($value).find('input').val();
                let $timestamp_split = $timestamp.split("/");
                let $timestamp_adjusted = new Date(
                    +$timestamp_split[2],
                    $timestamp_split[1] - 1,
                    +$timestamp_split[0]);

                $stand_in.push({
                    name: $($value).find('select').val(),
                    timestamp: $timestamp_adjusted
                });
            });

            $('div.first-stand-in').each(function ($key, $value) {
                let $timestamp = $($value).find('input').val();
                let $timestamp_split = $timestamp.split("/");
                let $timestamp_adjusted = new Date(
                    +$timestamp_split[2],
                    $timestamp_split[1] - 1,
                    +$timestamp_split[0]);

                $stand_in.push({
                    name: $($value).find('select').val(),
                    timestamp: $timestamp_adjusted
                });
            });

            $stand_in_collection.push($stand_in.concat());

            Object.assign($backend_from_request, {
                _stand_in_collection: $stand_in_collection
            });

            let $half_day = null;
            let $start_tstmp = null;
            let $end_tstmp = null;

            if ($("#toggle-date").is(':checked')) {
                $tstmp = new Date($('#day-input').find('input').val());
                $half_day = true;
                $start_tstmp = $tstmp;
                $end_tstmp = $tstmp;
            } else {
                $half_day = false;
                $start_tstmp = new Date($range.getStartDate()._i);
                $end_tstmp = new Date($range.getEndDate()._i);
            }

            Object.assign($backend_from_request, {
                _half_day: $half_day
            }, {
                _start_tstmp: $start_tstmp
            }, {
                _end_tstmp: $end_tstmp
            });

            let $request_comment = null

            if (!$("#request_comment").val()) {
                $request_comment = false
            } else {
                $request_comment = $("#request_comment").val();
            }

            Object.assign($backend_from_request, {
                request_comment: $request_comment
            });

            $.ajax({
                data: $backend_from_request,
                type: 'POST',
                url: '/request_submit_form_data'
            }).done(function($data){
                console.log($data);
            })
        });
    }
});
