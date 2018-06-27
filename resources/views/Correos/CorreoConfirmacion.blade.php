<!DOCTYPE html>
<html lang="en">
    <div id="ConfirmCorreo"></div>
	{{ Form::hidden('id_modulo', 'Confirmacion', array('id' => 'id_modulo')) }}
    <div class="table-responsive">
        <h2>Se ha registrado exitosamente a la plataforma de Maicao Gift Store</h2>
        <p>Por favor ingresar a la plataforma con los siguientes datos:</p>
    </div>
    <div>
        <table>
            <tr>
                <td>Correo: Correo registrado en la plataforma</td>
            </tr>
            <tr>
                <td>Contraseña: primera letra del nombre en mayúscula y los 4 últimos dígitos del documento</td>
            </tr>
        </table>
        <p></p>
    </div>
    <div>
{{--         <a href="{{ url('Inicio') }}">
            Ingresar a la plataforma
        </a> --}}
        <a href="{{ url('/registro/verificacion/'.$data['CodigoConf']) }}">Ingresar a la plataforma</a>
    </div>
    <div>
        <img src="{{asset('Imagenes/Logo_web_Maicao.png')}}" style="width: 128px; height: 128px" />
    </div>
</html>