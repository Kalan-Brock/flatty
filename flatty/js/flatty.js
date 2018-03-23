var flatty = function () {
    var base = this;

    base.init = function (){

    };

    base.get = function (table, key) {

        return new Promise(function(resolve, reject) {

            var req = new XMLHttpRequest();
            req.open('GET', '/flatty/' + table + '/' + key);

            req.onload = function() {
                if (req.status == 200) {
                    resolve(req.response);
                }
                else {
                    reject(Error(req.statusText));
                }
            };

            req.onerror = function() {
                reject(Error("Network Error"));
            };

            req.send();
        });
    };

    base.post = function () {
      console.log('posting something');
    };

    base.init();
};

