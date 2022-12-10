<?php

#################################
#           DEBUGGING              
#################################

const DEBUGGING = false;

#################################
#           LOGGING          
#################################

const LOGGIN_ERROR_MESSAGE = "Please login before accessing this page";


#################################
#           URI              
#################################

##FOLDERS
const FOLDER_CSS = 'Css/';
const FOLDER_MEDIA = 'Media/';
const FOLDER_IMAGE = 'Image/'; 
const FOLDER_TXT = 'Txt/';
const FOLDER_TXT_ERRORS = FOLDER_TXT . 'Errors/';
CONST FOLDER_PHP = "Php/";
CONST FOLDER_CLASSES = FOLDER_PHP . 'Classes/';

##FILES

#PAGES
const FILE_PAGE_INDEX = 'index.php';
const FILE_PAGE_BUYING = 'buying.php';
const FILE_PAGE_ORDERS = "orders.php"; 
const FILE_PAGE_REGISTER = "register.php"; 
const FILE_PAGE_ACCOUNT = "account.php";

#PHP
const FILE_CONNECTION = FOLDER_PHP . 'dbConnection.php';
const FUNCTIONS_VALIDATION = FOLDER_PHP . 'functionsValidation.php';
const FUNCTIONS_PAGE_CONFIG = FOLDER_PHP . 'functionsPageConfig.php';
const FUNCTIONS_PAGE_CONTENT_GENERATION = FOLDER_PHP . 'functionsPageContentGeneration.php';
const FUNCTIONS_SESSION_HANDLING = FOLDER_PHP . 'functionsSessionHandling.php';

#CLASSES
const FILE_CLASSES_CUSTOMER = FOLDER_CLASSES . 'customer.php';
const FILE_CLASSES_PRODUCT = FOLDER_CLASSES . 'product.php';
const FILE_CLASSES_PRODUCTS = FOLDER_CLASSES . 'products.php';
const FILE_CLASSES_COLLECTION = FOLDER_CLASSES . 'collection.php';
const FILE_CLASSES_ORDER = FOLDER_CLASSES . 'order.php';
const FILE_CLASSES_DATABASE_CONNECTED_OBJECT = FOLDER_CLASSES . 'databaseConnectedObject.php';

#CSS
const FILE_CSS_INDEX = FOLDER_CSS . 'index.css';
const FILE_CSS_BUYING = FOLDER_CSS . 'buying.css';
const FILE_CSS_ORDERS = FOLDER_CSS . 'orders.css';
const FILE_CSS_GLOBAL = FOLDER_CSS . 'global.css';
const FILE_CSS_REGISTER = FOLDER_CSS . 'register.css';


#TXT
const FILE_TXT_ORDERS = FOLDER_TXT . "orders.txt";
const FILE_TXT_CHEATSHEET = FOLDER_TXT . "cheatsheet.txt";
const FILE_TXT_ERRORS_BUYINGPAGE_WRONGINPUT_LOG = FOLDER_TXT 
    . "buyingpage_wronginput_log.txt";
const FILE_TXT_ERRORS_ERRORS_LOG = FOLDER_TXT_ERRORS . "error_logs.txt";
const FILE_TXT_ERRORS_EXCEPTIONS_LOG = FOLDER_TXT_ERRORS . "exceptions_logs.txt";

#MEDIA
const FILE_MEDIA_IMAGE_LOGO = FOLDER_MEDIA . FOLDER_IMAGE . "logo.png";
const FILE_MEDIA_IMAGE_SERVER = FOLDER_MEDIA . FOLDER_IMAGE . "server.jpg";
const FILE_MEDIA_IMAGE_ENCRYPTION = FOLDER_MEDIA . FOLDER_IMAGE . "encryption.jpg";
const FILE_MEDIA_IMAGE_PROTOCOL = FOLDER_MEDIA . FOLDER_IMAGE . "protocol.jpg";
const FILE_MEDIA_IMAGE_ADBLOCK = FOLDER_MEDIA . FOLDER_IMAGE . "adblock.jpg";
const FILE_MEDIA_IMAGE_DISK = FOLDER_MEDIA . FOLDER_IMAGE . "disk.jpg";

#################################
#           PROCEDURES
#################################

abstract class Database2135020_Procedures_Customers
{
    public const GET_USERNAME_PASSWORD = 'CALL procedure_customers_get_username_and_password';
    public const DELETE_ONE = 'CALL procedure_customers_delete_one';
    public const INSERT_ONE = 'CALL procedure_customers_insert_one';
    public const SELECT_ALL = 'CALL procedure_customers_select_all';
    public const SELECT_ONE_FROM_ID = 'CALL procedure_customers_select_from_id';
    public const SELECT_ONE_FROM_USERNAME = 'CALL procedure_customers_select_from_username';
    public const UPDATE_ONE = 'CALL procedure_customers_update_one';
}

abstract class Database2135020_Procedures_Products
{
    public const DELETE_ONE = 'CALL procedure_products_delete_one';
    public const INSERT_ONE = 'CALL procedure_products_insert_one';
    public const SELECT_ALL = 'CALL procedure_products_select_all';
    public const SELECT_ONE = 'CALL procedure_products_select_one';
    public const UPDATE_ONE = 'CALL procedure_products_update_one';
    
}

abstract class Database2135020_Procedures_Orders
{
    public const DELETE_ONE = 'CALL procedure_orders_delete_one';
    public const INSERT_ONE = 'CALL procedure_orders_insert_one';
    public const SELECT_ALL = 'CALL procedure_orders_select_all';
    public const SELECT_ONE = 'CALL procedure_orders_select_one';
    public const UPDATE_ONE = 'CALL procedure_orders_update_one';
    public const SELECT_CUSTOMER_ORDERS = 'CALL procedure_select_customer_orders';
    
}