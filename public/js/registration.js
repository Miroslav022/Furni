let countriesSelectTag = document.querySelector('#countries-select');
let citySelectTag = document.querySelector('#city-select');

checkCountryOnLoad();
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


function insertCities(cities, cityId=null){
    console.log(cityId)
    let html = `
         <option value="0">Choose your city</option>
    `;
    cities.forEach(city=>{
        html+=`
            <option value="${city.id}" ${city.id==cityId ? 'selected' : ''}>${city.city}</option>
        `
    })

    return html;
}

function checkCountryOnLoad(){
    let selectedCountry = countriesSelectTag.value;
    let city = document.querySelector("#cityId");
    if(!city) return;
    let cityId = city.dataset.id;
    // if(city.dataset.id === null) return
    if(Number(selectedCountry)) {
        $.ajax({
            url: `/city/${selectedCountry}`,
            method: "GET",
            dataType: "JSON",
            success:({cities})=>{
                let options = insertCities(cities, cityId)
                citySelectTag.innerHTML = options;
                citySelectTag.removeAttribute('disabled')
            },
            error:(error)=>{
                console.log(error)
            }
        })
    }
}
