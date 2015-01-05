<?php

// log levels of importance
define('LL_DEBUG', 7);
define('LL_INFO', 6);
define('LL_NOTICE', 5);
define('LL_WARNING', 4);
define('LL_ERROR', 3);
define('LL_EXCEPTION', 2);
define('LL_CRITICAL', 1);
define('LL_FATAL', 0);

// logging options
define('LO_ALL_REQUEST_DATA', 1);
define('LO_WITH_POST_DATA', 2);
define('LO_WITH_GET_DATA', 4);
define('LO_WITH_URI_SEGMENTS', 8);

// exception codes
define('EC_BAD_ROUTE', 100);
define('EC_CONTROLLER_NOT_EXISTS', 110);
define('EC_METHOD_NOT_EXISTS', 120);
define('EC_PAGE_NOT_FOUND', 140);
define('EC_FILE_NOT_FOUND', 200);

// user message types
define('UM_INFO', 'Informácia');
define('UM_CONFIRM', 'Potvrdenie');
define('UM_WARN', 'Upozornenie');
define('UM_ERROR', 'Chyba');
