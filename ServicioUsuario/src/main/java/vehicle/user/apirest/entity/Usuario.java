package vehicle.user.apirest.entity;


import org.hibernate.annotations.DynamicUpdate;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.Id;

import jakarta.persistence.Table;

@Entity
@DynamicUpdate
@Table(name="usuarios")

public class Usuario  {
	

	@Id
	@Column(name="usuario_id") //nombre de la BBDD
	private Integer usuario_id; // el nombre que yo quiera
	
	@Column(name="nombre") //nombre de la BBDD
	private String nombre; // el nombre que yo quiera
	
	@Column(name="departamento") //nombre de la BBDD
	private String departamento; // el nombre que yo quiera
	
	public Usuario () {}
	
	public Usuario(String nombre, String departamento) {
		super();
		this.nombre = nombre;
		this.departamento = departamento;
	}
	

	public Usuario(Integer id, String nombre, String departamento) {
		super();
		this.usuario_id = id;
		this.nombre = nombre;
		this.departamento = departamento;
	}

	
	public Integer getId() {
		return usuario_id;
	}
	public void setId(Integer id) {
		this.usuario_id = id;
	}
	public String getNombre() {
		return nombre;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	public String getDepartamento() {
		return departamento;
	}
	public void setDepartamento(String departamento) {
		this.departamento = departamento;
	}
	
	
	
	
	
}
