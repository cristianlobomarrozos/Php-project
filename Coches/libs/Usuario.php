<?php
	
	class Usuario {

		private $CodUsu ;
		private $email ;
		private $NomUsu ;
		private $ApeUsu ;
		private $FecNacUsu ;
		private $Avatar ;
		private $esAdmin ;

		//private function __construct() {

		//}

	    /**
	     * @return mixed
	     */
	    public function getCodUsu()
	    {
	        return $this->CodUsu;
	    }

	    /**
	     * @param mixed $CodUsu
	     *
	     * @return self
	     */
	    public function setCodUsu($CodUsu)
	    {
	        $this->CodUsu = $CodUsu;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getEmail()
	    {
	        return $this->email;
	    }

	    /**
	     * @param mixed $email
	     *
	     * @return self
	     */
	    public function setEmail($email)
	    {
	        $this->email = $email;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getNombre()
	    {
	        return $this->NomUsu;
	    }

	    /**
	     * @param mixed $NomUsu
	     *
	     * @return self
	     */
	    public function setNombre($NomUsu)
	    {
	        $this->NomUsu = $NomUsu;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getApellidos()
	    {
	        return $this->ApeUsu;
	    }

	    /**
	     * @param mixed $ApeUsu
	     *
	     * @return self
	     */
	    public function setApellidos($ApeUsu)
	    {
	        $this->ApeUsu = $ApeUsu;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getFecNacimiento()
	    {
	        return $this->FecNacUsu;
	    }

	    /**
	     * @param mixed $FecNacUsu
	     *
	     * @return self
	     */
	    public function setFecNacimiento($FecNacUsu)
	    {
	        $this->FecNacUsu = $FecNacUsu;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getAvatar()
	    {
	        return $this->Avatar;
	    }

	    /**
	     * @param mixed $Avatar
	     *
	     * @return self
	     */
	    public function setAvatar($Avatar)
	    {
	        $this->Avatar = $Avatar;

	        return $this;
	    }

	    public function __toString()
	    {
	    	return $this->NomUsu." ".$this->ApeUsu ;
	    }

    /**
     * @return mixed
     */
    public function getEsAdmin()
    {
        return $this->esAdmin;
    }

    /**
     * @param mixed $esAdmin
     *
     * @return self
     */
    public function setEsAdmin($esAdmin)
    {
        $this->esAdmin = $esAdmin;

        return $this;
    }
}
	

?>