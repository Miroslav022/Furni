// $(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-Token': $('meta[name="_token"]').attr('content')
//         }
//     });
// });
//
//
// const registrationForm = document.querySelector("#registration");
//
// let email = document.querySelector("#email").value;
// let firstName = document.querySelector("#firstName").value;
// let lastName = document.querySelector("#lastName").value;
// let password = document.querySelector("#password").value;
// let username = document.querySelector("#username").value;
//
// registrationForm.addEventListener('submit', e=>{
//     e.preventDefault();
//     validateRegistration()
//     const data = {
//         email,
//         first_name:firstName,
//         last_name:lastName,
//         password,
//         username
//     }
//     console.log(data);
//     // registerUser({
//     //     first_name:'Stojan',
//     //     last_name: 'Kisic',
//     //     username: 'stolee',
//     //     email: "stole@gmail.com",
//     //     password: 'stole',
//     // })
// })
//
// // $(document).ready(function (){
// //
// // })
//
// function validateRegistration() {
//     let email = document.querySelector("#email").value;
//     let firstName = document.querySelector("#firstName").value;
//     let lastName = document.querySelector("#lastName").value;
//     let password = document.querySelector("#password").value;
//     let username = document.querySelector("#username").value;
//
//     // Regular expression patterns
//     let namePattern = /^[A-Za-z]+$/;
//     let usernamePattern = /^.{3,}$/;
//     let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[A-Z])[A-Za-z\d]{8,}$/;
//
//     // Validation
//     if (!namePattern.test(firstName)) {
//         alert("First Name should contain only letters.");
//         return false;
//     }
//
//     if (!namePattern.test(lastName)) {
//         alert("Last Name should contain only letters.");
//         return false;
//     }
//
//     if (!usernamePattern.test(username)) {
//         alert("Username should contain more than 3 characters.");
//         return false;
//     }
//
//     if (!emailPattern.test(email)) {
//         alert("Email should be in email format.");
//         return false;
//     }
//
//     if (!passwordPattern.test(password)) {
//         alert("Password must contain at least 8 characters, and it must be a combination of numbers and letters.");
//         return false;
//     }
//
//     // All validations passed
//     return true;
// }
//
// function registerUser(data){
//     ajaxCallBack('registration', "POST",{data} ,function (message){alert(message.message)}, function (error){alert(error)})
// }
//
// function ajaxCallBack(url,method, data,onSuccess,onError){
//     $.ajax({
//         url,
//         method,
//         data: data,
//         dataType:"json",
//         success: onSuccess,
//         error: onError,
//     })
// }

let countriesSelectTag = document.querySelector('#countries-select');
let citySelectTag = document.querySelector('#city-select');

countriesSelectTag.addEventListener('change', e=>{
    let selectedIndex = e.target.value;
    if(selectedIndex==0) return;
    $.ajax({
        url: `/city/${selectedIndex}`,
        method: "GET",
        dataType: "JSON",
        success:({cities})=>{
            let options = insertCities(cities)
            citySelectTag.innerHTML = options;
            citySelectTag.removeAttribute('disabled')
        },
        error:(error)=>{
            console.log(error)
        }
    })
})


function insertCities(cities){
    let html = `
         <option value="0">Choose your city</option>
    `;
    cities.forEach(city=>{
        html+=`
            <option value="${city.id}">${city.city}</option>
        `
    })

    return html;
}
