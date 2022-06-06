function validation(){
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

     if(username == 'loubna' && password == 'Annem'){
         alert(' Login successfuly!');
     }else{
         alert('Login failed!');
     }
}