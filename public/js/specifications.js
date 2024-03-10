// let specifications = document.querySelector('#specifications');
// let addSpecification = document.querySelector('#addSpec');
// let specificationsWrapper = document.querySelector('.specifications-wrapper');
//
// addSpecification.addEventListener('click', function (e){
//     e.preventDefault();
//     let selectedSpecification = specifications.value;
//     if(Number(selectedSpecification)===0) return
//     specificationsWrapper.innerHTML+= `
//          <div class="form-group">
//             <div class="row align-items-end">
//                 <div class="col-4">
//                     <label for="exampleInputEmail1">${specifications.options[selectedSpecification].textContent}</label>
//                     <input type="text" class="form-control" placeholder="Please provide specification value" id="exampleInputEmail1">
//                     <input type="hidden" class="form-control" value="${selectedSpecification}" id="exampleInputEmail1">
//                 </div>
//                 <div class="col-3">
//                     <button class="btn btn-lg btn-danger remove-spec">Delete specification</button>
//                 </div>
//             </div>
//           </div>
//     `
// })
//
//
// $(document).on('click', '.remove-spec',e=>{
//     let specToRemove = e.target.closest('.form-group');
//         specToRemove.remove();
// })


document.addEventListener('DOMContentLoaded', function () {
    const addSpecificationBtn = document.getElementById('addSpec');
    const specificationsWrapper = document.querySelector('.specifications-wrapper');
    const specificationsSelect = document.getElementById('specifications');

    addSpecificationBtn.addEventListener('click', function (e) {
        e.preventDefault();

        const selectedSpecification = specificationsSelect.value;

        if (Number(selectedSpecification) === 0) return;

        // Create a new specification element
        const specificationElement = document.createElement('div');
        specificationElement.classList.add('form-group');

        specificationElement.innerHTML = `
            <div class="row align-items-end">
                <div class="col-4">
                    <label for="spec-${selectedSpecification}">${specificationsSelect.options[specificationsSelect.selectedIndex].textContent}</label>
                    <input type="text" class="form-control" placeholder="Please provide specification value" id="spec-${selectedSpecification}" name="specifications[${selectedSpecification}][value]">
                    <input type="hidden" class="form-control" value="${selectedSpecification}" name="specifications[${selectedSpecification}][id]">
                </div>
                <div class="col-3">
                    <button class="btn btn-lg btn-danger remove-spec">Delete specification</button>
                </div>
            </div>
        `;

        specificationsWrapper.appendChild(specificationElement);
    });

    // Add event delegation for removing specifications
    specificationsWrapper.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-spec')) {
            e.preventDefault();
            e.target.closest('.form-group').remove();
        }
    });

});
