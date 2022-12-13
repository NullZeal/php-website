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

####FOLDERS####

const FOLDER_CSS = 'Css/';
const FOLDER_MEDIA = 'Media/';
const FOLDER_IMAGE = 'Image/'; 
const FOLDER_TXT = 'Txt/';
const FOLDER_TXT_ERRORS = FOLDER_TXT . 'Errors/';
const FOLDER_JS = "Js/";
CONST FOLDER_PHP = "Php/";
    CONST FOLDER_DATA_ACCESS = FOLDER_PHP . 'Data_Access/';
    CONST FOLDER_UI = FOLDER_PHP . 'UI/';
    CONST FOLDER_BUSINESS = FOLDER_PHP . 'Business/';
        CONST FOLDER_CLASSES = FOLDER_BUSINESS . 'Classes/';

####FILES####

#PAGES
const FILE_PAGE_INDEX = 'index.php';
const FILE_PAGE_BUYING = 'buying.php';
const FILE_PAGE_ORDERS = "orders.php"; 
const FILE_PAGE_REGISTER = "register.php"; 
const FILE_PAGE_ACCOUNT = "account.php";

#DATA_ACCESS
const FILE_BUSINESS_CONNECTION = FOLDER_DATA_ACCESS . 'dbConnection.php';

#GLOBAL PHP FUNCTIONS
const FILE_BUSINESS_VALIDATIONS = FOLDER_BUSINESS . 'validations.php';
const FILE_BUSINESS_PAGE_CONFIG = FOLDER_BUSINESS . 'pageConfig.php';
const FILE_BUSINESS_PAGE_CONTENT_GENERATION = FOLDER_BUSINESS . 'pageContentGeneration.php';
const FILE_BUSINESS_SESSION_HANDLING = FOLDER_BUSINESS . 'sessionHandling.php';

#JS
const FILE_AJAX = FOLDER_JS . 'ajax.js';

#UI
const FILE_UI_INDEX = FOLDER_UI . 'indexUI.php';
const FILE_UI_BUYING = FOLDER_UI . 'buyingUI.php';
const FILE_UI_ORDERS = FOLDER_UI . 'ordersUI.php';
const FILE_UI_REGISTER = FOLDER_UI . 'registerUI.php';
const FILE_UI_ACCOUNT = FOLDER_UI . 'accountUI.php';
const FILE_UI_GLOBAL = FOLDER_UI . 'globalUI.php';

#CLASSES
const FILE_CLASSES_CUSTOMER = FOLDER_CLASSES . 'customerClass.php';
const FILE_CLASSES_PRODUCT = FOLDER_CLASSES . 'productClass.php';
const FILE_CLASSES_PRODUCTS = FOLDER_CLASSES . 'productsClass.php';
const FILE_CLASSES_COLLECTION = FOLDER_CLASSES . 'collectionClass.php';
const FILE_CLASSES_ORDER = FOLDER_CLASSES . 'orderClass.php';
const FILE_CLASSES_ORDERS = FOLDER_CLASSES . 'ordersClass.php';
const FILE_CLASSES_DATABASE_CONNECTED_OBJECT = FOLDER_CLASSES . 'databaseConnectedObjectClass.php';

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
    public const SELECT_ALL_WITH_OPTIONAL_FILTERS = 'CALL procedure_orders_select_all_with_optional_filters';
    
    
}

