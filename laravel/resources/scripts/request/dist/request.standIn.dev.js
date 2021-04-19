"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

$(function () {
  var $request_interface_dom = 'request-interface-form';

  var RequestStandIns =
  /*#__PURE__*/
  function () {
    function RequestStandIns($form) {
      _classCallCheck(this, RequestStandIns);

      this.$form = $form;
      this.$add_on_dom = $form.find('.add-on');
      this.$add_on_first_dom = $form.find('.first-stand-in');
      this.$add_on_button = $form.find('button.add-stand-in');
      this.$add_id = Math.round(new Date().getTime() + Math.random() * 100);
    }

    _createClass(RequestStandIns, [{
      key: "AddOnListener",
      value: function AddOnListener() {
        var $add_on = this.$add_on_dom,
            $add_on_first = this.$add_on_first_dom,
            $id = this.$add_id;
        this.$add_on_button.on('click', function (_) {
          var $copy = $add_on.clone();
          $copy.insertAfter($add_on_first[0]).attr("style", "display: block !important");
          $copy.find('input[name ="daterange"]').attr("id", $id);
          $build_single_lightpick_based_on_id($id);
          $enableDelete();
        });
      }
    }]);

    return RequestStandIns;
  }();

  $enableDelete = function $enableDelete() {
    var $delete_add_on = $('.delete-add-on');
    $delete_add_on.on('click', function () {
      var $add_on = $(this.closest('.add-on'));
      $add_on.remove();
    });
  };

  if ('#' + $request_interface_dom) {
    var $enable = new RequestStandIns($('#' + $request_interface_dom));
    $enable.AddOnListener();
  }
});