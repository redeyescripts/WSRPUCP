loadlogin = function() {
    document.getElementById('loginButton').disabled = true;

    document.getElementById('loginText').style.display = 'none';
    document.getElementById('loadingIndicator').style.display = 'inline-block';

    setTimeout(function() {
        document.getElementById('loginButton').disabled = false;

        document.getElementById('loadingIndicator').style.display = 'none';
        document.getElementById('loginText').style.display = 'inline';
        window.location.href = 'init-openId.php';
    }, 3000); 
}