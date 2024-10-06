const apiUrl = "http://127.0.0.1:8000/";

$(document).ready(function () {

   $('form').submit(function (e){
       e.preventDefault();
   });

   $('#login').submit(function (e) {

       // Retrieve and trim input values
       var email = $('#email').val().trim();
       var password = $('#password').val().trim();


       sendRequest('login', 'POST', (data) => {
           console.log('Response Data:', data);
       }, { email: email, password: password });

   });






});


function sendRequest(route, method, callback, params = {}) {
    fetch(apiUrl+route, {
        method: method,
        headers: {
            'Content-Type': 'application/json', // Set the content type to application/json
        },
        body: method !== 'GET' ? JSON.stringify(params) : null, // Stringify params if not a GET request
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json(); // Parse JSON response
        })
        .then(data => callback(data)) // Call the callback function with the response data
        .catch(error => console.error('Error:', error)); // Handle any errors
}

