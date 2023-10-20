$().ready(function() {
    $.validator.addMethod('filesize', function(value, element, param) {
        let size = param.split('MB')[0] * 1024 * 1024;
       return this.optional(element) || (size !== NaN && element.files[0].size <= size) 
    });
   
    $.validator.addMethod('extension', function (value, element, param) {
       param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g';
       return this.optional(element) || value.match(new RegExp('.(' + param + ')$', 'i'));
    });

    $.validator.addMethod('email', function (value, element) {
        const regexIfHasQuotes = /^["].+["]@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/
        const regexForEmail = /^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/;
        
        if(regexIfHasQuotes.test(value)) {
            return true;
        }

        return this.optional(element) || regexForEmail.test(value);
    });
});