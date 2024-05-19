/*
 * Autor: Jesus Diego Rivero
 * Fecha:18/5/2024
 * UD06 Desarrollo web entorno servidor
 * clase que manipula los datos de la BBDD
 * 
 * */

package vehicle.user.apirest.dao;

import java.util.List;

import org.hibernate.Session;
import org.hibernate.query.Query;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import jakarta.persistence.EntityManager;
import jakarta.persistence.criteria.CriteriaBuilder;
import jakarta.persistence.criteria.CriteriaDelete;
import jakarta.persistence.criteria.Root;
import vehicle.user.apirest.entity.Usuario;

@Repository
public class UsuarioDAOImpl implements UsuarioDAO {
	@Autowired
	private EntityManager entityManager;
	@Override
	@Transactional
	// metodo que obtiene todos los usuarios
	public List<Usuario> findAll() {
		Session currentSession = entityManager.unwrap(Session.class);
		Query<Usuario> theQuery = currentSession.createQuery("from Usuario", Usuario.class);
		List<Usuario> user = theQuery.getResultList();
		return user;
	}
	// metodo que obtiene usuarios por id
	@Override
	@Transactional
	public Usuario findById(int id) {
		Session currentSession = entityManager.unwrap(Session.class);
		Usuario user = currentSession.get(Usuario.class, id);
		return user;
	}

	// metodo de creación de usuarios
	@Override
	@Transactional
	public void crear(Usuario user) {
		Session currentSession = entityManager.unwrap(Session.class);
		// el metodo persist sólo hace persistente un registro pero no se inserta en bbdd
		// hasta que no se cierra sesión o se acaba sesión
		currentSession.persist(user);
		currentSession.close();
	}

	@Override
	@Transactional
	//actualiza resgistros de suarios
	public void actualizar(Usuario user) {
		Session currentSession = entityManager.unwrap(Session.class);
		// metodo merge que actualiza
		currentSession.merge(user);
	}
	@Override
	@Transactional
	// metodo de borrado de registros
	public void deleteById(int id) {
		// se utiliza api criteria 
        CriteriaBuilder cb = entityManager.getCriteriaBuilder();
        CriteriaDelete<Usuario> delete = cb.createCriteriaDelete(Usuario.class);
        Root<Usuario> root = delete.from(Usuario.class);
        delete.where(cb.equal(root.get("usuario_id"), id));

        entityManager.createQuery(delete).executeUpdate();

	}

}
