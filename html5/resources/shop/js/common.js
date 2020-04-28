/**
 * 登录操作
 * @type {{check: login.check}}
 */
var login = {
    check : function () {
        var account = $('input[name="account"]').val();
        var password = $('input[name="password"]').val();

        if( !account ){
            hui.toast('用户名不能为空！');
            return false;
        }
        if( !password ){
            hui.toast('密码不能为空！');
            return false;
        }
        var url = '';
        var data = {'username':account,'password':password};

        $.post( url,data, function (result) {

        },'JSON')

    }
};
var register = {
    check :function () {

    }
}


var logout = {
    check : function () {
        var url = '/logout';
        var data = {'html':1};
        $.post(url,data,function (result) {

        },'JSON')
    }
}