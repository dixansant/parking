$.vlang = {
    'valueMissing':function(b){
        return 'Field required.';
    },
    'tooShort':function(b){
        return 'Too Short, require '+$(b).attr('minlength')+' characters';
    },
    'customError':function(b){
        return 'customError';
    },
    'patternMismatch':function(b){
        return 'Invalid characters';
    },
    'rangeOverflow':function(b){
        return 'rangeOverflow';
    },
    'rangeUnderflow':function(b){
        return 'rangeUnderflow';
    },
    'stepMismatch':function(b){
        return 'stepMismatch';
    },
    'tooLong':function(b){
        return 'tooLong';
    },
    'noMatch':function(b){
        return 'No Match';
    },
    'unAvailable':function(b){
        return 'Email is in use';
    },
    'noMask':function(b){
        ty=$(b).attr('type');
        ta={
            email: 'Email Address',
            url: 'Url',
        }
        return 'Invalid Format [<b>'+(ta[ty]||ty)+'</b>]';
    },
    'typeMismatch':function(b){
        ty=$(b).attr('type');
        ta={
            email: 'Email Address',
            url: 'Url',
        }
        return 'Invalid Format [<b>'+(ta[ty]||ty)+'</b>]';
    },
    'noStrong':function(b){
        return 'Password is not Strong';
    }

}

