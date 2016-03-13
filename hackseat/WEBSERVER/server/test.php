<?php

exec('/usr/bin/python2.7 test.py 0 2', $output);

echo "PHP: " . $output[0];

?>