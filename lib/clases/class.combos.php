<?php

class selects extends MySQL
{
	var $code = "";
	
	function cargarComunidades()
	{
		$consulta = parent::consulta("SELECT pais_nomb,pais_id FROM pais ORDER BY pais_nomb ASC");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$comunidades = array();
			while($comunidad = parent::fetch_assoc($consulta))
			{
				$code = $comunidad["pais_id"];
				$name = $comunidad["pais_nomb"];				
				$comunidades[$code]=$name;
			}
			return $comunidades;
		}
		else
		{
			return false;
		}
	}
	function cargarProvincias()
	{
		$consulta = parent::consulta("SELECT prov_nomb,prov_id FROM provincia WHERE pais_id = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$provincias = array();
			while($provincia = parent::fetch_assoc($consulta))
			{
				$code = $provincia["prov_id"];
				$name = $provincia["prov_nomb"];				
				$provincias[$code]=$name;
			}
			return $provincias;
		}
		else
		{
			return false;
		}
	}
		
	function cargarLocalidades()
	{
		$consulta = parent::consulta("SELECT loca_nomb,loca_id FROM localidad WHERE prov_id = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$localidades = array();
			while($localidad = parent::fetch_assoc($consulta))
			{
				$code = $localidad["loca_id"];
				$name = $localidad["loca_nomb"];				
				$localidades[$code]=$name;
			}
			return $localidades;
		}
		else
		{
			return false;
		}
	}		
}
?>