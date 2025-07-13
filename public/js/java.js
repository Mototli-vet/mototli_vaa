function CargarListado() {
  ListaMascota();
}

function ListaMascota() {
  
  var mascota = [
    "RAMON",
    "Perros",
    "Gatos",
  ];

  var select = document.getElementById("format");
  
    for (var i = 0; i < mascota.length; i++) {
    select.options[i] = new Option(mascota[i]);
  }
}
function mostrar(){
   
       var mascota = document.getElementById("Mascotas");
       var login =document.getElementById("login")
       var contenedor =document.getElementById("contenedor")
       var botones =document.getElementById("Botones")
        var botones2 =document.getElementById("Botones2")
       
            mascota.style.display = "block";
            contenedor.style.display = "block";
            botones.style.display = "block";
            botones2.style.display = "block";
            login.style.display = "none";
  
}
 
function SeleccionaTuMascota() {
   
   var mas =document.getElementById("format").value
  var edad = document.getElementById("Edad").value;
   var nombre = document.getElementById("Nombre").value;
  var text;



  switch (mas) {
    case "RAMON":
      if (edad >= 18) {
        window.alert("Bienvenid@ " + nombre + " a la Veterinaria");
        window.alert("Serás redirigid@ a la página de tu mascota seleccionada: " + mas);
        window.location.href = "carnet.html"; // Redirecciona a la página HTML de Hamsters
      } else {
        window.alert("No tienes edad suficiente para adoptar una mascota");
        window.alert("Edad mínima 18 años. Regresar con un adulto responsable");
        window.alert("Te esperamos " + nombre + " !!");
      }
      break;

   case "Perros":
      if (edad >=18) {
      text ='<input title="Macota01"onclick="perro01()" type="image" class="perro01" src="https://fordogtrainers.es/images/razas-de-perros/V/perro-de-raza-viringo-peruano.jpg"/><input title="Macota02"onclick="perro02()" type="image" class="perro02" src=" https://www.ecured.cu/images/1/14/Labrador-Retriever.jpg" /><input title="Macota03"onclick="perro03()" type="image" class="perro03" src="https://www.hola.com/imagenes/estar-bien/20180823128631/cosas-que-quizas-no-sabias-de-tu-pastor-aleman-cs/0-593-146/cosassobrepastoraleman-t.jpg " /><input title="Macota04"onclick="perro04()" type="image" class="perro04" src="https://www.mrperros.com/wp-content/uploads/2019/08/cropped-golden-retriever-1.jpg"/><input title="Macota05"onclick="perro05()" type="image" class="perro05" src=" https://www.mrperros.com/wp-content/uploads/2019/10/Yorkshire-Terrier1.jpg" />'
           document.getElementById("Mascotas").innerHTML = text; 
         mostrar()
           window.alert("Bienvenid@ "+nombre+" a la Veterinaria")
            window.alert("A contuniacion observaras tu mascosta seleccionada :"+mas)
        }else{
          window.alert("No tienes edad suficiente para apdotar una mascota")
          window.alert("Edad minima 18 años.. Regresar con un adulto Responsable")
           window.alert("Te esperamos "+nombre+" !!")
        }
       break;

    case "Gatos":
      if (edad >=18) {
text='<input title="Macota01"onclick="gato01()" type="image" class="gato01" src="https://http2.mlstatic.com/gatitos-azul-ruso-machos-y-hembras-100-legitimos-D_NQ_NP_977431-MLM29073140802_122018-F.jpg"/><input title="Macota02"onclick="gato02()" type="image" class="gato02" src=" https://gatos.pe/wp-content/uploads/2015/07/American-Wirehair-Pictures.jpg" /><input title="Macota03"onclick="gato03()" type="image" class="gato03" src="https://okdiario.com/img/2019/11/20/razas-de-gatos_-el-burmilla-655x368.jpg" /><input title="Macota04"onclick="gato04()" type="image" class="gato04" src="https://www.dogalize.com/wp-content/uploads/2017/02/gato-britanico-de-pelo-corto-azul.jpg"/><input title="Macota05"onclick="gato05()" type="image" class="gato05" src="https://www.feelcats.com/blog/wp-content/uploads/2019/07/ragdoll-gato-raza.jpg"/>'
         document.getElementById("Mascotas").innerHTML = text; 
         mostrar()
           window.alert("Bienvenid@ "+nombre+" a la Veterinaria")
            window.alert("A contuniacion observaras tu mascosta seleccionada :"+mas)
        }else{
          window.alert("No tienes edad suficiente para apdotar una mascota")
          window.alert("Edad minima 18 años.. Regresar con un adulto Responsable")
           window.alert("Te esperamos "+nombre+" !!")
        }
break;
  
  } 

}
  

