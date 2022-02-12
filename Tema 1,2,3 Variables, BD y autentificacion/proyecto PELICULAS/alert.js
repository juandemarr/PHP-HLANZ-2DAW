function alerta(){
    Swal.fire({
    icon:'success',
    text:'User registered successfully',
    timer:'2100',
    timerProgressBar:true,
    showConfirmButton:false,
    /*width:'25rem',*//*default:32rem*/
    /*padding:1rem,*//*default: 1.25rem*/
    iconColor:'#28a745'
})
    setTimeout(redirection=>{location.href = "index.php";},2100);
    
}

function loginForRate(){
    Swal.fire({
        icon:'warning',
        text:'Log in for rate',
        confirmButtonColor:'#28a745'
    })
}

function userAlreadyRated(){
    Swal.fire({
        icon:'error',
        text:'You have already rated this film',
        confirmButtonColor:'#28a745'
    })
}

function deleteYes(){
    Swal.fire({
        icon:'success',
        text:'The film has been deleted',
        confirmButtonColor:'#28a745'
    })
}

function deleteNo(){
    Swal.fire({
        icon:'error',
        text:'The film cannot be deleted',
        confirmButtonColor:'#28a745'
    })
}

function editYes(){
    Swal.fire({
        icon:'success',
        text:'The film has been edited',
        confirmButtonColor:'#28a745'
    })
}

function editNo(){
    Swal.fire({
        icon:'error',
        text:'The film cannot be edited',
        confirmButtonColor:'#28a745'
    })
}

function addFilmYes(){
    Swal.fire({
        icon:'success',
        text:'The film has been added',
        confirmButtonColor:'#28a745'
    })
}

function addFilmNo(){
    Swal.fire({
        icon:'error',
        text:'The film cannot be added',
        confirmButtonColor:'#28a745'
    })
}