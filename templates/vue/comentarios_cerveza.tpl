{literal}
    <div id="vue-comentarios">  <!--Acomodar con bootstrap.-->

        <ul>

            <li v-for="com in comentarios">

                <span>{{com.usuario}} {{com.valoracion}}</span>

                <span v-if="adminLogged=== '1' || id_usuario_logged===com.id_usuario"><a href={{url_eliminar}}>Eliminar comentario</a></span>

                <span></br>{{com.texto}}</span>

            </li>

        </ul>
    </div>
{/literal}