<?php
function autoload($className)
{
    if (file_exists($file = __dir__. '/' . $className . '.php'))
    {
        require $file;
    }
}
spl_autoload_register('auload');
?>