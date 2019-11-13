{{literal}
    <div id="vue-comentarios">  <!--Acomodar con bootstrap.-->

        <h2>    {{  subtitulo  }}    </h2>

        <ul>
            <li v-for="com in comentarios">
                <!--
                <span v-if="adminLogged">    {{}}    </span>
                Link para eliminar usuario si el actual logueado es admin
                -->
                <span <!--    v-else   -->>{{com.usuario}}    -    </span>
                <span>{{com.valoracion}}</span>
                <span></br>{{com.texto}}</span>
                <span v-if=" com.id_usuario==id_usuario_logged ">same user<!--  link a eliminar o editar  --></span>
                <span v-ifelse=" adminLoged ">admin<!--  link a eliminar comentario  --></span>
            </li>
        </ul>
    </div>
{/literal}}