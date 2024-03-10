let forma = document.querySelector('#rewiew-form');
let reviewsBlock = document.querySelector(".reviews-block")

forma.addEventListener('submit',e=>{
    e.preventDefault()
    const formData = new FormData(forma);
    let title = formData.get('title')
    let review = formData.get('message')
    let product_id = formData.get('product_id')
    if(title==="" || review ==="") {
       return toast("Please provide a value for each field.", 'danger');
    }
    $.ajax({
        url: "/recensions",
        method: "POST",
        data: {
            "title": title,
            "rewiew" : review,
            "product_id": product_id

        },
        dataType: "JSON",
        success: (recensionInfo)=>{
            toast("You have successfully added recension");
            appendReview(title, review, recensionInfo.name, recensionInfo.recension_id)
        },
        error:()=>{
            toast("Something is wrong", 'danger');

        }
    })
})

$(document).on('click', '.remove-btn', e=>{
    let btn = e.target;
    let id = Number(btn.dataset.id);

    let recensionToRemove = e.target.closest('.recension');
    console.log(id)
    if(!id) return;
    $.ajax({
        url: "/recensions/"+id,
        method: 'DELETE',
        success:()=>{
            recensionToRemove.remove();
        },
        error:()=>{
            toast("Something is wrong", 'danger')
        }
    })

})

function appendReview(title, recension, name, recension_id){
    reviewsBlock.innerHTML+=`
        <div class=" mt-3 d-flex justify-content-between align-items-center recension">
            <div class=" mt-3 edu-comment d-flex gap-3">
                <div class="thumbnail"> <img class="rec-img" src="${window.location.origin}/images/user.png" alt="Comment Images"> </div>
                <div class="comment-content">
                    <div class="comment-top">
                        <h6 class="title">${name}</h6>
                        <div class="rating"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i> </div>
                    </div>
                    <span class="subtitle text-dark">“${title} ”</span>
                    <p>${recension}</p>
                </div>
            </div>

                <div>
                    <a class="btn btn-danger remove-btn" data-id="${recension_id}">Remove review</a>
                </div>
        </div>
    `
}


