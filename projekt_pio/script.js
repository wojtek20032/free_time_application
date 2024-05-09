
const wrapper = document.querySelector('.wrapper'); 
const loginLink = document.querySelector('.login-link'); 
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');
registerLink.addEventListener('click', ()=> {
    document.getElementById('register_form').reset();
    document.getElementById('login_form').reset();
    wrapper.classList.add('active');
});
loginLink.addEventListener('click', () => {
    document.getElementById('register_form').reset();
    document.getElementById('login_form').reset();
    wrapper.classList.remove('active');
});
