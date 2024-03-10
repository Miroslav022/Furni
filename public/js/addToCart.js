const productSection = document.querySelector('#productSection');
//Add To Cart
productSection.addEventListener('click', e=>{
    const btn = e.target.closest('.addToCart');
    if(!btn) return;
    e.preventDefault();

    console.log(btn);
    let productId = btn.dataset.id;
    $.ajax({
        url:'/cart',
        method:"POST",
        data: {product_id : productId},
        dataType: 'json',
        success: ()=>{
            toast('Product has added to cart.')
        },
        error:()=>{
            toast("There is a problem while adding product into cart.", 'danger')
        }
    })
})
