

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
};
$(document).ready(function () {
    showNotification = function(message, type) {
        const notificationContainer = document.getElementById('notification-container');
    
      
        const notification = document.createElement('div');
        notification.classList.add('rounded', 'p-4', 'mb-4', 'transition', 'duration-300', 'ease-in-out', 'transform');
    
       
        if (type === 'success') {
            notification.classList.add('bg-green-500', 'text-white');
        } else if (type === 'error') {
            notification.classList.add('bg-red-500', 'text-white');
        }
    
      
        notification.innerHTML = `<p>${message}</p>`;
    
       
        notificationContainer.appendChild(notification);
    
        
        setTimeout(() => {
            notification.classList.add('translate-y-8', 'opacity-0');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 5000); 
    };
    setPageNew = function(page, params) {
        var contentContainer = document.getElementById('content');
        contentContainer.innerHTML = ''; 
        
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                contentContainer.innerHTML = xhr.responseText;
            } else if (xhr.readyState == 4 && xhr.status != 200) {
                console.error("Error loading page: " + xhr.status + " " + xhr.statusText);
                
            }
        };
        xhr.open('GET', 'pages/' + page + '.php' + params, true);
        xhr.send();
    };
    handleAjax = function() {
        console.log("Clicked!");
        $('#result').html('');
        var formData = $("#whitelist_form").serialize();
    
        $.ajax({
            url: "pages/process.php",
            type: "post",
            data: formData,
            dataType: 'json', 
            success: function(response) {
                if (response && response.hasOwnProperty('status')) {
                    if (response.allcorrect === 'true') {
                        setPageNew('whitelist', '');
                        console.log("Õiged vastused, kõik korras");
                    } else {

                        setPageNew('whitelist', '');
                        console.log("Õiged vastused, kuid mitte kõik");
                    }
                    if (response.status === 'true') {
                        setPageNew('whitelist', '');
                        console.log("Õigeee");
                    }
                    if (response.invalid === 'false') {
                        setPageNew('whitelist', '');
                        console.log("Vigane");
                    }
                } else {
                    console.error("Invalid JSON response from the server:", response);
                }
    
            },
            error: function(xhr, status, error) {
                showNotification("Puhka nüüd!", 'error');
            }
        });
    };
    

     
})


