const connexionBtn = document.getElementById('connexion');
const inscriptionBtn = document.getElementById('inscription');

const loginBlock = document.getElementById('login-form');
const registerBlock = document.getElementById('register-form');

if(connexionBtn){
    connexionBtn.addEventListener('click', ()=>{
        if(inscriptionBtn.classList.contains('payment-authtab-active')){
            inscriptionBtn.classList.remove('payment-authtab-active');
        }
        if(!connexionBtn.classList.contains('payment-authtab-active')){
            connexionBtn.classList.add('payment-authtab-active');
        }

        if (loginBlock.classList.contains('hidden')) {
            loginBlock.classList.remove('hidden');
        }
        if(!registerBlock.classList.contains('hidden')){
            registerBlock.classList.add('hidden');
        }
    })
}

if(inscriptionBtn){
    inscriptionBtn.addEventListener('click', ()=>{
        if(connexionBtn.classList.contains('payment-authtab-active')){
            connexionBtn.classList.remove('payment-authtab-active');
        }
        if(!inscriptionBtn.classList.contains('payment-authtab-active')){
            inscriptionBtn.classList.add('payment-authtab-active');
        }

        if(registerBlock.classList.contains('hidden')){
            registerBlock.classList.remove('hidden');
        }

        if (!loginBlock.classList.contains('hidden')) {
            loginBlock.classList.add('hidden');
        }
    })
}



const registerPassword  = document.getElementById('register-password');
const confirmPassword = document.getElementById('confirm-password');
const validateConfirmPassword = ()=>{
    if(registerPassword.value){
        if(confirmPassword.classList.contains('focus:border-etudes-orange')){
            confirmPassword.classList.remove('focus:border-etudes-orange')
        }

        if(confirmPassword.value === registerPassword.value && !confirmPassword.classList.contains('border-green-500')){
            confirmPassword.classList.add('border-green-500')
        }else{
            if(confirmPassword.classList.contains('border-green-500')){
                confirmPassword.classList.remove('border-green-500')
            }

            if(!confirmPassword.classList.contains('border-red-500')){
                confirmPassword.classList.add('border-red-500')
            }
        }
    }else{
        if(!confirmPassword.classList.contains('focus:border-etudes-orange')){
            confirmPassword.classList.add('focus:border-etudes-orange')
        }
    }
}
if(confirmPassword){
    confirmPassword.addEventListener('input', ()=>{
        validateConfirmPassword();
    })
}
if(registerPassword){
    registerPassword.addEventListener('input', ()=>{
        validateConfirmPassword();
    })
}


const registerEmail  = document.getElementById('register-email');
const confirmEmail = document.getElementById('confirm-email');
const firstName = document.getElementById('first-name');
const lastName = document.getElementById('last-name');
const validateConfirmEmail = ()=>{
    if(registerEmail.value){
        if(confirmEmail.classList.contains('focus:border-etudes-orange')){
            confirmEmail.classList.remove('focus:border-etudes-orange');
        }

        if(confirmEmail.value === registerEmail.value && !confirmEmail.classList.contains('border-green-500')){
            confirmEmail.classList.add('border-green-500')
        }else{
            if(confirmEmail.classList.contains('border-green-500')){
                confirmEmail.classList.remove('border-green-500');
            }

            if(!confirmEmail.classList.contains('border-red-500')){
                confirmEmail.classList.add('border-red-500');
            }
        }
    }else{
        if(!confirmEmail.classList.contains('focus:border-etudes-orange')){
            confirmEmail.classList.add('focus:border-etudes-orange');
        }
    }
}
if(confirmEmail){
    confirmEmail.addEventListener('input', ()=>{
        validateConfirmEmail();
    })
}
if(registerEmail){
    registerEmail.addEventListener('input', ()=>{
        validateConfirmEmail();
    })
}

function isEmail(email) {

    // Regular Expression (Not accepts second @ symbol
    // before the @gmail.com and accepts everything else)
    var regexp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    // Converting the email to lowercase
    return regexp.test(String(email).toLowerCase());
}

const loginEmail = document.getElementById('login-email');
const loginPassword = document.getElementById('login-password');
const loginButton = document.getElementById('login-button');
const loginError = document.getElementById('login-error');
const loginForm = document.getElementById('login-form');
if(loginButton){
    loginButton.addEventListener('click', ()=>{
        if(!isEmail(loginEmail.value)){
            loginError.classList.remove('hidden');
            loginError.children[0].innerHTML = 'Veuillez saisir votre adresse email.'
        }else if(!loginPassword.value){
            loginError.classList.remove('hidden');
            loginError.children[0].innerHTML = 'Veuillez saisir votre mot de passe.'
        }

        if(isEmail(loginEmail.value) && loginPassword.value){
            const data = {
                'email' : loginEmail.value,
                'password' : loginPassword.value,
            }

            axios.post(`${ROOT_URL}/api/login-validation`, data)
            .then((response)=>{
                if(response.data.success){
                    loginForm.submit();
                }else{
                    loginError.classList.remove('hidden');
                    loginError.children[0].innerHTML = 'Email ou mot de passe incorrecte'
                }
            })
            .catch((error)=>{
                console.log(error);
            })
        }
    })
}

