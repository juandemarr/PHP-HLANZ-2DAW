abrir servidor desde la carpeta del proyecto con symfony server:start
acceder desde localhost:8000
symfony, laravel
engynx (= apache)
descargar composer, como npn
descargar symfony.com es un cliente para usar los paquetes de symfony
dentro de htdocs: symfony new --full nombreProyecto (este --full es opcional, para descargarlo todo,
 recomendable)

Dentro de src esta controllers 
                    entity y repository serian los models
en templates estan las vistas
public seria la "raiz" donde poner css js etc. No tocar index.php
var y vendor es el propio symfony

.env es la config de la app:
    app_env=dev quiere decir que esta development, cuando esta listo cambiar a prod
    DATABASE_URL="mysql://root:@127.0.0.1:3306/blogsymfony"
    añadir APP_DEBUG=1

Hay que entrar en proyecto1/public en el navegador para verlo, con xampp abierto
*dentro de la carpeta de proyecto, symfony server:start para crear un servidor
*http://localhost:8000/
*ctrl + c desde cmd para parar el servidor

/////////PARA CREAR CONTROLADOR, DENTRO DE LA CARPETA DEL PROYECTO
php bin/console make:controller nombreController
para cualquier controlador se define una funcion asociada a una ruta
en @Route("/",name="main")
public function index(): Response //significa que devuelve un objeto de tipo Respnse (pag web). Crea una vista

///////////////TWIG. Sistema de etiquetas que admite programacion
{{}} //equivale a echo
{% %} //equivale a bloque php, pero solo uno por linea e instruccion

///////////ENTITY son models
*php bin/console make:entity movie
escribir las propiedades del modelo
id esta por defecto
title pide el tipo de dato, y si puede ser nulo
hacer migration cuando este el modelo listo. Si ponemos una bd ya existente, lo borra todo y crea esto
*php bin/console make:migration
*php bin/console doctrine:migrations:migrate
Para actualizar un modelo, se escribe lo mismo y deja añadir nuevas propiedades. Ponerlas que acepte null
xk sino revienta al haber ya datos y tendrian null

//Para quitar una propiedad, borrarla del model y hacer migracion. De esta forma actualziara la BD

php bin/console doctrine:schema:update //si la migracion no funciona, esto borra todo lo que haya y
 lo actualiza con los modelos existentes

en el controlador
getDoctrine() es acceder a la BD
*****
$movies = $this->getDoctrine()
->getRepository('App:Movie')
->findAll() //definido de forma predeterminada en el repositorio este metodo
*****

en la vista
{% for movie in movies%}
{{movie.title}}
aqui se accede con . en lugar de ->


//////////////////////PROCESO
crear login, Crear controlador, crear entidad, migrar, crear funciones en repositorio, 
obtenerlas en el controlador y mandar esas variables abajo, en la vista 
.twig usar esas variables


///////////////SECURITY
composer require symfony/security-bundle
usuario entidad especial: php bin/console make:user
    nombre clase
    que se guarde en la bd
    campo unico: username
    que valide contraseñas si. symfony encripta las contarseñas predert.
dsp hacer los dos comandos de migracion

//Hacer para que envie codigo cada vez que un usuario se registre
composer require symfonycasts/verify-email-bundle
conf servidor de correo electronico. Mas adelante

/////////crear form login
php bin/console make:auth
    1 para q cree form login
    clase del autenticador: UserAuth
    nombre del controlador: por defect
    /logout yes
Se crea en la carpeta security
Security, AuthAuthenticator -> onAuthenticationSucess, en TODO comentar la linea de throw exception y descomentar la de arriba
en return poner la ruta -main-

//////////crear form registro
php bin/console make:registration-form
    para q no se dupliquen cuentas: yes
    email de verificacion: no, mas adelante si
    que se loguee automaticamente dsp del registro: no
    a que ruta queires que se redirija: login, si no esta creado main

para mostrar el nombre del usuario en la vista twig: app.user.username

en el main controller para usarlo:
$username=$this->getUser()->getUsername(); //$this es la entidad de la ejecucion, equivalente a la sesion,
        // solo tendremos ahí al usuario

