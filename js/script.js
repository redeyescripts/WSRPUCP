function lae() {
    document.getElementById('loginButton').disabled = true;

    document.getElementById('loginText').style.display = 'none';
    document.getElementById('loadingIndicator').style.display = 'inline-block';

    setTimeout(function() {
        document.getElementById('loginButton').disabled = false;

        document.getElementById('loadingIndicator').style.display = 'none';
        document.getElementById('loginText').style.display = 'inline';
        window.location.href = 'init-openId.php';
    }, 3000); // Simulating a 3-second loading process
}


$(document).ready(function () {

let selectedPlayer = undefined;

setPageNew = function(page, params) {
var contentContainer = document.getElementById('content');
contentContainer.innerHTML = ''; // Clear existing content

// Use AJAX to load content from an external file
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        contentContainer.innerHTML = xhr.responseText;
    } else if (xhr.readyState == 4 && xhr.status != 200) {
        console.error("Error loading page: " + xhr.status + " " + xhr.statusText);
        // Handle error, display a message, or redirect to an error page
    }
};
xhr.open('GET', 'pages/' + page + '.php' + params, true);
xhr.send();
}

showNotificationV2 = function(message, type) {
    const notificationContainer = document.getElementById('notification-container');

    // Create notification element
    const notification = document.createElement('div');
    notification.classList.add('rounded', 'p-4', 'mb-4', 'transition', 'duration-300', 'ease-in-out', 'transform');

    // Set notification type classes
    if (type === 'success') {
        notification.classList.add('bg-green-500', 'text-white');
    } else if (type === 'error') {
        notification.classList.add('bg-red-500', 'text-white');
    }

    // Set notification content
    notification.innerHTML = `<p>${message}</p>`;

    // Append notification to container
    notificationContainer.appendChild(notification);

    // Automatically remove the notification after a few seconds (adjust as needed)
    setTimeout(() => {
        notification.classList.add('translate-y-8', 'opacity-0');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000); // 5000 milliseconds (5 seconds)
}

showNotification = function(type, message) {
    let $notification

    if (type == 'success') {
        $notification = $(`
            <div class="flex min-w-96 break-all items-center p-4 text-zinc-500 bg-white rounded shadow mb-1" role="alert">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded shadow">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Check icon</span>
                </div>

                <div class="ml-3 text-sm font-normal">${message}</div>

                <button onclick="this.parentElement.remove();" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        `);
    } else if (type == 'info') {
        $notification = $(`
            <div class="flex min-w-96 break-all items-center p-4 text-zinc-500 bg-white rounded shadow mb-1" role="alert">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-sky-500 bg-sky-100 rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                    <span class="sr-only">Info icon</span>
                </div>

                <div class="ml-3 text-sm font-normal">${message}</div>

                <button onclick="this.parentElement.remove();" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex h-8 w-8" data-dismiss-target="#toast-warning" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        `);
    } else if (type == 'error') {
        $notification = $(`
            <div class="flex min-w-96 break-all items-center p-4 text-zinc-500 bg-white rounded shadow mb-1" role="alert">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded shadow">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Error icon</span>
                </div>

                <div class="ml-3 text-sm font-normal">${message}</div>

                <button onclick="this.parentElement.remove();" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex h-8 w-8" data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        `);
    }

    $('#notify_container').append($notification);

    setTimeout(function () {
        $notification.fadeOut(300)
    }, 5000)
}

capitalizeFirstLetter = function(str) {
return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

validateName = function(input) {
var regex = /^[a-zA-Z ]+$/;
return regex.test(input);
}

validateDate = function(input) {
var dateCheck = new Date(input);

if (dateCheck == "Invalid Date") {
    return false
}

return true 
}

createCharacter = function() {
let firstname = $('#createFirstname').val(); let lastname = $('#createLastname').val();
let dob = $('#createDob').val(); let sex = $('#createSex').val();

if (firstname != '' && lastname != '' && validateDate(dob) && (sex == 'm' || sex == 'f')) {
    if (validateName(firstname) && validateName(lastname)) {
        setTimeout(() => { setPage('home', '') }, 300);

        $.post('./../home.php', { firstname: capitalizeFirstLetter(firstname), lastname: capitalizeFirstLetter(lastname), dob: dob, sex: sex }, function(response) {
            response = JSON.parse(response);

            showNotification(response.type, response.message)
        });
    } else {
        showNotification('error', 'Teie valitud nimes on lubamatud tähed!')
    }
} else {
    showNotification('error', 'Täida kõik väljad korralikult!')
}
}

buyNameChange = function() {
let firstname = $('#newFirstname').val(); let lastname = $('#newLastname').val();

if (firstname != '' && lastname != '') {
    if (validateName(firstname) && validateName(lastname)) {
        setTimeout(() => { setPage('donations', '') }, 300);

        $.post('pages/donations.php', { type: 'nameChange', pid: $('#newNameCharacter').val(), firstname: capitalizeFirstLetter(firstname), lastname: capitalizeFirstLetter(lastname)}, function(response) {
            response = JSON.parse(response);

            showNotification(response.type, response.message)
        });
    } else {
        showNotification('error', 'Teie valitud nimes on lubamatud tähed!')
    }
} else {
    showNotification('error', 'Täida kõik väljad korralikult!')
}
} 

buyDobChange = function() {
let dob = $('#newDob').val();

if (validateDate(dob)) {
    setTimeout(() => { setPage('donations', '') }, 300);

    $.post('pages/donations.php', { type: 'dobChange', pid: $('#newNameCharacter2').val(), dob: dob}, function(response) {
        response = JSON.parse(response);

        showNotification(response.type, response.message)
    });
} else {
    showNotification('error', 'Täida kõik väljad korralikult!')
}
} 

buyWhitelist = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'whitelist' }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
} 

