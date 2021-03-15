$(function() {

    const $regularSearchSubmitBtn = $("#request-search"); 

    $regularSearchSubmitBtn.on("click", function() {
       
        let $orderSelection = $('#order')
            .find(":selected")
            .val();
        let $quantumSelection = $("#quantum")
            .find(":selected")
            .val();
        let $employeesSelection = $("#employees")
            .find(":selected")
            .val();

        window.location.replace(
            "/request/summary/segmented?order=" +
                $orderSelection +
                "&employee=" +
                $employeesSelection +
                "&quantum=" +
                $quantumSelection
        );
    });

});