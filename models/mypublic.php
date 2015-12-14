<?php
/* LIMPA STRING */
function limpa($string){
        $var = trim($string);
		$var = rtrim($string);
        $var = addslashes($var);
		$var = mysql_escape_string($var);
        return $var;
}


function is_email($email)
{
	return (preg_match('/^[a-z0-9._-]+@([a-z0-9.-]+\.[a-z]{2,6})$/i', $email, $matches) && checkdnsrr($matches[1].'.', 'MX') || false);
}

/* FUNCAO PARA HTML DE TEXTAREAS */
function unhtmlentities ($string)
{
    $trans_tbl = get_html_translation_table (HTML_ENTITIES);
    $trans_tbl = array_flip ($trans_tbl);
    return strtr ($string, $trans_tbl);
}

/* Converte uma string no formato dd/mm/yyyy para UNiX TIMESTAMP
 Retorna 0 se a data for inválida */
function strtodate($str_data) {
	$arr_data = explode('/',$str_data);
	if (checkdate($arr_data[1],$arr_data[0],$arr_data[2])) {
	       $int_data = @mktime(0,0,0,$arr_data[1],$arr_data[0],$arr_data[2],0);
               return $int_data;
	       }
	else {
		return 0;
		}
}

/* Converte uma data no formato UNiX TIMESTAMP para string dd/mm/yyyy */
function datetostr($int_data) {
        return date('d/m/Y',$int_data);
	}


function msg_error_exit($title,$msg,$link){

echo "<HTML><HEAD><TITLE> Aviso </TITLE>";
echo "<STYLE><!-- BODY {font-family:Verdana} A {color:blue; font-size:13} //--></STYLE>";
echo "</HEAD><BODY bgcolor=FFFDE0><BR><CENTER>";
echo "<TABLE border=0 width=\"500\">";
echo "<TR><TD align=\"center\"><SPAN STYLE=\"color=9E1630; font-weight:bold; font-size:20\">$title</SPAN></TD></TR>";
echo "<TR><TD align=\"center\"><BR><BR></TD></TR>";
echo "<TR><TD align=\"center\">";
echo "<SPAN STYLE=\"color:black\">$msg</SPAN>";
echo "</TD></TR><TR><TD align=\"center\"><BR><BR></TD></TR>";
echo "<TR><TD align=\"center\"><SPAN><A HREF=\"$link\">$link</A></SPAN></TD></TR>";
echo "</TABLE></CENTER></BODY></HTML>";
exit();
}

function msg_error($title,$msg,$link){

echo "<HTML><HEAD><TITLE> Erro </TITLE>";
echo "<STYLE><!-- BODY {font-family:Verdana} A {color:blue; font-size:13} //--></STYLE>";
echo "</HEAD><BODY><BR><CENTER>";
echo "<TABLE border=0 width=\"500\">";
echo "<TR><TD align=\"center\"><SPAN STYLE=\"color=red; font-weight:bold; font-size:30\">$title</SPAN></TD></TR>";
echo "<TR><TD align=\"center\"><BR><BR></TD></TR>";
echo "<TR><TD align=\"center\">";
echo "<SPAN STYLE=\"color:black\">$msg</SPAN>";
echo "</TD></TR><TR><TD align=\"center\"><BR><BR></TD></TR>";
echo "<TR><TD align=\"center\"><SPAN><A HREF=\"$link\">$link</A></SPAN></TD></TR>";
echo "</TABLE></CENTER></BODY></HTML>";
}



  function affy_error_exit($msg) {
	  $errno = mysql_errno();
	  $error = mysql_error();
      echo '<html><head><title>Error</title></head><body>';
      echo $msg;
      echo "<br>Error: ($errno) $error<br>";
      echo '</body></html>';
  	  exit();
  }

  function affy_footer() {
    global $id_link;
	@mysql_close($id_link);
    echo '</body></html>';
  }

  function affy_header($title) {
    echo '<html><head><title>';
	echo "$title";
	echo '</title></head><body>';
  }

  function affy_message($msg) {
    echo '<table>';
    echo '<tr><td>';
	echo "$msg";
    echo '</td></tr>';
    echo '</table>';
  }

  function dump_array($var) {
    switch (gettype($var)) {
      case 'integer':
      case 'double':
      case 'string':
        echo "$var";
        break;
      case 'array':
        if (! count($var)) {
          echo 'Empty Array.<br>';
        }
        else {
          echo '<table border="1" width="100%">';
          echo '<tr><th>Key</th><th>DataType</th><th>Value</th></tr>';
          do {
            echo '<tr><td align="left" valign="top">';
            echo key($var);
            echo '</td><td align="left" valign="top">';
            echo gettype(key($var));
            echo '</td><td align="left" valign="top">';
            dump_array($var[key($var)]);
            echo "</td></tr>";
          } while (next($var));
          echo "</table>";
        }
        break;
      default:
        echo "unknown data type";
        break;
    }
  }

  // declare the request array which holds both
  // url-based (get) and form-based (post) parameters.
  $arr_request = array();

  // move the url and form parameters into the
  // request array. Form parameters supercede url
  // parameters. Additionally, all keys are converted
  // to lower-case.
  if (count($_GET)) {
    while (list($key, $value) = each ($_GET)) {
      $arr_request[strtolower($key)] = $value;
    }
  }
  if (count($_POST)) {
    while (list($key, $value) = each ($_POST)) {
      $arr_request[strtolower($key)] = $value;
    }
  }

  //echo "<br>\$arr_request:<br>";
  //dump_array($arr_request);
  //echo "<hr>";

  function dspArray($name, $a) {
    echo "$name:<br>";
    while (list($key, $value) = each($a)) {
      echo "<dd><b>$key</b>: $value<br>";
   }
   echo "<hr><br>";
  }


