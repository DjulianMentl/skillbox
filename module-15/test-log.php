<?php

class MyTestException extends Exception
{

}

throw new MyTestException('Попытка вызова экспешн');
//phpinfo();
echo 'Ok';
