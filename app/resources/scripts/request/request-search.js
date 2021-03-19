$(function () {

    const $regularSearchSubmitBtn = $("#request-search");

    $regularSearchSubmitBtn.on("click", function () {

        let $order = $('#order').find(":selected").val();
        let $quantum = $("#quantum").find(":selected").val();
        let $employees = $("#employees").find(":selected").val();
        let $status = $("#status").find(":selected").val();
        let $sq = ascii_to_hexa($order + ':' + $quantum + ':' + $employees + ':' + $status);

        window.location.replace(
            "/request/segmented/" + $sq);
    });

    function ascii_to_hexa(str) {
        var arr1 = [];
        for (var n = 0, l = str.length; n < l; n++) {
            var hex = Number(str.charCodeAt(n)).toString(16);
            arr1.push(hex);
        }
        return arr1.join('');
    }
});
