"use strict";

$(function () {
  var $request_interface_dom = 'request-interface-form';

  if ('#' + $request_interface_dom) {
    var $form_submit_btn = $('#form-submit');
    var $backend_from_request = {};
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $form_submit_btn.on('click', function () {
      var $stand_in_collection = [];
      var $stand_in = [];
      var $half_day = null;
      var $start_tstmp = null;
      var $end_tstmp = null;
      var $request_comment = null;
      $('.' + $add_on_identifier).each(function ($key, $value) {
        var $timestamp = $($value).find('input').val();
        var $timestamp_split = $timestamp.split("/");
        var $timestamp_adjusted = new Date(+$timestamp_split[2], $timestamp_split[1] - 1, +$timestamp_split[0]).getTime();
        $stand_in.push({
          name: $($value).find('select').val(),
          timestamp: $timestamp_adjusted
        });
      });
      $('div.first-stand-in').each(function ($key, $value) {
        var $timestamp = $($value).find('input').val();
        var $timestamp_split = $timestamp.split("/");
        var $timestamp_adjusted = new Date(+$timestamp_split[2], $timestamp_split[1] - 1, +$timestamp_split[0]).getTime();
        $stand_in.push({
          name: $($value).find('select').val(),
          timestamp: $timestamp_adjusted
        });
      });
      $stand_in_collection.push($stand_in.concat());

      if ($("#toggle-date").is(':checked')) {
        $tstmp = $half_day_pick.getDate()._i;
        $half_day = 1;
        $start_tstmp = $tstmp;
        $end_tstmp = $tstmp;
      } else {
        $half_day = 0;
        $start_tstmp = $range.getStartDate()._i;
        $end_tstmp = $range.getEndDate()._i;
      }

      if (!$("#request_comment").val()) {
        $request_comment = false;
      } else {
        $request_comment = $("#request_comment").val();
      }

      Object.assign($backend_from_request, {
        applicant_id: $('#applicant').attr('user_id')
      }, {
        executive_id: $('#executive').val()
      }, {
        _stand_in_collection: $stand_in_collection
      }, {
        _half_day: $half_day
      }, {
        _start_tstmp: $start_tstmp
      }, {
        _end_tstmp: $end_tstmp
      }, {
        request_comment: $request_comment
      }, {
        request_type_id: $('#type').val()
      });
      $.ajax({
        data: $backend_from_request,
        type: 'POST',
        url: '/request_submit_form_data'
      }).done(function ($data) {
        console.log($data);
      });
    });
  }
});