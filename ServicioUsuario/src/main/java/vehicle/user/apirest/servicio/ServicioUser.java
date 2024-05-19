package vehicle.user.apirest.servicio;

import java.util.List;

import vehicle.user.apirest.entity.Usuario;

public interface ServicioUser {
	public List<Usuario> findAll();
	public Usuario findById(int id);
	public void crear(Usuario user);
	public void actualizar(Usuario user);
	public void deleteById(int id);
}
