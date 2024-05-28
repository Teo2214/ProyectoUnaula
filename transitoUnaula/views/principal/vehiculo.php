<h1 class="nombre-pagina">Zona de vehiculos</h1>
<P class="descripcion-pagina">Elige el servivcio que deseas obtener</P>

<div class="registroVehiculo">
    <form class="formulario">
        <div class="campo2">
            <label for="placa">Placa</label>
            <input type="text" id="placa" name="placa" placeholder="Placa del vehiculo">
        </div>

        <div class="campo2">
            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca" placeholder="Marca del vehiculo">
        </div>

        <div class="campo2">
            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" placeholder="Modelo del vehiculo">
        </div>

        <div class="campo2">
            <label for="pais">Pais del vehiculo</label>
            <input type="text" id="pais" name="pais" placeholder="pais del vehiculo">
        </div>

        <div class="campo2">
            <label for="documento">Documento propietario</label>
            <input type="number" id="documento" name="documento" placeholder="Ingrese su documento">
        </div>

        <div class="campo2">
            <label for="cilindraje">Cilindraje</label>
            <input type="text" id="cilindraje" name="cilindraje" placeholder="Ingrese el cilindraje">
        </div>

        <div class="campo2">
            <label for="color">Color del vehiculo</label>
            <input type="text" id="color" name="color" placeholder="Ingrese el color del vehiculo">
        </div>

        <div class="campo2">
            <label for="Tipo">Tipo de vehiculo</label>
            <select name="Tipo" id="Tipo">
                <option value="automovil">Automovil</option>
                <option value="moto">Moto</option>
            </select>
        </div>

        <input type="submit" class="boton" value="Guardar Información">
    </form>
</div>
