{%  %} ejecutar una sentencia, hay que ponerlo ne cada linea necesaria
{{  }} equivalente a echo, solo mostrar variables
{% set var = valor %} con set se declara una variable

//////////////IF
{% if condicion %}
{% elseif %}
{% else %}
{% endif %}

///////////////BUCLES
{% for valor in array %}
{% else %} OPCIONAL, en caso de no haber registros se mostrara esto
{% endfor %}

{% for indice.valor in array %}
{% endfor %}

con el filtro keys tb devuelve las claves de un array asociativo
{% for key in array|keys %}
{% endfor %}

//////////////MACROS
Para no repetir un bloque de codigo en el cual solo cambian algunos valores
Se define una plantilla macros.html.twig
{% macro nombreMacro(type, name, value) %}
    <label for="{{ name }}">{{ name|capitalize }}</label>
    <input type="{{ type }}" name="{{ name }}" value="{{ value }}"/>
{% endmacro %}

Para importarlo:
{% import 'macros.html.twig' as macros %} Se le asigna un nombre para usarlo
{% for name.value in data %}
    {{ macros.nombreMacros(name,'text',value)}}
{% endofor %}

/////////////EXPRESIONES
{% block nombre %} define un bloque susceptible de ser sobreescrito en los hijos que extiendan de esta plantilla
{% endblock %} se le puede indicar el nombre del bloque tbn

{% extends 'nombrePlantilla' %}

{% filter nombreFiltro %} utiliza un filtro para un bloque completo
{ %endfilter %}

{% include "plantilla.html.twig" %} Incrusta otra plantilla dentro de la actual

{% verbatim %} Muestra el contenido interior tal cal sin interpretar
{% endverbatim %}

{% autoescape [|'html'|'js'|false] %} Marcar u nbloque para que escape (todo, html, js o false)
{% endautoescape %}

//////////////FILTROS
Se le pasa el valor del filtro detras de |
Sin espacio a los lados de |
RAW {{ content|raw }} muestra los simbolos de HTML, sin escapar
CAPITALIZE {{'buenos dias'|capitalize}} pone la primera letra en mayuscula
TITLE {{ 'hello there'|title }} capitaliza la primera letra de cada palabra
LOWER {{'HELLO THERE'|lower}} convierte a minusculas
UPPER {{'hello there'|upper}} convierte a mayusculas
TRIM elimina los espacios sobrantes al principio y final
ABS {{ -23|abs }} valor absoluto
CONVERT_ENCODING {{ data|convert_encoding('UTF-8','iso-2022-jp') }}convierte una cadena desde un charset 
    (segundo parametro) a otro charset (primer parametro)
DATE {{ 'now'|date('d/m/Y H:i:s') }} formatea con el formato indicado, como en php
DEFAULT {{ username|default('No name') }} si lo anterior da null o undefined, se muestra el valor default
escape esapca el contenido, cntrario a raw
FIRST {{ {a:1,b:2}|first }} (muestra 1) Devuelve el primer elemento de un array o cadena
LAST {{ {a:1,b:2}|last }} Devuelve el ultimo elemento
LENGTH {{ [1,2]|length }} devuelve la longitud del array
JOIN {{ [1,2]|join('-') }} (muestra 1-2) igual que implode, une los elementos de la lista con el argumento de join
MERGE {{ [1,2]|merge([3,4])}} combina dos arrays
REPLACE {{ 'abc'|replace('ab','123') }} (muestra 123c) reemplaza unos caracteres por otros
REVERSE {{ [1,2]|reverse }} invierte el orden de un array
SLICE {{ '1234'|slice(1,2) }} (muestra lo que extraigo 23) extrae una secuencia de un string o array
                                slice(desde cual empiezo, caracteres a extraer) y lo devuelvo
SORT {{ [2,1]|sort }} ordena un array como en php asort
SPLIT {{ [1,2,3]|split(',') }} como el explode de php, devuelve un arrray con los substring 
                                indicados por el caracter de separacion
URL_ENCODE {{ 'https://www.google.es'|url_encode }} codifica una url

//////////////FUNCIONES
ver en pdf
{{ block('body') }} muestra el bloque que se llame asi

//////////////PALABRAS RESERVADAS PARA COMPROBAR CONDICIONES
{% if valor is defined %} true si la variable esta definida
               empty      true si es cadena vacia o null
               even       true si es par
               odd        true si es impar
               iterable   true si la variable permite iterar sobre ella
               null       true si es null

////////////EXTRA DE OPERADORES
in: aparte del bulce for, sirve para comprobar si un valor esta dentro de una lista
{% if 1 not in [1,2] %}
{% endif %}

