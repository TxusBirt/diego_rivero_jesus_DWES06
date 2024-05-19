/*
 * Autor: Jesus Diego Rivero
 * Fecha:18/5/2024
 * UD06 Desarrollo web entorno servidor
 * clase que ejerce de controlador de la API
 * 
 * */
package vehicle.user.apirest.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import vehicle.user.apirest.entity.Usuario;
import vehicle.user.apirest.servicio.ServicioUser;
// identificador de controlador
@RestController
// mapeo de ruta base
@RequestMapping("/api") //raiz de url http://localhost:8080/api
public class UsuarioController {
	// autowired para comunicar todos las clases 
	@Autowired
	// propiedad que representa la clase servicio
	private ServicioUser usuarioServicio;
	// metodo get
	@GetMapping("/usuarios")
	public List<Usuario> findAll() {
		return usuarioServicio.findAll();
	}
	//metodo get por id
	@GetMapping("/usuarios/{idUsuario}")
	public Usuario getUser(@PathVariable int idUsuario)  {
		Usuario user = usuarioServicio.findById(idUsuario);
		if (user == null) {
			throw new RuntimeException("No existe el usuario: " + idUsuario);
		}
		return user;
	}
	// metodo post
	@PostMapping("/usuarios")
	// creación de usuario
	public Usuario addUser (@RequestBody Usuario user){
		usuarioServicio.crear(user);
		return user;
	}
	// metodo put
	@PutMapping("/updateusuarios")
	// actualización de usuario, se hace con todos los datos del usuario
	public Usuario updateUser(@RequestBody Usuario user) {
		usuarioServicio.actualizar(user);
		return user;
	}
	// delete por id de usuario
	@DeleteMapping("/usuarios/{id}")
	public String deleteUser (@PathVariable int id) {
		Usuario user = usuarioServicio.findById(id);
		if (user == null) {
			throw new RuntimeException("No existe el usuario: " + id);
		}
		usuarioServicio.deleteById(id);
		return "Eliminado usuario" + id;
	}
	
}
	