const registerButton = document.getElementById('register-button');
const registerError = document.getElementById('register-error');
const registerForm = document.getElementById('register-form');

if(registerButton){
    registerButton.addEventListener('click', ()=>{
        if(!lastName.value){
            registerError.classList.remove('hidden');
            registerError.children[0].innerHTML = 'Veuillez entrer votre nom';
        }else if(!firstName.value){
            registerError.classList.remove('hidden');
            registerError.children[0].innerHTML = 'Veuillez entrer votre prénom';
        }else if(!isEmail(registerEmail.value)){
            registerError.classList.remove('hidden');
            registerError.children[0].innerHTML = 'Veuillez entrer votre email';
        }else if(!registerPassword.value){
            registerError.classList.remove('hidden');
            registerError.children[0].innerHTML = 'Veuillez entrer un mot de passe';
        }else if(registerEmail.value !== confirmEmail.value){
            registerError.classList.remove('hidden');
            registerError.children[0].innerHTML = 'Vos deux emails ne correspondent pas';
        }
        else if(registerPassword.value !== confirmPassword.value){
            registerError.classList.remove('hidden');
            registerError.children[0].innerHTML = 'Vos deux mots de passe ne correspondent pas';
        }else{
            if(!registerError.classList.contains('hidden')){
                registerError.classList.add('hidden')
            }
            const data = {
                'first_name' : firstName.value,
                'last_name' : lastName.value,
                'email' : registerEmail.value,
                'password' : registerPassword.value,
                'confirm_password' : confirmPassword.value,
            }

            axios.post(`${ROOT_URL}/api/register-validation`, data)
            .then((response)=>{
                if(!response.data.exist && response.data.password){
                    registerForm.submit();
                    // console.log(response.data);
                }else if(response.data.exist){
                    registerError.classList.remove('hidden');
                    registerError.children[0].innerHTML = 'Ce compte existe déjà, essayez de vous connecter';
                }else if(!response.data.password){
                    registerError.classList.remove('hidden');
                    registerError.children[0].innerHTML = 'Vos deux emails ne correspondent pas';
                }
            })
            .catch((error)=>{
                console.log(error);
            })
        }
    })
}

function generateTimestampKey() {
    return new Date().getTime().toString();
}



const payButton = document.getElementById('pay-button');
const contactError = document.getElementById('contact-error');
const pay = ()=>{
    const contact = document.getElementById('contact') ? document.getElementById('contact').value : '';

    if(contact || document.getElementById('contact-value')){
        payButton.disabled = true
        let paiementPro = new PaiementPro('PP-F515');

        paiementPro.amount = document.getElementById('amount').value;
        paiementPro.channel = document.querySelector('input[name="method"]:checked').value;
        paiementPro.referenceNumber = generateTimestampKey();
        paiementPro.customerEmail = document.getElementById('user-email').innerHTML;
        paiementPro.customerLastname = document.getElementById('user-first_name').innerHTML;
        paiementPro.customerFirstName = document.getElementById('user-last_name').innerHTML;
        paiementPro.customerPhoneNumber = contact ? contact : document.getElementById('contact-value').innerHTML;
        paiementPro.description = 'Paiement d\'article';
        paiementPro.countryCurrencyCode = '952';
        paiementPro.returnURL = `${ROOT_URL}/payment/validate-payment`;
        paiementPro.notificationURL = `${ROOT_URL}/payment/validate-payment`;

        const Paiement_Pro = async() => {
            await paiementPro.getUrlPayment();
            if (paiementPro.success) {
                const data = {
                    id: document.getElementById('user').value,
                    contact: paiementPro.customerPhoneNumber,
                    token: paiementPro.referenceNumber,
                    amount: paiementPro.amount,
                    slug: SLUG,
                    product_type: TYPE
                }
                axios.post(`${ROOT_URL}/api/payment/preprocess`, data)
                .then((response)=>{
                    if(response.data.success){
                        window.location = paiementPro.url;
                    }
                })
                .catch((error)=>{
                    console.log(error);
                })
            } else {
                console.log(paiementPro.error);
                console.log('error');
                payButton.disabled = false;
            }
        };

        Paiement_Pro();
    }else{
        contactError.classList.remove('hidden');
        contactError.children[0].innerHTML = 'Veuillez saisir votre contact.'
    }
}

if(payButton){
    payButton.addEventListener('click', ()=>{
        pay();
    })
}
