/*
 * ASCII Art
 *   .----------------.  .----------------.  .----------------.  .----------------.  .----------------.  .----------------.
 * | .--------------. || .--------------. || .--------------. || .--------------. || .--------------. || .--------------. |
 * | |      __      | || | ____   ____  | || |  _________   | || | _____  _____ | || |  _________   | || |   ______     | |
 * | |     /  \     | || ||_  _| |_  _| | || | |_   ___  |  | || ||_   _||_   _|| || | |_   ___  |  | || |  |_   _ \    | |
 * | |    / /\ \    | || |  \ \   / /   | || |   | |_  \_|  | || |  | | /\ | |  | || |   | |_  \_|  | || |    | |_) |   | |
 * | |   / ____ \   | || |   \ \ / /    | || |   |  _|      | || |  | |/  \| |  | || |   |  _|  _   | || |    |  __'.   | |
 * | | _/ /    \ \_ | || |    \ ' /     | || |  _| |_       | || |  |   /\   |  | || |  _| |___/ |  | || |   _| |__) |  | |
 * | ||____|  |____|| || |     \_/      | || | |_____|      | || |  |__/  \__|  | || | |_________|  | || |  |_______/   | |
 * | |              | || |              | || |              | || |              | || |              | || |              | |
 * | '--------------' || '--------------' || '--------------' || '--------------' || '--------------' || '--------------' |
 * '----------------'  '----------------'  '----------------'  '----------------'  '----------------'  '----------------'
 *
 */
let token = (localStorage['token']) ? JSON.parse(localStorage['token']) : {};


if(token) {
    $.ajaxSetup({
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader('Authorization', 'Bearer ' + token.access_token);
        }
    });
}

var avfweb_auth = {

     client_id: '2',
     client_secret: 'ioIGmF7lCcGOYAD9vxWcYKG6NY3XArJXstNfvyV7',

    validaToken: function(){

        token = avfweb_auth.getLocalToken();
        if(token) {
            $.ajax({
                type: "GET",
                url: avfweb.urlApi+"/validartoken",
                error: function (error) {
                    if(error.status == 401 || error.status == 0) {
                        avfweb_auth.refreshToken();
                    }

                }
            });
        }

    },
    getToken: function(username, password, scope = '') {
        if(username && password) {
            return $.ajax({
                type: "POST",
                url: "/oauth/token",
                dataType: 'json',
                data: {
                    'grant_type': "password",
                    'client_id': this.client_id,
                    'client_secret': this.client_secret,
                    'username': username,
                    'password': password,
                    'scope' : scope

                },
                success: function (response) {
                    avfweb_auth.setLocalToken(response);
                },
            });
        }
    },
    refreshToken: function() {
        return $.ajax({
            type: "POST",
            url: "/oauth/token",
            dataType: 'json',
            data: {
                'grant_type' : 'refresh_token',
                'client_id': this.client_id,
                'client_secret': this.client_secret,
                'refresh_token' : avfweb_auth.getLocalToken()['refresh_token'],
                'scope' : ''

            },
            success: function (response) {
                avfweb_auth.setLocalToken(response);
            },
            error: function (error) {
                avfweb.redirectUrl("login");
            }
        });
    },
    getLocalToken: function () {
        return (localStorage['token']) ? JSON.parse(localStorage['token']) : {}
    },
    setLocalToken: function (response) {
        localStorage['token'] = JSON.stringify(response);
    }
}

