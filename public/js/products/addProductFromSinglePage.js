let atcBtn = document.querySelector('.addToCart');
let inventories = document.querySelectorAll('.inventories-checkbox');
let quantityOperations = document.querySelector('.quantity-operations');
let quantityInputElement = document.querySelector('.quantity');

isOutOfStock()

atcBtn?.addEventListener("click", e => {

    let isCheckedInventory = false;
    let inventory_id = null;

    inventories.forEach(inventory => {
        if (inventory.checked) {
            isCheckedInventory = true;
            inventory_id = inventory.value;
        }
    })

    if (!isCheckedInventory) {
        toast('Please select from which location you want to order the product.', 'danger')
        return
    }
    let btn = e.target;
    let product_id = btn.dataset.id;
    let quantity = quantityInputElement.value;

    let data = {
        'product_id': product_id,
        "inventory_id": inventory_id,
        "quantity" : quantity
    }
    console.log(data);
    $.ajax({
        url:'/cart',
        method:"POST",
        data: data,
        dataType: 'json',
        success: ()=>{
            toast('Product has added to cart.')
        },
        error:()=>{
            toast("There is a problem while adding product into cart.", 'danger')
        }
    })
})

quantityOperations.addEventListener('click', e=>{
    let btnIncrease = e.target.closest('.increase');
    let btnDecrease = e.target.closest('.decrease');
    let maxQuantity = null
    if(btnDecrease) {
        let quantity = Number(quantityInputElement.value);
        if(quantity===1) return;
        quantity = quantity-1;
        quantityInputElement.value = quantity;
    } else if(btnIncrease) {
        inventories.forEach(inventory=>{
            if(inventory.checked) maxQuantity = inventory.dataset.qty;
        })
        if(!maxQuantity) {
            toast("Please choose the location from which you want to order.", 'danger')
            return;
        }
        if(Number(maxQuantity)===0) return
        let quantity = Number(quantityInputElement.value);
        console.log(quantity, Number(maxQuantity))
        if(quantity===Number(maxQuantity)) return;
        quantity = quantity+1;
        quantityInputElement.value = quantity;
    }
    return
})

inventories.forEach(inv=>{
    inv.addEventListener('change',e=>{
        resetAtcBtn()
        let inventory = e.target;
        if(inventory.checked){
            let qty = Number(inventory.dataset.qty);
            if (qty===0){
                outOfStockBtnStyle()
                quantityInputElement.setAttribute('disabled', 'true');
                return
            }
        }
    })
})

function outOfStockBtnStyle(){
    atcBtn.textContent='Out of stock';
    atcBtn.classList.add('disabled-link')
}
function resetAtcBtn(){
    atcBtn.innerHTML=' <i class="me-1 fa fa-shopping-basket"></i> Add to cart';
    atcBtn.classList.remove('disabled-link')
}

function isOutOfStock(){
    inventories.forEach(inventory=>{
        if(inventory.checked){
            let qty = Number(inventory.dataset.qty);
            if (qty===0){
                atcBtn.textContent='Out of stock';
                return
            }
        }
    })
}

