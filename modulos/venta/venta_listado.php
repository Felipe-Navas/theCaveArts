<?php include('../templates/header.php');?>


<script type="text/javascript">

var TableIDvalue = "tfhover";

var TableLastSortedColumn = -1;
function SortTable() {
    var sortColumn = parseInt(arguments[0]);
    var type = arguments.length > 1 ? arguments[1] : 'T';
    var dateformat = arguments.length > 2 ? arguments[2] : '';
    var table = document.getElementById(TableIDvalue);
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");
    var arrayOfRows = new Array();
    type = type.toUpperCase();
    dateformat = dateformat.toLowerCase();
    for(var i=0, len=rows.length; i<len; i++) {
        arrayOfRows[i] = new Object;
        arrayOfRows[i].oldIndex = i;
        var celltext = rows[i].getElementsByTagName("td")[sortColumn].innerHTML.replace(/<[^>]*>/g,"");
        if( type=='D' ) { arrayOfRows[i].value = GetDateSortingKey(dateformat,celltext); }
        else {
            var re = type=="N" ? /[^\.\-\+\d]/g : /[^a-zA-Z0-9]/g;
            arrayOfRows[i].value = celltext.replace(re,"").substr(0,25).toLowerCase();
        }
    }
    if (sortColumn == TableLastSortedColumn) { arrayOfRows.reverse(); }
    else {
        TableLastSortedColumn = sortColumn;
        switch(type) {
            case "N" : arrayOfRows.sort(CompareRowOfNumbers); break;
            case "D" : arrayOfRows.sort(CompareRowOfNumbers); break;
            default  : arrayOfRows.sort(CompareRowOfText);
        }
    }
    var newTableBody = document.createElement("tbody");
    for(var i=0, len=arrayOfRows.length; i<len; i++) {
        newTableBody.appendChild(rows[arrayOfRows[i].oldIndex].cloneNode(true));
    }
    table.replaceChild(newTableBody,tbody);
} // function SortTable()

function CompareRowOfText(a,b) {
    var aval = a.value;
    var bval = b.value;
    return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
} // function CompareRowOfText()

function CompareRowOfNumbers(a,b) {
    var aval = /\d/.test(a.value) ? parseFloat(a.value) : 0;
    var bval = /\d/.test(b.value) ? parseFloat(b.value) : 0;
    return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
} // function CompareRowOfNumbers()

function GetDateSortingKey(format,text) {
    if( format.length < 1 ) { return ""; }
    format = format.toLowerCase();
    text = text.toLowerCase();
    text = text.replace(/^[^a-z0-9]*/,"",text);
    text = text.replace(/[^a-z0-9]*$/,"",text);
    if( text.length < 1 ) { return ""; }
    text = text.replace(/[^a-z0-9]+/g,",",text);
    var date = text.split(",");
    if( date.length < 3 ) { return ""; }
    var d=0, m=0, y=0;
    for( var i=0; i<3; i++ ) {
        var ts = format.substr(i,1);
        if( ts == "d" ) { d = date[i]; }
        else if( ts == "m" ) { m = date[i]; }
        else if( ts == "y" ) { y = date[i]; }
    }
    if( d < 10 ) { d = "0" + d; }
    if( /[a-z]/.test(m) ) {
        m = m.substr(0,3);
        switch(m) {
            case "jan" : m = 1; break;
            case "feb" : m = 2; break;
            case "mar" : m = 3; break;
            case "apr" : m = 4; break;
            case "may" : m = 5; break;
            case "jun" : m = 6; break;
            case "jul" : m = 7; break;
            case "aug" : m = 8; break;
            case "sep" : m = 9; break;
            case "oct" : m = 10; break;
            case "nov" : m = 11; break;
            case "dec" : m = 12; break;
            default    : m = 0;
        }
    }
    if( m < 10 ) { m = "0" + m; }
    y = parseInt(y);
    if( y < 100 ) { y = parseInt(y) + 2000; }
    return "" + String(y) + "" + String(m) + "" + String(d) + "";
} // function GetDateSortingKey()
</script>




<?php 
if(isset($_SESSION['usuario_id']))
{
    $usuario_tipo=$_SESSION['usuario_tipo'];
    if($usuario_tipo==1){
        $query=mysql_query("SELECT
            `obra`.`obra_url`
            , `obra`.`obra_nomb`
            , `obra`.`obra_prec`
            , `usuario`.`usua_usua`
            , `venta`.`vent_fech`
            , `categoria`.`cate_nom`
            , `venta`.`vent_impo`
            FROM
            `efi_php`.`detalle`
            INNER JOIN `efi_php`.`venta` 
            ON (`detalle`.`vent_id` = `venta`.`vent_id`)
            INNER JOIN `efi_php`.`usuario` 
            ON (`venta`.`usua_id` = `usuario`.`usua_id`)
            INNER JOIN `efi_php`.`obra` 
            ON (`detalle`.`obra_id` = `obra`.`obra_id`)
            INNER JOIN `efi_php`.`categoria` 
            ON (`obra`.`cate_id` = `categoria`.`cate_id`);")or die(mysql_error());
            ?> 
            <p class="pagetittle">Listado de Ventas</p>
            <table id="tfhover" class="tftable" border="1"> 
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th><a href="javascript:SortTable(1,'T');">Nombre</a></th>
                        <th><a href="javascript:SortTable(2,'N');">Precio</a></th>
                        <th><a href="javascript:SortTable(3,'N');">Usuario</a></th>
                        <th><a href="javascript:SortTable(4,'N');">Categoria</a></th>
                        <th><a href="javascript:SortTable(5,'D','mdy');">Fecha</a></th>
                    </tr>
                </thead> 
                <?php
                while($fila = mysql_fetch_assoc($query)) { 
                    ?> 
                    <tr>    
                        <td><img class="galler" WIDTH=100 HEIGHT=100 src="<?php  echo "../../upload/".$fila['obra_url']; ?>"/></td>
                        <td><?php echo $fila['obra_nomb'] ?></td>
                        <td><?php echo $fila['obra_prec'] ?></td>
                        <td><?php echo $fila['usua_usua'] ?></td>
                        <td><?php echo $fila['cate_nom'] ?></td>
                        <td><?php echo $fila['vent_fech'] ?></td>
                    </tr>
                    <?php } ?>  
            </table>


            <?php
        } 
        if($usuario_tipo==2){
            echo "<p>Como usted es un usuario comun no puede ver las ventas.<p/>";
            echo "<p>Solo las puede ver el Administrador.<p/>";
            ?>


            <?php
        }

    }else{
        echo "<p>Hay que logearse(arriba a la derecha del menu). para ver las ventas.</p>";
    }
    ?>
    
    <?php include('../templates/footer.php'); ?>