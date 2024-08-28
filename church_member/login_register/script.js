let resets = document.querySelector('button');
 let inputs = document.querySelectorAll('input');

 resets.addEventListener('click', () =>{
     inputs.forEach(input => input.value = '');
 });
 

