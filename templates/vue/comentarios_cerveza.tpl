{literal}
    <div id="vue-comentarios">  <!--Acomodar con bootstrap.-->
        
        <h2>{{promedio}}</h2>

        <fieldset v-for="com in comentarios">
            <legend>    <h2>{{com.usuario}}</h2>    </legend>
            <h3> Valoracion : {{com.valoracion}}/5</h3>

            <a v-if="adminLogged=== '1' || id_usuario_logged===com.id_usuario" href={{url_eliminar}}>Eliminar comentario</a>
            <p></br>{{com.texto}}</p>
        </fieldset>

    </div>
{/literal}