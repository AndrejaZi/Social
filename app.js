function submitClicked(e){
    //Ovo je trebalo da proveri poslatu formu i oznaci da one elemente koji se ne poklapaju standardu, ali zbog restarta strane pri slaju forme, ne radi kako treba. Plus ima jos neki problem
    //dogadjaj se aktivirao pritiskom na 'submit'
    let fname = document.querySelector(".inputFname");
    let lname = document.querySelector(".inputLname");
    let email = document.querySelector(".email");
    let emailCheck = document.querySelector(".emailCheck");
    let pass = document.querySelector(".password");
    let passwordCheck = document.querySelector(".passwordCheck");
    //alert(`Name: ${fname} lName: ${lname} email: ${email} check: ${emailCheck} pass: ${pass} pCheck: ${passwordCheck}`);

    if(fname.value === "" || fname.value === undefined){
        fname.style.border = "solid 1px red";
    }

    if(lname.value === "" || lname.value === undefined){
        lname.style.border = "solid 1px red";
    }

    if(email.value === "" || email.value === undefined){
        email.style.border = "solid 1px red";
    }
    else if(email.value !== emailCheck.value){
        email.style.border = "solid 1px red";
        emailCheck.style.border = "solid 1px red";
    }

    if(emailCheck.value === "" || emailCheck.value === undefined){
        emailCheck.style.border = "solid 1px red";
    }

    if(pass.value === "" || pass.value === undefined){
        pass.style.border = "solid 1px red";
    }
    else if(pass.value !== passwordCheck){
        passCheck.style.border = "solid 1px red";
        pass.style.border = "solid 1px red";
    }

}