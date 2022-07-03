let container = document.getElementById("container");

/////////////////////////////////////////////
//GET - obtener datos

fetch("https://jsonplaceholder.typicode.com/posts")
    .then(response => response.json()) //.json() convierte el cuerpo de la promesa en un objeto json
    .then(data => {
        for(let element of data){
            let p = document.createElement("p");
            let text = document.createTextNode(element.id + " - " + element.title);
            p.appendChild(text);
            container.appendChild(p);
        }
        //data.forEach(createElements); //llamando a una funcion para cada elemento del array
    })


//Con fragment para evitar reflow o retraso en la carga de la pagina
/* let postFragment = document.createDocumentFragment();
    
function createElements(element){
    let p = document.createElement("p");
    let text = document.createTextNode(element.id + " - " + element.title);
    p.appendChild(text);
    postFragment.appendChild(p);
    container.appendChild(postFragment);
    //no sirve porque en cada iteraccion añade el fragment al elemento del DOM, al no poder sacar el contenido 
    //del fragment fuera de la funcion, puesto que se llama en cada iteracion del array
} */


////////////////////////////////////////////
//POST - insertar datos creándolos
fetch("https://jsonplaceholder.typicode.com/posts",{
    method : "POST",
    body : JSON.stringify({//para convertir un objeto JS (JSON) a string y poder enviarlo al servidor
        id : 101,
        title : "HELLO THERE"
    }),
    headers : {
        "Content-type" : "application/json"
    }
}).then( response => response.json())
  .then( data => console.log(data))


////////////////////////////////////////////
//PUT - actualizar datos, lee y escribe
fetch("https://jsonplaceholder.typicode.com/posts/100",{
    method : "PUT",
    body : JSON.stringify({//para convertir un objeto JS (JSON) a string y poder enviarlo al servidor
        id : 100,
        title : "HELLO THERE"
    }),
    headers : {
        "Content-type" : "application/json"
    }
}).then( response => response.json())
  .then( data => console.log(data))

///////////////////////////////////////////
//PATCH - actualizar datos, pero solo ciertas propiedades
//Igual que put pero sin inidcar todas las propiedades del objeto a actualizar

///////////////////////////////////////////
//DELETE - obtiene un dato eliminandolo del servidor
fetch('https://jsonplaceholder.typicode.com/posts/100', {
  method: 'DELETE',
}).then( response => response.json())
  .then( data => console.log(data))
