$().ready(function() {
    jQuery.extend(jQuery.validator.messages, {
        required: jQuery.validator.format('{0} is required.'),
        email: jQuery.validator.format('Please enter your e-mail address correctly.'),
        max: jQuery.validator.format('Please enter {0} with less than "{1}" characters. (currently {2} characters).'),
        date: jQuery.validator.format('Enter the correct date for {0}.'),
        greaterStart: jQuery.validator.format('Please specify the contract end date as the scheduled cancellation date.'),
        equalTo: jQuery.validator.format('The confirmation password is incorrect.'),
        existsEmail: jQuery.validator.format('Your email address is already registered.'),
        extension: jQuery.validator.format('Incorrect file format. Please select {0}.'),
        filesize: jQuery.validator.format('File size limit {0} exceeded.'),
        stringValueRange: jQuery.validator.format('Enter the password in 8 to 20 characters.'),
    });
})