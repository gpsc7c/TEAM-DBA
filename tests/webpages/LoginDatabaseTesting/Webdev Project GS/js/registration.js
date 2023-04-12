window.onload= function() {

}
// All chk functions follow a general template of declare lets and retrieve data, check for valid entry or existent entry
// format if necessary, git div elements and based on whether the check was successful or not, remove errors, successes,
// and none attributes, then repeat with the relevant error text for shown and hidden classes
function chkPasswords(){
    let pass = document.getElementById("password");
    let repeat = document.getElementById("passwordrepeat");
    if (pass && repeat){
        if (pass.value.length < 8){
            let passDiv = document.getElementById("passdiv")
            if(passDiv){
                pass.classList.remove("has-none");
                pass.classList.remove("has-error");
                pass.classList.add("has-error");
                pass.classList.remove("has-success");
            }
            let passErr = document.getElementById("passerr");
            if (passErr){
                passErr.classList.remove("hidden");
                passErr.classList.add("shown");
                passErr.classList.remove("hidden");
            }
        return false;
        } else if (!validatePW(pass.value)){
            let passDiv = document.getElementById("passdiv");
            if(passDiv){
                pass.classList.remove("has-none");
                pass.classList.remove("has-error");
                pass.classList.add("has-error");
                pass.classList.remove("has-success");
            }
            let passErr2 = document.getElementById("passerr2");
            if (passErr2){
                passErr2.classList.add("shown");
                passErr2.classList.remove("hidden");
            }
            return false;
        } else {
            let passDiv = document.getElementById("passdiv");
            if(passDiv){
                pass.classList.remove("has-none");
                pass.classList.add("has-success");
                pass.classList.remove("has-error");
            }
            let passErr = document.getElementById("passerr");
            let passErr2 = document.getElementById("passerr2");
            if (passErr){
                pass.classList.remove("has-none");
                passErr.classList.add("hidden");
                passErr.classList.remove("shown");
            }
            if (passErr2){
                passErr2.classList.add("hidden");
                passErr2.classList.remove("shown");
            }
        }
        if (pass.value != repeat.value){
            let repPassDiv =document.getElementById("reppassdiv");
            if(repPassDiv){
                repeat.classList.remove("has-none");
                repeat.classList.add("has-error");
                repeat.classList.remove("has-success");
            }
            let repPassErr =document.getElementById("reppasserr")
            if(repPassErr){
                repPassErr.classList.add("shown");
                repPassErr.classList.remove("hidden");
            }
            return false;
        } else {
            let repPassDiv =document.getElementById("reppassdiv");
            if(repPassDiv){
                repeat.classList.remove("has-none");
                repeat.classList.add("has-success");
                repeat.classList.remove("has-error");
            }
            let repPassErr =document.getElementById("reppasserr");
            if(repPassErr){
                repPassErr.classList.add("hidden");
                repPassErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false
}
function chkUserName(){
    let name =document.getElementById("username");
    if (name) {
        if (name.value.length < 6) {
            let nameDiv = document.getElementById("namediv")
            if (nameDiv) {
                name.classList.remove("has-none");
                name.classList.add("has-error");
                name.classList.remove("has-success");
            }
            let nameErr = document.getElementById("nameerr");
            if (nameErr) {
                nameErr.classList.add("shown");
                nameErr.classList.remove("hidden");
            }
            return false;
        } else {
            let nameDiv = document.getElementById("namediv");
            if (nameDiv) {
                name.classList.remove("has-none");
                name.classList.add("has-success");
                name.classList.remove("has-error");
            }
            let nameErr = document.getElementById("nameerr");
            if (nameErr) {
                nameErr.classList.add("hidden");
                nameErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkPhoneNumber(){
    let phone =document.getElementById("phonenumber");
    if (phone) {
        if (!phoneValidate(phone)) {
            let phoneDiv = document.getElementById("phonediv")
            if (phoneDiv) {
                phone.classList.remove("has-none");
                phone.classList.add("has-error");
                phone.classList.remove("has-success");
            }
            let phoneErr = document.getElementById("phoneerr");
            if (phoneErr) {
                phoneErr.classList.add("shown");
                phoneErr.classList.remove("hidden");
            }
            return false;
        } else {
            let phoneDiv = document.getElementById("phonediv");
            phone.value = phone.value.replace(/\D/g, "");
            phone.value = phone.value.slice(0, 3) + "-" + phone.value.slice(3, 6) + "-" + phone.value.slice(6);
            ;
            if (phoneDiv) {
                phone.classList.remove("has-none");
                phone.classList.add("has-success");
                phone.classList.remove("has-error");
            }
            let phoneErr = document.getElementById("phoneerr");
            if (phoneErr) {
                phoneErr.classList.add("hidden");
                phoneErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkZip(){
    let zip =document.getElementById("zipcode");
    if (zip) {
        if (!zipValidate(zip)) {
            let zipDiv = document.getElementById("zipdiv")
            if (zipDiv) {
                zip.classList.remove("has-none");
                zip.classList.add("has-error");
                zip.classList.remove("has-success");
            }
            let zipErr = document.getElementById("ziperr");
            if (zipErr) {
                zipErr.classList.add("shown");
                zipErr.classList.remove("hidden");
            }
            return false;
        } else {
            let zipDiv = document.getElementById("zipdiv");
            zip.value = zip.value.replace(/\D/g, "");
            if (zip.value.length == 9) {
                zip.value = zip.value.slice(0, 4) + "-" + zip.value.slice(4);
            }
            if (zipDiv) {
                zip.classList.remove("has-none");
                zip.classList.add("has-success");
                zip.classList.remove("has-error");
            }
            let zipErr = document.getElementById("ziperr");
            if (zipErr) {
                zipErr.classList.add("hidden");
                zipErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkMail(){
    let mail = document.getElementById("email")
    if (mail) {
        //as mail validation is effectively one line, did not feel the need to pass into a separate function.
        let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (!mail.value.match(validRegex)) {
            let mailDiv = document.getElementById("maildiv")
            if (mailDiv) {
                mail.classList.remove("has-none");
                mail.classList.add("has-error");
                mail.classList.remove("has-success");
            }
            let mailErr = document.getElementById("mailerr");
            if (mailErr) {
                mailErr.classList.add("shown");
                mailErr.classList.remove("hidden");
            }
            return false;
        } else {
            let mailDiv = document.getElementById("maildiv");
            if (mailDiv) {
                mail.classList.remove("has-none");
                mail.classList.add("has-success");
                mail.classList.remove("has-error");
            }
            let mailErr = document.getElementById("mailerr");
            if (mailErr) {
                mailErr.classList.add("hidden");
                mailErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
///////////////////////////////////////////////////////////////////
// NOTE: All chk functions past this point until chkGen are ///////
// roughly the same format with only differences being whe- ///////
// ther the check is for value length or for an empty string///////
// based on if a selection box is used or not.              ///////
///////////////////////////////////////////////////////////////////
function chkAddress(){
    let addr = document.getElementById("address")
    if (addr) {
        if (addr.value.length < 1) {
            let addrDiv = document.getElementById("addressdiv")
            if (addrDiv) {
                addr.classList.remove("has-none");
                addr.classList.add("has-error");
                addr.classList.remove("has-success");
            }
            let addrErr = document.getElementById("addrerr");
            if (addrErr) {
                addrErr.classList.add("shown");
                addrErr.classList.remove("hidden");
            }
            return false;
        } else {
            let addrDiv = document.getElementById("addressdiv");
            if (addrDiv) {
                addr.classList.remove("has-none");
                addr.classList.add("has-success");
                addr.classList.remove("has-error");
            }
            let addrErr = document.getElementById("addrerr");
            if (addrErr) {
                addrErr.classList.add("hidden");
                addrErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkLast(){
    let lastn = document.getElementById("lastname")
    if (lastn) {
        if (lastn.value.length < 1) {
            let lastDiv = document.getElementById("lastdiv")
            if (lastDiv) {
                lastn.classList.remove("has-none");
                lastn.classList.add("has-error");
                lastn.classList.remove("has-success");
            }
            let lastnErr = document.getElementById("lastnerr");
            if (lastnErr) {
                lastnErr.classList.add("shown");
                lastnErr.classList.remove("hidden");
            }
            return false;
        } else {
            let lastDiv = document.getElementById("lastdiv");
            if (lastDiv) {
                lastn.classList.remove("has-none");
                lastn.classList.add("has-success");
                lastn.classList.remove("has-error");
            }
            let lastnErr = document.getElementById("lastnerr");
            if (lastnErr) {
                lastnErr.classList.add("hidden");
                lastnErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkFirst(){
    let firstn = document.getElementById("firstname")
    if (firstn){
        if (firstn.value.length < 1) {
            let firstDiv = document.getElementById("firstdiv")
            if (firstDiv) {
                firstn.classList.remove("has-none");
                firstn.classList.add("has-error");
                firstn.classList.remove("has-success");
            }
            let firstnErr = document.getElementById("firstnerr");
            if (firstnErr) {
                firstnErr.classList.add("shown");
                firstnErr.classList.remove("hidden");
            }
            return false;
        } else {
            let firstDiv = document.getElementById("firstdiv");
            if (firstDiv) {
                firstn.classList.remove("has-none");
                firstn.classList.add("has-success");
                firstn.classList.remove("has-error");
            }
            let firstnErr = document.getElementById("firstnerr");
            if (firstnErr) {
                firstnErr.classList.add("hidden");
                firstnErr.classList.remove("shown");
            }
            return true;
        }
    }
}
function chkCity(){
    let city = document.getElementById("city")
    if (city) {
        if (city.value.length < 1) {
            let cityDiv = document.getElementById("citydiv")
            if (cityDiv) {
                city.classList.remove("has-none");
                city.classList.add("has-error");
                city.classList.remove("has-success");
            }
            let cityErr = document.getElementById("cityerr");
            if (cityErr) {
                cityErr.classList.add("shown");
                cityErr.classList.remove("hidden");
            }
            return false;
        } else {
            let cityDiv = document.getElementById("citydiv");
            if (cityDiv) {
                city.classList.remove("has-none");
                city.classList.add("has-success");
                city.classList.remove("has-error");
            }
            let cityErr = document.getElementById("cityerr");
            if (cityErr) {
                cityErr.classList.add("hidden");
                cityErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkState(){
    let state = document.getElementById("usstates")
    if (state) {
        if (state.value == "") {
            let stateDiv = document.getElementById("statediv")
            if (stateDiv) {
                state.classList.remove("has-none");
                state.classList.add("has-error");
                state.classList.remove("has-success");
            }
            let stateErr = document.getElementById("stateerr");
            if (stateErr) {
                stateErr.classList.add("shown");
                stateErr.classList.remove("hidden");
            }
            return false;
        } else {
            let stateDiv = document.getElementById("statediv");
            if (stateDiv) {
                state.classList.remove("has-none");
                state.classList.add("has-success");
                state.classList.remove("has-error");
            }
            let stateErr = document.getElementById("stateerr");
            if (stateErr) {
                stateErr.classList.add("hidden");
                stateErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkBirth(){
    let bday = document.getElementById("birthday")
    if (bday) {
        if (bday.value == "") {
            let birthDiv = document.getElementById("birthdiv")
            if (birthDiv) {
                bday.classList.remove("has-none");
                bday.classList.add("has-error");
                bday.classList.remove("has-success");
            }
            let birthErr = document.getElementById("birtherr");
            if (birthErr) {
                birthErr.classList.add("shown");
                birthErr.classList.remove("hidden");
            }
            return false;
        } else {
            let birthDiv = document.getElementById("birthdiv");
            if (birthDiv) {
                bday.classList.remove("has-none");
                bday.classList.add("has-success");
                bday.classList.remove("has-error");
            }
            let birthErr = document.getElementById("birtherr");
            if (birthErr) {
                birthErr.classList.add("hidden");
                birthErr.classList.remove("shown");
            }
            return true;
        }
    }
    return false;
}
function chkMari(){
    const options = document.querySelectorAll('input[name="marid"]');
    if (options) {
        for (const option of options) {
            if (!option.checked) {
                let marDiv = document.getElementById("marindiv")
                if (marDiv) {
                    marDiv.classList.remove("has-none");
                    marDiv.classList.add("has-error");
                    marDiv.classList.remove("has-success");
                }
                let marErr = document.getElementById("marierr");
                if (marErr) {
                    marErr.classList.add("shown");
                    marErr.classList.remove("hidden");
                }
            } else {
                let marDiv = document.getElementById("marindiv");
                if (marDiv) {
                    marDiv.classList.remove("has-none");
                    marDiv.classList.add("has-success");
                    marDiv.classList.remove("has-error");
                }
                let marErr = document.getElementById("marierr");
                if (marErr) {
                    marErr.classList.add("hidden");
                    marErr.classList.remove("shown");
                }
                return true;
            }
        }
    }
    return false;
}
function chkGen(){
    const options = document.querySelectorAll('input[name="genderid"]');
    if (options) {
        for (const option of options) {
            if (!option.checked) {
                let genDiv = document.getElementById("genidindiv")
                if (genDiv) {
                    genDiv.classList.remove("has-none");
                    genDiv.classList.add("has-error");
                    genDiv.classList.remove("has-success");
                }
                let genErr = document.getElementById("generr");
                if (genErr) {
                    genErr.classList.add("shown");
                    genErr.classList.remove("hidden");
                }
            } else {
                let genDiv = document.getElementById("genidindiv");
                if (genDiv) {
                    genDiv.classList.remove("has-none");
                    genDiv.classList.add("has-success");
                    genDiv.classList.remove("has-error");
                }
                let genErr = document.getElementById("generr");
                if (genErr) {
                    genErr.classList.add("hidden");
                    genErr.classList.remove("shown");
                }
                return true;
            }
        }
    }
    return false;
}
//validation functions separated for ease of use
function validatePW(pw){
    return  /[A-Z]/       .test(pw) &&
        /[a-z]/       .test(pw) &&
        /[0-9]/       .test(pw) &&
        /[^A-Za-z0-9]/.test(pw) /*should probably NOT do this as it could cause nightmares with zero width spaces and
                                      other weird characters and instead put in a whitelist of standard keyboard, characters
                                      but for the purposes here it will work.*/
}
function phoneValidate(pn){
    pn = pn.value.replace(/\D/g, "");
    if (pn.length != 10) {
        return false;
    } else {
        return true;
    }
}
function zipValidate(zc){
    zc = zc.value.replace(/\D/g, "");
    if (zc.length != 9 && zc.length != 5) {
        return false;
    } else if (zc.length == 9){
        return true;
    } else {
        return true;
    }
}

function regHandlers() {
    //note to self, this is really ugly looking, should look into using template literals to compress
    //List of onblur handlers and handler at submission
    document.getElementById("username").onblur = chkUserName;
    document.getElementById("password").onblur = chkPasswords;
    document.getElementById("passwordrepeat").onblur = chkPasswords;
    document.getElementById("phonenumber").onblur = chkPhoneNumber;
    document.getElementById("zipcode").onblur = chkZip;
    document.getElementById("email").onblur = chkMail;
    document.getElementById("address").onblur = chkAddress;
    document.getElementById("firstname").onblur = chkFirst;
    document.getElementById("lastname").onblur = chkLast;
    document.getElementById("city").onblur = chkCity;
    document.getElementById("usstates").onblur = chkState;
    document.getElementById("birthday").onblur = chkBirth;
    document.getElementById("genidindiv").onblur = chkGen;
    document.getElementById("marindiv").onblur = chkMari;
    document.getElementById("submit").addEventListener("mouseover", chkAll, false)
    //prevention of form data sending is user has not finished
    document.getElementById("regi").addEventListener("submit", function(e){
        if(!chkAll()){
            e.preventDefault();    //stop form from submitting
        }
    });
}
//function to check the entire form's state for submission
function chkAll(){
    let submitter = document.getElementById("submit")
    if ((chkUserName() && chkPasswords() && chkPhoneNumber() && chkZip() && chkMail() && chkAddress() && chkFirst() && chkLast() && chkState()
    && chkCity() && chkBirth() && chkGen() && chkMari()) != true){
        let subDiv = document.getElementById("subdiv")
        if(subDiv){
            submitter.classList.remove("has-none");
            submitter.classList.add("has-error");
            submitter.classList.remove("has-success");
        }
        let subErr = document.getElementById("suberr");
        if (subErr){
            subErr.classList.add("shown");
            subErr.classList.remove("hidden");
        }
        return false;
    } else {
        let subDiv = document.getElementById("subdiv")
        if(subDiv){
            submitter.classList.remove("has-none");
            submitter.classList.add("has-success");
            submitter.classList.remove("has-error");
        }
        let subErr = document.getElementById("suberr");
        if (subErr){
            subErr.classList.add("hidden");
            subErr.classList.remove("shown");
        }
        return true;
    }
}