///////////////ROLES
en bd creamos dentro de ["ROLE_ADMIN"]
por defecto en el modelo user se añade ROLE_USER. Aunque en la bd solo salga ROLE_AMDIN, 
por defecto tbn tiene ROLE USER
preferible usar en la vista {{ app.user.username }} que {{username}} ya que este hay que crearlo en el coontrolador

is_granted("IS_AUTHENTICATED") es si existe el rol AUTHNETICATED,
     uno predeterminado, si existe el usuario. NO FUNCIONA si hay roles en los usuarios
is_granted("ROLE_ADMIN") es si el usuario LOGUEADO es admin

//LOS CSS Y JS en la carpeta public, y se añaden en base.twig

//CREDENCIALES
admin admin1
user1 user11

//PARA CREAR OTRA VISTA
se crea el .twig, se repite el comentario Route y la funcion.
Cuando se vaya a esa ruta, se ejecutara esa funcion.


Tbn se puede crear un controlador a mano, copiando el principio de otro controlador, cambiandole el nombre y
 la ruta para cambiar datos en la bd
Para tratar las distintas variables que llegan, aqui con /, se van anidando dentro de la ruta principal del 
controlador, en este caso /movie

///////////INSERT
persist hace la consulta y flush el guardar
$em = $this->getDoctrine()->getManager();
$em->persist($movie);
$em->flush();

///////Otra forma de doctrine
--- Otra forma
use Doctrine\ORM\EntityManagerInterface;

esto como parametro del metodo: EntityManagerInterface $entityManager

$entityManager->persist($pokemon);
$entityManager->flush();//guarda los cambios


IMPORTANTE: for in es el for normal en symfony, no tienen nada que ver con for in o for of de js

////////PARA PASAR VARIABLE POR RUTA
EN LA VISTA TWIG con dos {{}}
<a href="/users/admin/{{user.id}}">Make admin</a>
equivale a admin=user.id
EN EL CONTROLADOR con un {}
/**
 * @Route("/hide/{id}", name="hideMovie") ////Se nombra igual que el parametro a pasar en la funcion
 */
  public function hide($id): Response ////Para usar esa variable con $id hay que pasarla como parametro primero
  {
    $id
  }


///////////////CREAR METODOS EN REPOSITORIOS
En los repositorios, al copiar metodos para crearlos, si vamos a obtener varios resultados copiar el 
primero con getResult()
si vamos a obtener un solo resultado, copiar el segundo con ->getOneOrNullResult()


////////////ANIDAR
al poner la ruta encima de la clase controlador, no ponerle el nombre name= para que no entre en conflicto 
con la que hereda debajo, @Route("/")

////////////////PARA ASIGNAR UNA VARIABLE DENTRO DE TWIG, con SET
//tbn se puede crear en el controlador y enviar a renderizar
{% set foo = 'foo' %}
{% set foo = [1, 2] %}
{% set foo = {'foo': 'bar'} %}

también se puede usar ​​para «capturar» trozos de texto:
{% set foo %}
  <div id="pagination">
    ...
  </div>
{% endset %}


///////////redirectToRoute()
redirectToRoute equivale a header(location:), recarga una vista, ponerle el nombre de name, puesto en @Route
            
para renderizar hay que tener antes una serie de datos cargados, equivalente a require_once
si no se hace ningun calculo  no es necesario

///////////FORM
php bin/console make:crud  primero hacer entity, despues esto
escribimos la entidad, y luego el controlador
localhost:8000/movie nombre de la entidad

Para añadir un nuevo campo, hacer make:entity de la entidad existemte, añadir campo y hacer migracion a bd

Para modificar un form, irse a la carpeta form, MovieType y en builder quitar visible y añadir year
esto no es necesario para el proyecto del blog

///////////////RELACIONES
saber que usuario ha creado la peli
php bin/console make:entity Movie
author
relation
User (clase a relacionar)
ManyToOne
puede ser nulo, en este caso no
yes a que cada usuario pueda ver todas las creadas
nombre: movies
no a borrar en cascada, segun sea

hacer migacion
dara error ya que las creadas no tienen autor, borrar la tabla
php bin/console doctrine:schema:update --force
si da error, borarlo manualmente de phpmyadmin

