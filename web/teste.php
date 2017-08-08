<?php

	$arrayOriginal = [50,100,150];
	$arrayCopia = $arrayOriginal;

	verificaArray($arrayOriginal, $arrayCopia);

		
	rsort($arrayOriginal);


	if(verificaArray($arrayOriginal, $arrayCopia))
	{
	    echo "crescente";  
	}
	else
	{
			rsort($arrayOriginal);
			if(verificaArray($arrayOriginal, $arrayCopia))
			{
			    echo "decrescente";  
			}
			else
			{
			    echo "nenhum dos dois";
			}
	    // echo "decrescente";
	}



	function verificaArray($arrayOriginal, $arrayCopia) 
	{
		foreach($arrayOriginal as $key=>$value)
		{
		    if($value!=$arrayCopia[$key])
		    {
		        return false;  
		    }   
		    return true;
		}
	}



?>