if ($('canvas').length > 1) {
    let house_id = $('h1').attr('data-house-id');
	printMsgChart(house_id);
	printHitChart(house_id);
}

// function that prints charts with current values
function printMsgChart(id) {
    // ajax call to get data
    $.ajax ({
        'url' : 'http://localhost:8000/api/messages/' + id,
        'method' : 'GET',
        'success' : function(data) {
            // get sales from api
            var messages = data.data;
            // get monthly messages
            var monthly_msgs = getMonthlyMsgs(messages);
            // display monthly messeges in a line chart
            printLineChart(monthly_msgs);
        },
        'error' : function() {
            alert('Si è verificato un errore');
        }
    });
}

function printHitChart(id) {
    // ajax call to get data
    $.ajax ({
        'url' : 'http://localhost:8000/api/hits/' + id,
        'method' : 'GET',
        'success' : function(data) {
            // get hits from api
            var hits = data.data;
            // get monthly hits
            var monthly_hits = getMonthlyHits(hits);
            // display monthly hits in a bar chart
            printBarChart(monthly_hits);
        },
        'error' : function() {
            alert('Si è verificato un errore');
        }
    });
}

// function that gets monthly sales
function getMonthlyMsgs(object) {
    // initialize object
    var monthlyMsgs = {
        'January': 0,
        'February': 0,
        'March': 0,
        'April': 0,
        'May': 0,
        'June': 0,
        'July': 0,
        'August': 0,
        'September': 0,
        'October': 0,
        'November': 0,
        'December': 0
    };

    for(var i = 0; i < object.length; i++) {
        // get single message
        var message = object[i];
        // get month string from created_at
        var month = moment(message.created_at, "YYYY-MM-DD HH:mm:ss").format('MMMM');
        // add 1 to its month
        monthlyMsgs[month] += 1;
    }
    return monthlyMsgs;
}

function getMonthlyHits(object) {
    // initialize object
    var monthlyHits = {
        'January': 0,
        'February': 0,
        'March': 0,
        'April': 0,
        'May': 0,
        'June': 0,
        'July': 0,
        'August': 0,
        'September': 0,
        'October': 0,
        'November': 0,
        'December': 0
    };

    for(var i = 0; i < object.length; i++) {
        // get single hit
        var hit = object[i];
        // get month string from created_at
        var month = moment(hit.created_at, "YYYY-MM-DD HH:mm:ss").format('MMMM');
        // add 1 to its month
        monthlyHits[month] += 1;
    }
    return monthlyHits;
}

function printLineChart(object) {
    // get keys from object 
    var keys = Object.keys(object);
    // get values from object
    var values = Object.values(object);
    // print chart
    var ctx = $('#canvas-messages')[0].getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: keys,
            datasets: [{
                label: 'Messages',
                data: values,
                backgroundColor: [
                    'rgba(184, 240, 245, 1)',
                ],
                borderColor: [
                    'rgba(34, 180, 206, 1)',
                ],
                borderWidth: 2,
            }]
        },
        options: {
            title: {
                display: true,
                text: ''
            }
        }
    });
}

function printBarChart(object) {
    // get keys from object 
    var keys = Object.keys(object);
    // get values from object
    var values = Object.values(object);
    // print chart
    var ctx = $('#canvas-hits')[0].getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: keys,
            datasets: [{
                label: 'Hits',
                data: values,
                backgroundColor: 'rgba(184, 240, 245, 0.5)',
                borderColor: 'rgba(34, 180, 206, 1)',
                borderWidth: 2,
            }]
        },
        options: {
            title: {
                display: true,
                text: ''
            }
        }
    });
}