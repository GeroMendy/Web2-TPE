            {literal}
            <div id="vue-comentarios">  <!--Acomodar con bootstrap.-->
                <fieldset v-for="com in comentarios">
                    <legend>    <h2>{{com.usuario}}</h2>    </legend>
                    <h3> Valoracion : {{com.valoracion}}/5</h3>
                    <p></br>{{com.texto}}</p>
                    <button class="js_eliminar_comentario" v-if="adminLogged=== '1' || id_usuario_logged===com.id_usuario">
                        Eliminar comentario
                    </button>
                </fieldset>
            </div>
            {/literal}