/*Hamster*/

function Hamster01(){
      window.alert("Hamster Dorado: Cuando nacen son tan pequeños que pesan de 1 a 2 gramos. Cuando crecen, el macho adulto pesa entre 80 y 135 gramos, siendo la hembra algo mayor, entre 90 y 150 gramos. Tienen una esperanza de vida de 2 a 3 años.")
    }

function Hamster02(){
      window.alert("Hamster Ruso: Tiene una esperanza de vida de año y media a dos años y medio. Su peso ronda los 40-50 gramos y a los 20 días alcanzan su madurez sexual.")
    }

function Hamster03(){
      window.alert("Hamster Cambell: Su pequeño tamaño, entre 6 y 12 centímetros, lo convierten en una de las mascotas preferidas para quienes desean adoptar un roedor en casa. Este roedor también dispone de espacio de almacenaje en sus mejillas (abazón) para poder transportar comida o materiales para hacer el nido.")
}
function Hamster04(){
      window.alert("Hamster Roborowski: Es una de las especies de hámster enano más pequeñas. Su pequeño tamaño, de 5 centímetros de longitud aproximadamente, lo convierte en un hámster muy manejable para tener como mascota. Su peso es de tan sólo 20 o 25 gramos en edad adulta y son animales muy sociales, dóciles y muy activos.")
}
function Hamster05(){
      window.alert("Hamster Chino: Se trata de un hámster delgado, fino y alargado, parecido al ratón. Tiene una esperanza de vida de año y medio a dos años y medio. Alcanzan su madurez sexual a los 30 días, teniendo 4-5 camadas al año y sus camadas son de entre 2 y 12 crías.")
}
/*Perros*/

function perro01(){
      window.alert("Perro peruano: En nuestro país se han identificado tres tipos de perro sin pelo. Según su tamaño se clasifican en pequeño (entre 25 y 40 cm de alto), mediano (entre 40 y 50 cm) y grande (entre 50 y 65 cm).El color de la piel es variable, puede ser negro, marrón o gris, incluso en algunos ejemplares se aprecian manchas rosadas en ciertas partes del cuerpo.")
    }
  
function perro02(){
      window.alert("Labrador: Es una raza muy sociable, y eso le hace ser gran compañero de otros perros y niños. Siempre está deseoso de tener nuestra atención, el Labrador Retriever se convertirá en un perro paciente que agradecerá enormemente cualquier muestra de cariño que le brindemos. Son perros con mucho entusiasmo.")
    }
  
function perro03(){
      window.alert("Pastor Aleman: El Pastor alemán, siempre en boga, listo y fácil de adiestrar, es bastante activo y disfruta cuando tiene algo que hacer. Por ello, necesitan realizar gran cantidad de ejercicio a diario; de lo contrario, se vuelven nerviosos o muy excitables.")
    }

function perro04(){
      window.alert("Yorkshire: De origen inglés y pequeñas dimensiones, el Yorkshire Terrier se caracteriza por ser una raza inteligente y con una fuerte personalidad. Su peso no suele superar los 3,2 Kg y, pese a entrar dentro de la categoría de perro de compañía, goza de un temperamento inquieto y muy activo.")
    }
  
