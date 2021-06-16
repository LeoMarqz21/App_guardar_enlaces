import {Login} from './module.js';

// Login();

const login = document.getElementById('login');
login.addEventListener('click', (event) => {
    const user = document.getElementById('L_user').value;
    const pass = document.getElementById('L_pass').value;
    if(user.length > 3 && pass.length > 4){
        const formData = new FormData();
        formData.append('user', user);
        formData.append('pass', pass); 
    }else{
        
    }
});