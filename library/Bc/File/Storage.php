<?php

class Bc_File_Storage
{
	public static function &factory($protocol='file')
	{
		$class = 'Bc_File_Storage_'.ucfirst(strtolower($protocol));
		$object = new $class();
		
		return $object;		
	}
}