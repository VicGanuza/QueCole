﻿<?php
/* 
  w2box: web 2.0 File Repository v4.1
  
  (c) 2005-2008, Clement Beffa
  http://labs.beffa.org/w2box/
 
  Licence:
  w2box is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0
  http://creativecommons.org/licenses/by-nc-sa/3.0/
 
  You are free:
    * to Share — to copy, distribute and transmit the work
    * to Remix — to adapt the work

  Under the following conditions:
    * Attribution. You must attribute the work in the manner specified by the author or
      licensor (but not in any way that suggests that they endorse you or your use of the work).
    * Noncommercial. You may not use this work for commercial purposes.
    * Share Alike. If you alter, transform, or build upon this work, you may distribute
      the resulting work only under the same or similar license to this one.

  For any reuse or distribution, you must make clear to others the license terms of this work.
  Any of the above conditions can be waived if you get permission from the copyright holder.
  Nothing in this license impairs or restricts the author's moral rights.
*/

// you should edit config.php (and upload.cgi) in order to configure this script.

//session_start();
//if ($_SESSION['autorizado'] != TRUE) header("Location: login3.php");

//require("config.php");

@session_start();
echo 'HOLA!!!! '.($_SESSION['autorizado']);

?>
 