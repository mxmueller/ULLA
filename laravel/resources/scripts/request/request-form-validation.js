window.$formValidation = function ($form) {
    // prevent default
    $form.find('.field-error').removeClass('field-error');

    let $validation = {};

    $validation.overall = true;
    $validation.form = $form[0];
    $validation.checkbox = $($validation.form).find('#toggle-date').prop('checked');
    $validation.halfDay = {
        'input': $($validation.form).find('#half-day').val(),
        'state': false,
        'dom': $($validation.form).find('#half-day')
    };

    $validation.range = {
        'input': $($validation.form).find('#range').val(),
        'state': false,
        'dom': $($validation.form).find('#range')
    };

    $validation.sum = {
        'input': $($validation.form).find('#sum').val(),
        'state': false,
        'dom': $($validation.form).find('#sum')
    };

    $validation.standInCollection = [];

    $validation.standInFirst = {
        'input': $($validation.form).find('#first-stand-in').val(),
        'state': false,
        'dom': $($validation.form).find('#first-stand-in')
    }

    let $data = new Array();

    $($validation.form).find('.add-on-copy').each(function ($key, $value) {
        let $input = $($value).find('.date-range-picker');
        let $id = $input.attr('id');
        let $obj = {};

        $obj[$id] = $input.val();
        $data.push($obj);

        if (!$validateSingleDateRange($input.val()))
            $toggleFieldError($input)

    });

    $validation.standInCollection.push($data);

    switch ($validation.checkbox) {
        case true: // half day
            $validation.halfDay.state = $validateSingleDateRange($validation.halfDay.input);
            if (!$validation.halfDay.state) {
                $toggleFieldError($validation.halfDay.dom);
            }
            break;

        case false: // range 
            $validation.range.state = $validateDateRange($validation.range.input);
            $validation.sum.state = $validateSum($validation.sum.input);

            if (!$validation.range.state) {
                $toggleFieldError($validation.range.dom);
            }

            if (!$validation.sum.state) {
                $toggleFieldError($validation.sum.dom);
            }
            break;
    }

    $validation.standInFirst.state = $validateSingleDateRange($validation.standInFirst.input);

    if (!$validation.standInFirst.state) {
        $toggleFieldError($validation.standInFirst.dom);
    }

    function $validateDateRange($string) {
        if ($string.split('/').length - 1 == 4 && $string.includes('-'))
            return true;
        return false;
    }

    function $validateSingleDateRange($string) {
        if ($string.split('/').length - 1 == 2)
            return true;
        return false;
    }

    function $validateSum($float) {
        if (!isNaN($float) && $float.toString().indexOf('.') != -1 || // if float
            Math.floor($float) == $float && $.isNumeric($float)) // or if int
            return true;
        return false;
    }

    function $toggleFieldError($field) {
        $field.addClass('field-error');
        debugger;
        $validation.overall = false;
    }

    console.log($validation)
    return $validation.overall;
};