/* Funções de Banco de DADOS */
$pub_inc=1;
$databaseeng = 'mysql';
$dialect  = 'DIALECT';

class DBbase_Sql {
  var $Host     = "";
  var $Database = "";
  var $User     = "";
  var $Password = "";

  var $Link_ID  = 0;
  var $Query_ID = 0;
  var $Record   = array();
  var $Row;

  var $Errno    = 0;
  var $Error    = "";

  var $Auto_free   = 0;   ## Set this to 1 for automatic mysql_free_result()
  var $Auto_commit = 0;   ## set this to 1 to automatically commit results

  function connect() {
    if ( 0 == $this->Link_ID ) {
      $this->Link_ID=mysql_pconnect($this->Host, $this->User, $this->Password);
      if (!$this->Link_ID) {
        $this->halt("Link-ID == false, pconnect failed");
      }
      if (!mysql_select_db($this->Database,$this->Link_ID)) {
        $this->halt("cannot use database ".$this->Database);
      }
    }
  }

  function query($Query_String) {
    $this->connect();

#   printf("Debug: query = %s<br>\n", $Query_String);

    $this->Query_ID = mysql_query($Query_String,$this->Link_ID);
    $this->Row   = 0;
    $this->Errno = mysql_errno();
    $this->Error = mysql_error();
    if (!$this->Query_ID) {
      $this->halt("Invalid SQL: ".$Query_String);
    }

    return $this->Query_ID;
  }

  function next_record() {
    $this->Record = mysql_fetch_array($this->Query_ID);
    $this->Row   += 1;
    $this->Errno = mysql_errno();
    $this->Error = mysql_error();

    $stat = is_array($this->Record);
    if (!$stat && $this->Auto_free) {
      mysql_free_result($this->Query_ID);
      $this->Query_ID = 0;
    }
    return $stat;
  }

  function seek($pos) {
    $status = mysql_data_seek($this->Query_ID, $pos);
    if ($status)
      $this->Row = $pos;
    return;
  }

  function metadata($table) {
    $count = 0;
    $id    = 0;
    $res   = array();

    $this->connect();
    $id = @mysql_list_fields($this->Database, $table);
    if ($id < 0) {
      $this->Errno = mysql_errno();
      $this->Error = mysql_error();
      $this->halt("Metadata query failed.");
    }
    $count = mysql_num_fields($id);

    for ($i=0; $i<$count; $i++) {
      $res[$i]["table"] = mysql_field_table ($id, $i);
      $res[$i]["name"]  = mysql_field_name  ($id, $i);
      $res[$i]["type"]  = mysql_field_type  ($id, $i);
      $res[$i]["len"]   = mysql_field_len   ($id, $i);
      $res[$i]["flags"] = mysql_field_flags ($id, $i);
      $res["meta"][$res[$i]["name"]] = $i;
      $res["num_fields"]= $count;
    }

    mysql_free_result($id);
    return $res;
  }

  function affected_rows() {
    return mysql_affected_rows($this->Link_ID);
  }

  function num_rows() {
    return mysql_num_rows($this->Query_ID);
  }

  function num_fields() {
    return mysql_num_fields($this->Query_ID);
  }

  function nf() {
    return $this->num_rows();
  }

  function np() {
    print $this->num_rows();
  }

  function f($Name) {
    return $this->Record[$Name];
  }

  function p($Name) {
    print $this->Record[$Name];
  }

  function halt($msg) {
    printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
    printf("<b>MySQL Error</b>: %s (%s)<br>\n",
      $this->Errno,
      $this->Error);
    die("Session halted.");
  }
}

class BD extends DBbase_Sql {
  var $Host     = "localhost";
  var $Database = "soft-mercado";
  var $User     = "root";
  var $Password = "";

  function free_result() {
    return @mysql_free_result($this->Query_ID);
  }

  function rollback() {
    return 1;
  }

  function commit() {
    return 1;
  }

  function autocommit($onezero) {
    return 1;
  }

  function insert_id($col="",$tbl="",$qual="") {
    return mysql_insert_id($this->Query_ID);
  }
}
?>