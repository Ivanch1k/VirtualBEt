function onSignIn(googleUser) {

    let profile = googleUser.getBasicProfile();
    let SecondAndFirstname = profile.getName();
    let nameArr = SecondAndFirstname.split(' ');
    let name = nameArr[0];
    let secondName = nameArr[1];
    let  mail = profile.getEmail();
    $.ajax({
        url: 'ajax/authorizeGoogle.php',
        type: 'POST',
        cache: false,
        data: {'name' : name,'secondName' : secondName,'mail' : mail,},
        success:function (data) {
            document.location.href ="main.php";
        }
    });
}