function perro05(){
      window.alert("Golden retriever:Como los Golden retrievers (o cobradores dorados) son perros con ganas de agradar y responden positivamente al adiestramiento en obediencia. Complementan este rasgo con el hecho de ser juguetones, cariñosos y de temperamento apacible.")
    }
  


/*Gatos*/
function gato01(){
      window.alert("Azul Ruso: El azul ruso es un gato mediano, con un cuerpo grácil, patas largas y un peso de entre 3 y 5 kg, por lo que es muy distinto a los fornidos gatos británicos de pelo corto. En cambio, el cartujo se le parece bastante, menos en los ojos, que son de color amarillo mientras que los de los azules rusos son de un brillante color esmeralda.")
    }
  
function gato02(){
      window.alert("American Wirehair:El gato american wirehair constituye una de las razas más nuevas y a la vez más especiales de nuestros días. Es llamada, también, gato americano de pelo duro y posee una apariencia tan adorable como particular. ")
    }
  
function gato03(){
      window.alert("Burmilla:El burmilla es un gato de tamaño medio, pero de complexión fuerte y robusto. Esta raza es algo compacta, pese a ser muy musculosa y tener una osamenta robusta.Es un gato de aspecto redondo, la cabeza es redonda y las puntas de las orejas son redondas. El burmilla es cariñoso y dulce y resulta un buen compañero.")
    }
  
function gato04(){
      window.alert("Gato Británico de pelo corto: El Británico de pelo corto es un gato muy fuerte de tamaño entre medio y grande. Tiene mucha musculatura y huesos robustos. Su aspecto es redondeado y grueso. Tiene un pecho ancho, un cuello musculoso, mandíbulas fuertes y un hocico bien desarrollado. Las patas son gruesas y fuertes.")
    }
  
function gato05(){
      window.alert("Gato Ragdoll: El Ragdoll es un gato grande de cuerpo alargado. Tiene huesos robustos, una cola larga y un pelaje afelpado.El pelo consigue que la cara parezca grande. Las orejas también son de tamaño medio y están colocadas en los laterales de la cabeza contribuyendo al aspecto triangular de la cara.")
    }

function Regresar(){
  
      var mascota = document.getElementById("Mascotas");
       var login =document.getElementById("login")
       var contenedor =document.getElementById("contenedor")
       var botones =document.getElementById("Botones")
        var botones2 =document.getElementById("Botones2")
       
            mascota.style.display = "none";
            contenedor.style.display = "none";
            botones.style.display = "none";
            botones2.style.display = "none";
            login.style.display = "block";

} 

function NombreMascota(){
  
 var mascota01= window.prompt("Nombre de la Mascota 01")
 var mascota02= window.prompt("Nombre de la Mascota 02")
 var mascota03= window.prompt("Nombre de la Mascota 03")
 var mascota04=window.prompt("Nombre de la Mascota 04")
 var mascota05=window.prompt("Nombre de la Mascota 05")
 
  
  const Nombres = [];
  const count = Nombres.push((mascota01),(mascota02),(mascota03),(mascota04),(mascota05));


  console.log(Nombres)
  

};
const toggleBtn = document.getElementById("toggleAlert");
const alertStatus = document.getElementById("alertStatus");
const mapSection = document.getElementById("mapSection");

let alertActive = true;

toggleBtn.addEventListener("click", () => {
  alertActive = !alertActive;

  if (alertActive) {
    alertStatus.textContent = "🔔 Alerta activa";
    alertStatus.classList.add("active");
    mapSection.style.display = "block";
    toggleBtn.textContent = "Desactivar Alerta";
  } else {
    alertStatus.textContent = "🔕 Alerta inactiva";
    alertStatus.classList.remove("active");
    mapSection.style.display = "none";
    toggleBtn.textContent = "Activar Alerta";
  }
});

