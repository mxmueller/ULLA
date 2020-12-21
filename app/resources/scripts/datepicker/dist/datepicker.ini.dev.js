"use strict";

$(function () {
  var $request_interface_dom = 'request-interface-form';

  if ('#' + $request_interface_dom) {
    var $half_day_pick = new Lightpick({
      field: document.getElementById('half-day'),
      onSelect: function onSelect(date) {
        document.getElementById('half-day').innerHTML = date.format('Do MMMM YYYY');
      }
    });
    var $range = new Lightpick({
      field: document.getElementById('range'),
      singleDate: false,
      onSelect: function onSelect(start, end) {
        var str = '';
        str += start ? start.format('Do MMMM YYYY') + ' to ' : '';
        str += end ? end.format('Do MMMM YYYY') : '...';
        document.getElementById('range').innerHTML = str;
      }
    });
  }
});