customSound = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'customSound', link: $('#soundLink').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
} 

addonVehicle = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'addonVehicle', pid: $('#carPid').val(), link: $('#carLink').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
} 

addonPed = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'addonPed', pid: $('#pedPid').val(), link: $('#pedLink').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
} 

buyFactionSlot = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'factionSlot', pid: $('#factionSlotCharacter').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
} 

buyCharacterSlot = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'characterSlot' }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
} 

buyPlateChange = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'plateChange', plate: $('#selectedPlateVehicle').val(), newPlate: $('#newPlate').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

buyCarRadio = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'carRadio', plate: $('#selectedRadioVehicle').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

buyUnban = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'unban' }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

additionalCarSlot = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'additionalCar', pid: $('#additionalCarVehicle').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

loadProfile = function(event) {
if (event.keyCode === 13) {
    $('#indeterminate').show();

    $.post('pages/profiles.php', { action: 'search', search: $('#profileSearch').val() }, function(response) {
        response = JSON.parse(response);

        if (response.type === 'success') {
            selectedPlayer = response.data.id;

            $('#profileId').text(response.data.id);
            $('#profileName').text(response.data.name);
            $('#profileIdentifier').text(response.data.identifier);
            $('#profileLicense').text(response.data.license);
            $('#profileLive').text(response.data.liveid);
            $('#profileXbox').text(response.data.xblid);
            $('#profileDiscord').text(response.data.discord);
            $('#profileLastIp').text(response.data.playerip);
            $('#profileHours').text(response.data.hours);
            $('#profileOnline').text(response.data.last_online);

            if (response.data.status === 'accepted') {
                $('#profileTest').html('<p class="text-green-700 font-bold">JAH</p>');
            } else {
                $('#profileTest').html('<p class="text-red-700 font-bold">EI</p>');
            }
            
            $('#profileBugs').text(response.data.bug_tries);
            $('#profileTries').text(response.data.test_tries);
            $('#profileQueue').text(response.data.queue);
            $('#profilePoints').text(response.data.points);

            $('#profileNotes').val(response.data.admin_notes);

            showNotification('success', 'Profiil leitud!');
        } else {
            showNotification('error', 'Sisestatud profiili ei leitud!');
        }

        $('#indeterminate').hide();
    });
}
}

saveNotes = function() {
$('#indeterminate').show();

$.post('pages/profiles.php', { action: 'saveNotes', id: selectedPlayer, notes: $('#profileNotes').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message);
    $('#indeterminate').hide();
});
}

buySpecialTime = function(page, id) {
$('#indeterminate').show();

$.post('pages/addon_vehicles.php', { page: page, renew: id }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message);
    setPage('addon_vehicles', '')
});
}

buyPriorityQueue1 = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'priorityQueue1' }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

buyPriorityQueue2 = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'priorityQueue2' }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

buyPriorityQueue3 = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'priorityQueue3' }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

buyPriorityQueue4 = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'priorityQueue4' }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}

updateQueueLevel = function(id) {
$('#indeterminate').show();

$.post('pages/donations.php', { type: 'updateQueueLevel', id: id }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message);
    setPage('donations', '')
});
}

buyVehicleSound = function() {
setTimeout(() => { setPage('donations', '') }, 300);

$.post('pages/donations.php', { type: 'vehicleSound', plate: $('#selectedSoundVehicle').val(), newSound: $('#newSound').val() }, function(response) {
    response = JSON.parse(response);

    showNotification(response.type, response.message)
});
}


});
