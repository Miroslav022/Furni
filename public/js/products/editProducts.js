let prepareToAdd = document.querySelector('.prepareToAdd');
let addBtn = document.querySelector('.addWarehouse')
let inventory = document.querySelector('#inventory')

let is_added_warehouse = false


addBtn.addEventListener('click',e=>{
    e.preventDefault();
    if(!is_added_warehouse) $('.addWarehouses-warpper').html(' <button class="btn btn-success btn-lg ml-auto d-block add-inventory">Add warehouse</button>')
    is_added_warehouse = true;
    const inventory_id = inventory.value;
    const address = inventory.options[inventory.selectedIndex].textContent;
    // console.log(inventory_id, inventory.selectedIndex)

    prepareToAdd.insertAdjacentHTML('beforeend', (`
        <div class="col-lg-12 d-flex align-items-center mt-3">
            <div class="form-group each-inventory">
                <label class="form-control-label" for="qty">${address} - <b>Quantity</b></label>
                <input type="text" name="quantity" id="qty"
                       class="form-control form-control-alternative" placeholder="Enter product quantity">
                       <input type="hidden" value="${inventory_id}" class="inventory_id"/>
            </div>
            <button class="btn btn-danger btn-lg ml-2 remove-inventory" data-id="${inventory_id}">Delete</button>
        </div>
    `))

})

//Delete product image
removeItemFromTable('.removeImage', 'images', 'image')



//remove inventory
removeItemFromTable('.remove-inventory', 'product-inventories', 'inventory')


//remove specifications
$('.remove-spec').on('click', e=>{
    let id = e.target.dataset.id;

    $.ajax({
        url: `/admin/product-specification/${id}`,
        method: "DELETE",
        success: ()=>{
            toast("Specification has been successfully deleted")
        },
        error:()=>{
            toast("Something is wrong", 'danger')

        }
    })
})

//Add product inventory
$(document).on('click', '.add-inventory', e=>{
    e.preventDefault();
    let product_id =addBtn.dataset.id;

    let inventoriesToAdd = document.querySelectorAll('.each-inventory');
    let formData = [

    ]
    inventoriesToAdd.forEach(item=>{
        let inventory_id = item.querySelector('.inventory_id').value;
        let qty = item.querySelector('#qty').value;

        formData.push({
            inventory_id :inventory_id,
            product_id :product_id,
            quantity: qty
        })
    })
    console.log(formData)
    $.ajax({
        url: "/admin/product-inventories",
        method: "POST",
        dataType: "JSON",
        data:{formData},
        success: ()=>{
            toast("Successfully applied inventory changes")
        },
        error: ()=>{
            toast("Something is wrong", 'danger')
        }
    })
})
function removeItemFromTable(btnClass, url, table){
    $(document).on('click', btnClass, e=>{
        e.preventDefault()
        let btn = e.target;
        let idToRemove = btn.dataset.id;
        let parentElement = btn.closest('.'+table)
        $.ajax({
            url:`/admin/${url}/${idToRemove}`,
            method: "DELETE",
            dataType: "JSON",
            success:()=>{
                toast(`${table} has been successfully deleted`);
                parentElement.remove();
            },
            error:()=>{
                toast("Something is wrong", 'danger');
            }

        })
    })

}