para este nuevo dato, hay que añadirlo al form, por ahora borramos el crud y lo creamos de nuevo.
Mas adelante modificaremos el form

de la carpeta src, borra el movie controller, del form el movietype, y de templates la carpeta movie
make:crud

error de no poder una entidad como string, porque al hacer el form, hace un select con los nombres del usuario para elegir el usuario que creo la peli
ir a la entidad usuario y añadir public function __toString(){
  return $this->getUsername;
}

////////////////ACCEDER AL USUARIO DE LA SESSION

Para listar las peliculas subidas por el usuario
en mainController:
if($this->isGranted("ROLE_USER"))
  $username=$this->getUser()->getUsername();

Ó
en la vista
{% if is_granted('ROLE_USER') %} para que no pete si no ha iniciado sesion
app.user.movies, al estar detro del objeto user que ha iniciado sesion
no haria falta añadir nada al controlador


///////////////////////////
si da error get->doctrine(), lo podemos pasar como argumento de la funcion en el controlador:
public function show(ManagerDoctrine $doctrine, int $id)
{
  $product = $doctrine->getRepository(Product::class)->find($id)
}

tbn se puede pasar el repos
arriba tener el use App\Repository\MovieRepository;
public function index(MovieRepository $movieRepository)
y ya no hace falta usar el doctrine al tener el repositorio

en controlador: $pokemonRepository->findAll()

////////////////PARA PONER CAMPOS CON DATOS AUTOMATICOS EN LA ENTIDAD; SIN CAMBIAR EL FORM
dentro de movieController
$comment->setPost(idPost) se toquetea el entity, no se modifica el form


RESUMEN
make:user (campo unico username), make:auth, make:registration-form, make:migration, doctrine:migrations:migrate
make:controller, make:entity, make:crud

//Para añadir el autofocus a un form creado en el controaldor:
use Symfony\Component\Form\Extension\Core\Type\TextType;
->add('username', TextType::class,[
      'attr' => ['autofocus' => 'autofocus']
    ]
)

HAY QUE AÑADIR EL META VIWEPORT PARA PODER HACER RESPONSIVE EN TIWG, base.html.tiwg
<meta name="viewport" content="width=device-width, initial-scale=1.0">

Si en un metodo de un controlador quiero redirigir a la ruta de otro controlador, basta con importar ese controlador
use App\Controller\MainController;

Para linkar los css, empezar por /

//////////////////FORM
Cada form tiene un id, para ponerlos repe en cada post, hay q crearlos mannualmente para pasarle un id
mas adelante lo veremos, ahora creamos boton para que mande a ese documento

