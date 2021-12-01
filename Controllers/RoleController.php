<?php namespace Controllers;

    use DAO\RoleDAO as RoleDAO;
    use Models\Role as Role;

    class RoleController{

    	private $roleDAO;
    	private $role;
    	private $roleList;

    	public function __construct(){
        $this->roleDAO = new RoleDAO();
        $this->role = new Role("Client","3");
        $this->roleList = array();
      } 

      public function getRoleDAO(){        
        return $this->$roleDAO;
      } 

      public function getRole(){        
        return $this->$role;
      }  

      public function getRoleList(){        
        return $this->$roleList;
      }

      /* Retorna una lista de Roles de la base de datos */
      public function getAll(){
        $this->roleList = $this->roleDAO->getAllDAO();
        return $this->roleList;
      }

    }
    
  ?>