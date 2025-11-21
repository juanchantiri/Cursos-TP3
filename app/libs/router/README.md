# TP_cursos
# Nombres y Emails de los integrantes del grupo
-Juan Emilio Chantiri, juaniemilio05@gmail.com.
-Maia Pedersen, maipdersench02@gmail.com
# Venta de Cursos Online

Este repositorio contiene el Trabajo Práctico de **Web 2 - Parte 3 (2025)**.  
El dominio elegido para el proyecto son los **cursos online**.


# EXPLICACION DE ENDPOINTS Y EJEMPLOS :

Los endpoints basicos :
- http://localhost/TP-3-cursos/api/categorias   Para listar todas las categorias o para agregar una (cambiando el metodo http (GET o POST))
- http://localhost/TP-3-cursos/api/cursos       Para listar todos los cursos o para agregar uno (cambiando el metodo     http (GET o POST))
- http://localhost/TP-3-cursos/api/categorias/id (un ejemplo es id = 1 que es la cat Programacion) para obtener, eliminar o editar, una categoria especifica
- http://localhost/TP-3-cursos/api/cursos/id (un ejemplo es 8 que seria Java desde Cero) para obtener, eliminar o editar, un curso especifico

Endpoint mas complejo:
- http://localhost/TP-3-cursos/api/categorias/ordenar/order (order puede ser asc o desc), esto es para ordenar las categorias ya sea de forma ascendente o descendente segun lo que quieras, se ordena por NOMBRE(aunque justo coinciden los ids).

- http://localhost/TP-3-cursos/api/cursos/categoria/id Esto sirve para traer todos los cursos de una categoria especifica (segun su id), es un filtrado digamos, un ejemplo es  cursos/categoria/1 que te daria todos los cursos de la categoria programacion.

- http://localhost/TP-3-cursos/api/auth/login  Esto sirve para que te devuelva el token (authorization basic auth) y luego con el token hacer el login. un ejemplo de usuario es juanceto01@gmail.com   password: 12345 (hasheada obviamente)





## Descripción del dominio
La aplicación modela un sistema en el cual los usuarios pueden acceder a diferentes **cursos online**, clasificados en **categorías**.  

- Cada **curso** pertenece a una sola **categoría**.  
- Una **categoría** puede tener muchos cursos.  


## Modelo de datos
<img width="1918" height="862" alt="Captura de pantalla 2025-09-19 185854" src="https://github.com/user-attachments/assets/d3b27ec0-9973-43c7-a166-f930186f68d2" />


---



