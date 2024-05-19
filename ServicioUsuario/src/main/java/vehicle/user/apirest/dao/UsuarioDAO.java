package vehicle.user.apirest.dao;

import java.util.List;

import vehicle.user.apirest.entity.Usuario;

public interface UsuarioDAO {
	public List<Usuario> findAll();
	
	public Usuario findById(int id);
	
	public void crear(Usuario user);
	
	public void actualizar(Usuario user);
	
	public void deleteById(int id);
	
}
