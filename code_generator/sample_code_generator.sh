#!/bin/bash
# $1 carpeta
# $2 Nombre archivo
#Crear carpeta, si existe, crear los archivos.
#Si no existe carpeta, crear carpeta y luego archivos
#convierto a camelcase el nombre del archivo para crear el controlador

texto_camel_case=$(sed -r 's/(^|-)(\w)/\U\2/g' <<<"$2")
ruta=$HOME"/path/to/saga-cms"

if [ -d "$ruta/application/controllers/$1" ]; then
#Crear el controlador dentro de la carpeta
if [ -e "$ruta/application/controllers/$1/"$texto_camel_case".php" ]; then
	echo "Archivo controlador ya existe"
else
	#controlador
	cp $ruta"/"code_generator/controller "$ruta/application/controllers/$1/$texto_camel_case.php"
	sed -i 's|$1|'$1'|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
	sed -i 's|$2|'$2'|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
	sed -i 's|->$2_model|->'$2'_model|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
	sed -i 's|$texto_camel_case|'$texto_camel_case'|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
	#modelo
	cp $ruta"/"code_generator/model $ruta"/application/models/"$1"/"$texto_camel_case"_model.php"
	sed -i 's|$2|'$2'|' $ruta"/application/models/"$1"/"$texto_camel_case"_model.php" 
	sed -i 's|$3|'$2'|' $ruta"/application/models/"$1"/"$texto_camel_case"_model.php" 
	sed -i 's|$texto_camel_case|'$texto_camel_case'_model|' $ruta"/application/models/"$1"/"$texto_camel_case"_model.php" 
	#vistas
	cp $ruta"/"code_generator/list $ruta"/application/views/templates/"$1"/"$2"_lista.php"
	cp $ruta"/"code_generator/create $ruta"/application/views/templates/"$1"/"$2"_create.php"
	cp $ruta"/"code_generator/edit $ruta"/application/views/templates/"$1"/"$2"_edit.php"
	sed -i 's|$texto_camel_case|'$texto_camel_case'|' $ruta"/application/views/templates/"$1"/"$2"_lista.php" 
	sed -i 's|$texto_camel_case|'$texto_camel_case'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
	sed -i 's|$texto_camel_case|'$texto_camel_case'|' $ruta"/application/views/templates/"$1"/"$2"_create.php" 
	sed -i 's|$1|'$1'|' $ruta"/application/views/templates/"$1"/"$2"_lista.php" 
	sed -i 's|$2|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_lista.php" 
	sed -i 's|$1|'$1'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
	sed -i 's|$2|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
	sed -i 's|$3|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
	sed -i 's|$4|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
	sed -i 's|$5|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
	sed -i 's|$1|'$1'|' $ruta"/application/views/templates/"$1"/"$2"_create.php" 
	sed -i 's|$2|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_create.php" 
	fi
else
	#si carpeta no existe, se crea en todo el framework
	mkdir $ruta"/application/controllers/$1"
	mkdir $ruta"/application/models/$1"
	mkdir $ruta"/application/views/templates/$1"
        #controlador
        cp $ruta"/"code_generator/controller "$ruta/application/controllers/$1/$texto_camel_case.php"
        sed -i 's|$1|'$1'|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
        sed -i 's|$2|'$2'|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
        sed -i 's|->$2_model|->'$2'_model|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
        sed -i 's|$texto_camel_case|'$texto_camel_case'|' "$ruta/application/controllers/$1/$texto_camel_case.php" 
        #modelo
        cp $ruta"/"code_generator/model $ruta"/application/models/"$1"/"$texto_camel_case"_model.php"
        sed -i 's|$2|'$2'|' $ruta"/application/models/"$1"/"$texto_camel_case"_model.php" 
        sed -i 's|$3|'$2'|' $ruta"/application/models/"$1"/"$texto_camel_case"_model.php" 
        sed -i 's|$texto_camel_case|'$texto_camel_case'_model|' $ruta"/application/models/"$1"/"$texto_camel_case"_model.php" 
        #vistas
        cp $ruta"/"code_generator/list $ruta"/application/views/templates/"$1"/"$2"_lista.php"
        cp $ruta"/"code_generator/create $ruta"/application/views/templates/"$1"/"$2"_create.php"
        cp $ruta"/"code_generator/edit $ruta"/application/views/templates/"$1"/"$2"_edit.php"
        sed -i 's|$texto_camel_case|'$texto_camel_case'|' $ruta"/application/views/templates/"$1"/"$2"_lista.php" 
        sed -i 's|$texto_camel_case|'$texto_camel_case'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
        sed -i 's|$texto_camel_case|'$texto_camel_case'|' $ruta"/application/views/templates/"$1"/"$2"_create.php" 
        sed -i 's|$1|'$1'|' $ruta"/application/views/templates/"$1"/"$2"_lista.php" 
        sed -i 's|$2|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_lista.php" 
        sed -i 's|$1|'$1'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
        sed -i 's|$2|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
        sed -i 's|$3|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
        sed -i 's|$4|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
        sed -i 's|$5|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_edit.php" 
        sed -i 's|$1|'$1'|' $ruta"/application/views/templates/"$1"/"$2"_create.php" 
        sed -i 's|$2|'$2'|' $ruta"/application/views/templates/"$1"/"$2"_create.php" 
	
fi
