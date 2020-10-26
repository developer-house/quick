import AutoNumeric from 'autonumeric';

window.AutoNumeric = AutoNumeric;

window.money = function () {
    new AutoNumeric.multiple('.money', {
        currencySymbol           : "$",
        decimalCharacter         : ",",
        decimalPlaces            : 2,
        decimalPlacesShownOnBlur : 2,
        decimalPlacesShownOnFocus: 2,
        digitGroupSeparator      : ".",
        minimumValue             : "0",
        failOnUnknownOption      : false,
        unformatOnSubmit         : true
    });
};

window.moneyNoSigno = function () {
    new AutoNumeric.multiple('.moneyNoSigno', {
        decimalCharacter         : ",",
        decimalPlaces            : 2,
        decimalPlacesShownOnBlur : 2,
        decimalPlacesShownOnFocus: 2,
        digitGroupSeparator      : ".",
        minimumValue             : "0",
        failOnUnknownOption      : false,
        unformatOnSubmit         : true
    });
};

window.moneySetMax = function (max) {
    new AutoNumeric.multiple('.moneySetMax', {
        currencySymbol           : "$",
        decimalCharacter         : ",",
        decimalPlaces            : 2,
        decimalPlacesShownOnBlur : 2,
        decimalPlacesShownOnFocus: 2,
        digitGroupSeparator      : ".",
        minimumValue             : "0",
        maximumValue             : max,
        failOnUnknownOption      : false,
        unformatOnSubmit         : true
    });
};


window.moneyValueToRecharge = function (max) {
    new AutoNumeric.multiple('.moneyValueToRecharge', {
        currencySymbol           : "$",
        decimalCharacter         : ",",
        decimalPlaces            : 0,
        decimalPlacesShownOnBlur : 0,
        decimalPlacesShownOnFocus: 0,
        digitGroupSeparator      : ".",
        minimumValue             : "0",
        maximumValue             : max,
        failOnUnknownOption      : false,
        unformatOnSubmit         : true
    });
};

window.moneySetMinAndMax = function (min, max) {
    new AutoNumeric.multiple('.moneySetMinAndMax', {
        currencySymbol           : "$",
        decimalCharacter         : ",",
        decimalPlaces            : 2,
        decimalPlacesShownOnBlur : 2,
        decimalPlacesShownOnFocus: 2,
        digitGroupSeparator      : ".",
        minimumValue             : min,
        maximumValue             : max,
        failOnUnknownOption      : false,
        unformatOnSubmit         : true
    });
};

window.porcentaje = function () {
    new AutoNumeric.multiple('.porcentaje', {
        suffixText               : "%",
        decimalCharacter         : ",",
        decimalPlaces            : 2,
        decimalPlacesShownOnBlur : 2,
        decimalPlacesShownOnFocus: 2,
        digitGroupSeparator      : ".",
        minimumValue             : "0",
        maximumValue             : "100",
        failOnUnknownOption      : false,
        unformatOnSubmit         : true
    });
};

window.porcentajeSetMax = function (max) {
    new AutoNumeric.multiple('.porcentajeSetMax', {
        suffixText               : "%",
        decimalCharacter         : ",",
        decimalPlaces            : 2,
        decimalPlacesShownOnBlur : 2,
        decimalPlacesShownOnFocus: 2,
        digitGroupSeparator      : ".",
        minimumValue             : "0",
        maximumValue             : max,
        failOnUnknownOption      : false,
        unformatOnSubmit         : true
    });
};

window.autoNumericOptionsDolar = {
    currencySymbol           : "$",
    decimalCharacter         : ",",
    decimalPlaces            : 2,
    decimalPlacesShownOnBlur : 2,
    decimalPlacesShownOnFocus: 2,
    digitGroupSeparator      : ".",
    minimumValue             : "0",
    failOnUnknownOption      : false,
    unformatOnSubmit         : true
};

window.autoNumericOptionsDolar = {
    currencySymbol           : "$",
    decimalCharacter         : ",",
    decimalPlaces            : 2,
    decimalPlacesShownOnBlur : 2,
    decimalPlacesShownOnFocus: 2,
    digitGroupSeparator      : ".",
    minimumValue             : "0",
    failOnUnknownOption      : false,
    unformatOnSubmit         : true
};


if ($(".money")[0]) {
    window.money();
}

if ($(".moneyValueToRecharge")[0]) {
    window.moneyValueToRecharge();
}

if ($(".moneyNoSigno")[0]) {
    window.moneyNoSigno();
}

if ($(".porcentaje")[0]) {
    window.porcentaje();
}


window.AutoNumericDolar = function ($id) {
    $id = '#' + $id;
    new AutoNumeric($id, autoNumericOptionsDolar);
};

window.AutoNumericPorcentaje = function ($id) {
    $id = '#' + $id;
    new AutoNumeric($id, autoNumericOptionsPorcentaje);
};


window.AutoNumericGetValue = function ($id) {
    $id = '#' + $id;
    return AutoNumeric.getAutoNumericElement($($id).get(0)).getNumber();
};


window.AutoNumericSetValue = function ($id, $value) {
    $id = '#' + $id;
    return AutoNumeric.getAutoNumericElement($($id).get(0)).set($value);
};





