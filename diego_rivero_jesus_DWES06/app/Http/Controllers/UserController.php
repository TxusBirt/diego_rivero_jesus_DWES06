<?php
namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Http\httpCode\ClientErrorCod;
use App\Http\httpCode\ServerErrorCod;
use App\Models\DTO\UsuarioDTO;
use App\Http\httpCode\SuccessCod;
use App\Http\Requests\ValidarUsuarioCreate;
use App\Http\Requests\ValidarUsuarioUpdate;
class UserController extends Controller
{
    public function getUsuarios()
    {
        $client = new Client();
        $url = 'http://localhost:8080/api/usuarios';

        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

            return response()->json($content, $statusCode);
        } catch (\Exception $e) {
            return ServerErrorCod::internalServerError('Error al procesar la solicitud'.$e->getMessage());
        }
    }

   public function getUsuarioId($id)
   {
        $listaIdUsuario=$this->accesoDatos();
        $usuariosId = [];
        foreach ($listaIdUsuario as $usuario) {
            array_push($usuariosId,$usuario->getUsuarioId()); 
        }
        if (!in_array($id, $usuariosId)) {
            return ClientErrorCod::badRequest('No existe un usuario con ese id');
        } 
        try {
            // Realizar la solicitud HTTP GET al servicio de Spring Boot para obtener el usuario por su ID
            $response = Http::get('http://localhost:8080/api/usuarios/'.$id);

            // Verificar si la solicitud fue exitosa (código de respuesta 200)
            if ($response->successful()) {
                // Obtener los datos del usuario desde la respuesta JSON
                $usuario = $response->json();

                
                SuccessCod::ok($response." ha sido obtenido");
                // Devolver los datos del usuario
                return $usuario;
            } else {
                // La solicitud no fue exitosa, devolver un mensaje de error
                return ClientErrorCod::badRequest('error al obtener al usuario');
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver un mensaje de error
            return ServerErrorCod::internalServerError('Error al procesar la solicitud: '.$e->getMessage());
        }

    }
    public function createUsuarios(ValidarUsuarioCreate $request)
    {   
        try {

            // Realizar la solicitud HTTP POST al servicio de Spring Boot para crear un nuevo usuario
            $response = Http::post('http://localhost:8080/api/usuarios', $request->all());

            // Verificar si la solicitud fue exitosa (código de respuesta 2xx)
            if ($response->successful()) {
                // Obtener los datos del usuario creado desde la respuesta JSON
                $usuario = $response->json();
                SuccessCod::created(" ha sido creado");
                // Devolver los datos del usuario creado
                return $usuario;
            } else {
                // La solicitud no fue exitosa, devolver un mensaje de error
                return ClientErrorCod::badRequest('error al crear al usuario');
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver un mensaje de error
            return ServerErrorCod::internalServerError('Error al procesar la solicitud'.$e->getMessage());
        }
        
    }

    public function updateUsuarios(ValidarUsuarioUpdate $request)
    {       

        try {
            // Realizar la solicitud HTTP PUT al servicio de Spring Boot para actualizar el usuario
            $response = Http::put('http://localhost:8080/api/updateusuarios', $request->all());

            // Verificar si la solicitud fue exitosa 
            if ($response->successful()) {
                // Obtener los datos del usuario actualizado desde la respuesta JSON
                $usuario = $response->json();
                SuccessCod::ok(" Registro ha sido actualizado");
                // Devolver los datos del usuario actualizado
                return $usuario;
            } else {
                // La solicitud no fue exitosa, devolver un mensaje de error
                return ClientErrorCod::badRequest('error de actualizacion de usuario '.$response);
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver un mensaje de error
            return ServerErrorCod::internalServerError('Error al procesar la solicitud'.$e->getMessage());
        }
    }
    public function deleteUsuarios($id)
    {
        $listaIdUsuario=$this->accesoDatos();
        $usuariosId = [];
        foreach ($listaIdUsuario as $usuario) {
            array_push($usuariosId,$usuario->getUsuarioId()); 
        }
        if (!in_array($id, $usuariosId)) {
            return ClientErrorCod::badRequest('No existe un usuario con ese id');
        } 
        try {
           
            // Realizar la solicitud HTTP DELETE al servicio de Spring Boot para eliminar el usuario
            $response = Http::delete('http://localhost:8080/api/usuarios/'.$id);

            // Verificar si la solicitud fue exitosa
            if ($response->successful()) {
                // Devolver un mensaje de éxito
                
                return SuccessCod::ok(" Registro ".$id."ha sido eliminado");
            } else {
                // La solicitud no fue exitosa, devolver un mensaje de error
                return ClientErrorCod::badRequest('error de eliminacion de usuario '.$response);
            }
        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver un mensaje de error
            return ServerErrorCod::internalServerError('Error al procesar la solicitud'.$e->getMessage());
        }
    }

    private function accesoDatos () {
        $listaIdUsuario = Usuario::select('usuarios.*')->get();
        $usuariosDTO = [];
        // genero array con los datos de todos los vehiculos
        foreach ($listaIdUsuario as $user) {
            $usuariosDTO [] = new UsuarioDTO($user); 
        }
        return $usuariosDTO;
    }
}