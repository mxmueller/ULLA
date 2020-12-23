$(function () {
    const $request_interface_dom = 'request-interface-form';
    class RequestStandIns {
        constructor($form) {
            this.$form = $form;
            this.$add_on_dom = $form.find('.add-on');
            this.$add_on_first_dom = $form.find('.first-stand-in');
            this.$add_on_button = $form.find('button.add-stand-in');
        }

        AddOnListener() {
            const $add_on = this.$add_on_dom,
                $add_on_first = this.$add_on_first_dom;

            this.$add_on_button.on('click', function (_) {
                let $copy = $add_on.clone();
                let $id = Math.round(new Date().getTime() + (Math.random() * 100));

                $copy.insertAfter($add_on_first[0]).attr("style", "display: block !important");
                $copy.find('input[name ="daterange"]').attr("id", $id);
                $copy.addClass($add_on_identifier);

                $build_single_lightpick_based_on_id($id);
                $enableDelete();
            });
        }
    }

    $enableDelete = function() {
        let $delete_add_on = $('.delete-add-on');

        $delete_add_on.on('click', function(){
            let $add_on = $(this.closest('.add-on'));
            $add_on.remove();
        })
    }

    if ('#' + $request_interface_dom) {

        window.$add_on_identifier = 'add-on-copy';

        const $enable = new RequestStandIns($('#' + $request_interface_dom));
        $enable.AddOnListener();
    }
});
