<?php
function autoload($classname)
{
    if (file_exists($file = __dir__. '/' . $classname . '.php'))
    {
        require $file;
    }
}
spl_autoload_register('autoload');
?>