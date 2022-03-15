function addProductSuccess(){
    Swal.fire({
        icon:'success',
        text:'A fine addition to my collection',
        timer:'2100',
        timerProgressBar:true,
        showConfirmButton:false,
        /* iconColor:'#28a745' */
    })
    setTimeout(redirection=>{location.href = "index.php?admin-products";},2100); 
}
function editProductSuccess(){
    Swal.fire({
        icon:'success',
        text:'Recalibration complete',
        timer:'2100',
        timerProgressBar:true,
        showConfirmButton:false,
    })
    setTimeout(redirection=>{location.href = "index.php?admin-products";},2100); 
}