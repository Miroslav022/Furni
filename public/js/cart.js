const cartBody = document.querySelector('#cart-body');
const total = document.querySelector('.totalPrice');
const subTotal = document.querySelector('.sub-total');

//load cart data for the first time
loadCart()

//Remove from cart
cartBody.addEventListener('click', e => {
    e.preventDefault();

    let btn = e.target.closest('.destroy')
    if (!btn) return;
    let id = btn.dataset.id;

    console.log(btn);
    $.ajax({
        url: `/cart/${id}`,
        method: "DELETE",
        dataType: 'json',
        success: () => {
            toast("You are successfully deleted product")
            fetchCart();
        },
        error: () => {
            toast("There is a problem with removing product form cart.", 'danger')
        }
    })

})

//Update cart
$(document).on('click', '.item', function (e) {
    let increaseBtn = e.target.closest('.increase');
    let decreaseBtn = e.target.closest('.decrease');

    let productQuantityContainer = e.target.closest('.quantity-container')
    let parentElement = e.currentTarget;

    let price = parentElement.querySelector('.price').textContent.substring(1);
    let totalContainer = parentElement.querySelector('.total');


    if (increaseBtn) {
        let quantityInput = productQuantityContainer.querySelector('.quantity-amount');
        let product_id = productQuantityContainer.dataset.id;

        if (!quantityInput) return
        let quantityValue = Number(quantityInput.value);
        quantityValue++;
        quantityInput.value = quantityValue;

        calculateTotalProductPrice(totalContainer, price, quantityValue);

        $.ajax({
            url: `/cart/${product_id}`,
            method: "PATCH",
            data: {quantity: quantityValue},
            dataType: "JSON",
            success: () => {
                cartTotal()
            },
            error: () => {
                toast('error', 'danger')
            }
        })
    } else if (decreaseBtn) {
        let quantityInput = productQuantityContainer.querySelector('.quantity-amount');
        let product_id = productQuantityContainer.dataset.id;

        if (!quantityInput) return
        let quantityValue = Number(quantityInput.value);
        if (quantityValue === 1) return
        quantityValue = quantityValue - 1
        quantityInput.value = quantityValue;
        calculateTotalProductPrice(totalContainer, price, quantityValue);
        $.ajax({
            url: `/cart/${product_id}`,
            method: "PATCH",
            data: {quantity: quantityValue},
            dataType: "JSON",
            success: () => {
                console.log('uspeo')
                cartTotal()
            },
            error: () => {
                toast('error', 'danger')
            }
        })
    }


})
function loadCart(){
    $('table').hide();
    fetchCart()
    $(".loader").remove();
    $('table').show();
}
function fetchCart() {
    $.ajax({
        url: `/cart`,
        method: "get",
        dataType: 'json',
        success: ({products}) => {
            if (products.length > 0) {
                let cart = printCart((products));
                cartBody.innerHTML = cart;
                cartTotal()

            } else {
                emptyCart()
            }
        },
        error: () => {
            toast("There is a problem with fetching product form cart.", 'danger')
        }
    })
}

function printCart(products) {
    let html = ``
    products.forEach(product => {
        let total = product.product.price * product.quantity;
        html += `
            <tr class="item">
                <td class="product-thumbnail">
                    <img src="products/${product.product.bg_image}" alt="Image" class="img-fluid">
                </td>
                <td class="product-name">
                    <h2 class="h5 text-black">${product.product.product_name}</h2>
                </td>
                <td class="price">$${product.product.price}</td>
                <td>
                    <div class="input-group mb-3 d-flex align-items-center quantity-container" data-id ='${product.product.cart_item_id}' style="max-width: 120px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center quantity-amount" value="${product.product.quantity}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-black increase" type="button">&plus;</button>
                        </div>
                    </div>

                </td>
                <td class="total">$${total.toFixed(2)}</td>
                <td><a href="#" class="btn btn-black btn-sm destroy" data-id="${product.product.cart_item_id}">X</a></td>
            </tr>
        `
    })


    return html;

}
function calculateTotalProductPrice(totalContainer, price, quantityValue) {
    let totalProductPrice = Number(price) * Number(quantityValue)
    totalContainer.innerHTML = `$${totalProductPrice.toFixed(2)}`
}
function emptyCart(){
    $('.cart-container').html(`<div class="alert alert-danger" role="alert">
                 Empty cart!
                </div>`)
    $('.coupon-container').remove();
    $('.cart-container').append(`
                    <div class="col-md-6">
                        <a href="/shop" class="btn btn-outline-black btn-sm btn-block">Go Shopping</a>
                    </div>`)
}
function cartTotal(){
    let productsTotal = document.querySelectorAll('.total');
    console.log(productsTotal)
    let subTotalCartPrice = 0;
    productsTotal.forEach(product=>{
        // console.log(Number(product.textContent.substring(1)))
        subTotalCartPrice+= Number(product.textContent.substring(1));
    })
    subTotalCartPrice = subTotalCartPrice.toFixed(2)
    let totalCartPrice = Number(subTotalCartPrice)+20;
    totalCartPrice = totalCartPrice.toFixed(2)

    subTotal.innerHTML = "$"+subTotalCartPrice;
    total.innerHTML = "$"+totalCartPrice;

}
