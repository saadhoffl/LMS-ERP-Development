function setCookie(name, value, daysToExpire, SameSite=null) {
    var expires = "";
    
    if (daysToExpire) {
        var date = new Date();
        date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
        
    }

    document.cookie = name + "=" + value + expires + "; path=/";
    }


const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
    .then(FingerprintJS => FingerprintJS.load())

fpPromise
    .then(fp => fp.get())
    .then(result => {
        const visitorId = result.visitorId
        setCookie('fingerprint', visitorId, 1);
    })
   