Para guardas datos de forma auto en la entidad comentario, añadir los set dentro del commentController,
dentro de if ($form->isSubmitted() && $form->isValid()) {

Para guardar datos de forma auto, del valor que obtenemos por url, obtenemos el objeto entero accediendo
al repositorio, porque al hacer setTimeDate() hay que pasarle un objeto, no un string

////////////PARA ACCEDER A $_GET Y $_POST
en el controlador: use Symfony\Component\HttpFoundation\Request;
como parametro de la funcion Request $request
y dentro $request->query->get('foo')  //////recupera la variable GET
$request->request->get('bar')  //////recupera la variable POST

//////////////////////EQUIVALENTE A $_SESSION
$this->getUser tengo acceso desde cualquier sitio y controlador

////////////////FECHAS
date('d-m-Y')


////////Para mostrar cada post en una vista independiente, usar el show
////////e form del delete es solo un boton, se pone en el main y tenemos ya ese boton con el alert de la 
confirmacion

/////////////BUNDLE 
/////////////EASE ADMIN
composer require easycorp/easyadmin-bundle
php bin/console make:admin:dashboard //pide una entidad para crear el panel de control
php bin/console make:admin:crud

en DASHBOARD CONTROLLER añadir esto, para que muestre uun crud por defecto en la pagina principal
 de easyadmin => /admin
----1. //redirect to some CRUD controller
  $routeBuilder = $this->get(AdminUrlGenerator::class);

  return $this->redirect($routeBuilder->setController(PokemonCrudController::class)->generateUrl());

añadir los use entity
use App/Entity/pkemon

en elmenu
----2. yield MenuItem::section etc...
yield MenuItem::linkToCrud('Pokemon' ,' fa fa-tags' , Pokemon::class)

crear make:admin:crud para todas las entidades, pedira el nombre de la entidad y se le indica,
para que el menu funcione ya que redirecciona a ese crud

/////////////////

en pokemonCrudController añadir los campos a mostrar, poner tbn los use arriba de cada campo usado
1. se añaden en configureFields
return [
  IdField::new('id')->hideOnForm(), //el hide oculta ese campo en todos los form de añadir, editar etc.
hay mas metodos, buscar con el nombre del metodo,configureFields easyadmin symfony en google
2. use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

////////////////

Se puede hacer toda la pag con easy admin, se pueden añadir mas rutas para cada crud y cambiar el /admin en
el DashboardController

///////////////////////////////
///////////////////////////////
FORM
////////////////////////////
dos formas de mostrar un form, con {{form_widget}} que mete todoo lo de pokemonType
Otra: {{form_row}} como aparece en el register
/////
en form, pokemonType, lo que define que se define cuando creamos o editamos una instancia

Obligatorio poner confirmaciones al borrar o editar

form-widget carga los campos puestos en pokemonType
------1. para cambiar el tipo del campo del add copiar y cambiar esto
->add('name', TextType::class, ['required' => true, 'attr' => ['class','input']]) 
cualquier atrib de html permitido, dentro de esos []

use Symfony\Component\Form\Extension\Core\Type\TextType;

'mapped' => true si ese campo del form esta asociado a un atributo de la entidad
false cuando no, por ejemplo el checkbox de aceptar las condiciones no esta asociado a la entidad

'required' si el campo es obligatorio

'mimeTypes' => [
    'image/jpeg'
  ]

-------2. Añadir estos use:
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

  al subir archivos a la web, se guarda en una carpeta temporal, hay que moverlo a una carpeta publica y cambiarle el nombre
/////// A copiar dentro del pokemon controller new pokemon
Hay que añadir esto como parametro del function para usar el slugger 
SluggerInterface $slugger

y el use
use Symfony\Component\String\Slugger\SluggerInterface;

////En la vista, para poner la url en img src y poner /img , necesita esa barra delante

///////en config, services.yaml
funciona con las tabulaciones, cuidado
en el campo parameters añadir lo de brochures directory

para poner ese parametro aqui en el controller al new de subir pokemon
$this->getParameter('images_directory'),
este getParameter coge los parametros globales de services.yaml


////como la imagen no tiene qque ser obligatoria en edit, y todos los form se crean de la misma plantilla
 de PokemonType, poner aqui require false, y en pkemon controller en new, en el if de si ha llegado la imagen,
 poner else 

//tpv virtual, cecabank es el mas famoso de españa


////////////FORM MANUALES
//para los form creados en html por post, en el main controller añadir Request $request en los aprametros de la funcion. 
Esto recibe tanto get como post
$txtBuscar = $request->get('txtBuscar'); este get coge solo los post
$request->query->get('txtBuscar') para coger los get

Añadir:
use Symfony\Component\HttpFoundation\Request;

Si hay una ruta /buscar y /{id} poner el buscar arriba para que no lo interprete como un id

en symfony en lugar de var_dump se puede usar tbn dump()


///////////CAMBIOS DE FORMA ASINCRONA PARA QUE NO RECARGUE



////////////Para hacer un join en una consulta, no se puede como tal, hacer dos consultas y luego fusionar los dos arrays
o usar https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/native-sql.html


//API REST
controlador que contiene consulta, subir, modificar o borrar
para enviar POST (metodo add), recibir con GET, update se usa PUT, para borrar DELETE
array asociativo, x ejemplo obtiene los datos de la bd, crea un array asociativo y eso es lo que devuelve al front 
devuelve un json

php bin/console debug:form DateType
Para recibiir ayuda sobre una clase


//FORM TIPO FECHA:
->add('fechaNac', DateType::class, [
                'input' => 'string',
                'widget' => 'choice',
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Día',
                ],
                'years' => range(1920,date('Y')),
                'label' => 'Fecha de nacimiento'
            ])
en este range se coge la fecha actual como tope



///PARA QUITAR UN LABEL required generado del postType automaticamente
añadirle una clase con 'label_attr' => ['class' => 'desc']


////////////FECHA
date('d-m-Y')
-- en español
setlocale(LC_TIME, 'es-ES'); SI NO FUNCIONA
$meses = ["01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Dicembre"];
$mes = strftime('%m');
$fecha = strftime("%d de $meses[$mes] de %G - %H horas");


--- Usar una entidad sin llamar al repositorio
public function viewPokemon(Pokemon $p): Response //al indicarle la entidad a la que pertenece esa variable,
    //symfony lo encuentra solo sin tener que buscarlo con la linea de abajo
    //solo sirve cuando es uno a obtener
    {
        //$pokemon = $this->getDoctrine()->getManager()->getRepository("App:Pokemon")->findOneById($id);
        
        return $this->render('main/pokemon.html.twig', [
            'controller_name' => 'MainController',
            'p' => $p //se puede quitar, necesario para el enlace
        ]);
    }


////////LIKES como atributo en post, relacion con user de muchos a muchos
solo hay que guardarlo en un sitio, post


--- Para la longitud de un array:
{{post.getLikes|length}}


--- Para ver si un elemento está en el array
  en twig: {% if post in usuario.getLikesPost%}
  en controller o entity es contains: if (!$this->comments->contains($comment))


  En un div que con hover aparezca otro div que se superpone con enlaces, a este ultimo añadirle:
  onclick="window.location='/post/{{post.id}}'" para que tenga otro enlace


///////////////////
en twig  <a href="/post/like/{{post.id}}">
  Hay que pasarle un string, por eso de pasar el objeto, tendra que tener el metodo __toString()

/**
     * @Route("/like/{post}", name="add_like", methods={"GET"})
     */
    public function addLike(Post $post)

  aunque en el controlador no use el parametro sino la entidad user, symfony lo asocia automaticamente al passarle
   el id, si le paso el nombre, tengo que hacer un metodo en el repositorio findUserByName, A NO SER
   si se pone como argumento el mismo nombre que cualquier atributo de la entidad, symfony tbn lo asocia

/////////////////////////////
granateck
cordova: pack de html, css y jquery


////////si se pone {% blockstylesheet %} susyituye a lo que tenga el padre, por lo que se le pone dentro {{parent()}}
y asi se mantiene


--- Borrar un usuario haciendo logout antes:
$this->get('security.token_storage')->setToken(null);
$entityManager->remove($user);
$entityManager->flush();
$session->invalidate(0);

pasarle como argumento a la funcion delete(SessionInterface $session)

use Symfony\Component\HttpFoundation\Session\SessionInterface;


--- JOIN
public function feed($value)
    {
        //como indico que esos user esten en followed (array de relacion en user)
        return $this->createQueryBuilder('p')
            ->join('p.autor' , 'u')
            //se coge el campo que hace de union entre ambas tablas, y este u es el alias que se le pone a la tabla 
            //que se va a relacionar
            ->join('u.followed' , 'f')
            //ahora este usuario tiene que estar en la otra tabla followed
            ->andWhere('f.id = :val')
            //ese followed debo ser yo, para ver sus post, por lo que el id es el de mi usuario
            ->setParameter('val', $value->getId())
            //es mejor pasar el objeto user entero y aqui coger su id
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

Para que no me cambie la foto del header, se usa app.user.footPerfil, no le paso la variable de usuario


Para ver el contenido de una variable del controlador, con dump($var) y luego exit; lo muestra en la vista,, sin
tener que mandarselo al render

$fecha = new \DateTime()


--- PARA BORRAR UN ARCHIVO FISICO como la img de un post guardado en local
use Symfony\Component\Filesystem\Filesystem;

$img = $repo->findImgById($post->getId())->getFoto();
  $fs = new Filesystem(); //Para borrar el archivo fisico 

  try{
    $fs->remove($this->getParameter('images_directory').'/'.$img);
  }catch(FileException $e){

}