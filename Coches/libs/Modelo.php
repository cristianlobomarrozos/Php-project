<?php
	
	class Modelo {

		private $CodMod;
		private $CodMar ;
		private $NomMod;
		private $Potencia;
		private $año;
		private $Clasico;
        private $Descripcion ;
        private $Precio ;

    /**
     * @return mixed
     */
    public function getCodMod()
    {
        return $this->CodMod;
    }

    /**
     * @param mixed $CodMod
     *
     * @return self
     */
    public function setCodMod($CodMod)
    {
        $this->CodMod = $CodMod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomMod()
    {
        return $this->NomMod;
    }

    /**
     * @param mixed $NomMod
     *
     * @return self
     */
    public function setNomMod($NomMod)
    {
        $this->NomMod = $NomMod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPotencia()
    {
        return $this->Potencia;
    }

    /**
     * @param mixed $Potencia
     *
     * @return self
     */
    public function setPotencia($Potencia)
    {
        $this->Potencia = $Potencia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAño()
    {
        return $this->año;
    }

    /**
     * @param mixed $año
     *
     * @return self
     */
    public function setAño($año)
    {
        $this->año = $año;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClasico()
    {
        return $this->Clasico;
    }

    /**
     * @param mixed $Clasico
     *
     * @return self
     */
    public function setClasico($Clasico)
    {
        $this->Clasico = $Clasico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodMar()
    {
        return $this->CodMar;
    }

    /**
     * @param mixed $CodMar
     *
     * @return self
     */
    public function setCodMar($CodMar)
    {
        $this->CodMar = $CodMar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     *
     * @return self
     */
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->Precio;
    }

    /**
     * @param mixed $Precio
     *
     * @return self
     */
    public function setPrecio($Precio)
    {
        $this->Precio = $Precio;

        return $this;
    }
}


?>