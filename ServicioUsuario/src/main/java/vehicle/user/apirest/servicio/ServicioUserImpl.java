/*
 * Autor: Jesus Diego Rivero
 * Fecha:18/5/2024
 * UD06 Desarrollo web entorno servidor
 * clase servicio que ejecuta los metodos CRUD a partir de los metodos del DAO
 * 
 * */

package vehicle.user.apirest.servicio;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import vehicle.user.apirest.dao.UsuarioDAO;
import vehicle.user.apirest.entity.Usuario;
@Service
public class ServicioUserImpl implements ServicioUser {
	@Autowired
	private UsuarioDAO usuarioDAO;
	@Override
	public List<Usuario> findAll() {
		List<Usuario> listUsers = usuarioDAO.findAll();
		return listUsers;
	}

	@Override
	public Usuario findById(int id) {
		Usuario user = usuarioDAO.findById(id);
		return user;
	}

	@Override
	public void crear(Usuario user) {
        
		usuarioDAO.crear(user);
	}
	
	@Override
	public void actualizar(Usuario user) {
		usuarioDAO.actualizar(user);
	}

	@Override
	public void deleteById(int id) {
		usuarioDAO.deleteById(id);

	}

}
