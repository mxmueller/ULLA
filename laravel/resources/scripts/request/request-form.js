$(function() {
    const $request_interface_dom = "request-interface-form";

    if ("#" + $request_interface_dom) {
        const $form_submit_btn = $("#form-submit");
        const $backend_from_request = {};

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $form_submit_btn.on("click", function() {    
        $form_submit_btn.attr("disabled", true)
        $form_submit_btn.fadeOut();

            let $stand_in_collection = [];
            let $stand_in = [];
            let $half_day = null;
            let $start_tstmp = null;
            let $end_tstmp = null;
            let $request_comment = null;
            let $sum = null;

            $("." + $add_on_identifier).each(function($key, $value) {
                let $timestamp = $($value)
                    .find("input")
                    .val();
                let $timestamp_split = $timestamp.split("/");
                let $timestamp_adjusted = new Date(
                    +$timestamp_split[2],
                    $timestamp_split[1] - 1,
                    +$timestamp_split[0]
                ).getTime();

                $stand_in.push({
                    name: $($value)
                        .find("select")
                        .val(),
                    timestamp: $timestamp_adjusted
                });
            });

            $("div.first-stand-in").each(function($key, $value) {
                let $timestamp = $($value)
                    .find("input")
                    .val();
                let $timestamp_split = $timestamp.split("/");
                let $timestamp_adjusted = new Date(
                    +$timestamp_split[2],
                    $timestamp_split[1] - 1,
                    +$timestamp_split[0]
                ).getTime();

                $stand_in.push({
                    name: $($value)
                        .find("select")
                        .val(),
                    timestamp: $timestamp_adjusted
                });
            });

            $stand_in_collection.push($stand_in.concat());

            if ($("#toggle-date").is(":checked")) {
                $tstmp = $half_day_pick.getDate()._i;
                $half_day = 1;
                $start_tstmp = $tstmp;
                $end_tstmp = $tstmp;
                $sum = $("#sum-half").val();
            } else {
                $half_day = 0;
                $start_tstmp = $range.getStartDate()._i;
                $end_tstmp = $range.getEndDate()._i;
                $sum = $("#sum").val();
            }

            if (!$("#request_comment").val()) {
                $request_comment = false;
            } else {
                $request_comment = $("#request_comment").val();
            }

            Object.assign(
                $backend_from_request,
                {
                    applicant_id: $("#applicant").attr("user_id")
                },
                {
                    executive_id: $("#executive").val()
                },
                {
                    stand_in_collection: $stand_in_collection
                },
                {
                    half_day: $half_day
                },
                {
                    start_tstmp: $start_tstmp
                },
                {
                    sum : $sum
                },
                {
                    end_tstmp: $end_tstmp
                },
                {
                    request_comment: $request_comment
                },
                {
                    request_type_id: $("#type").val()
                }
            );

            $.ajax({
                data: $backend_from_request,
                type: "POST",
                url: "/request_submit_form_data"
            }).done(function($requestId) {
                window.location.href = "/request/success";

                // to be  counting
            });
        });
    }
});