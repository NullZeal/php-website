<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE                COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022        File creation. Added a link to the global functions file. Added a title. 
#                                                   Added a function call to generate the HTML head. Added a function call to generate the Home page.
#                                                   Added a function call to generate the footer. 5h long code session.     
#                                                                                  
#Julien Pontbriand (2135020)    Oct. 22, 2022       Added function calls to generathe page headers. 
#                                                   Added the necessary functions and variables to generate a random image out of 5 preselected 
#                                                   image on the home page. The function to generate the page-specific HTML sections of this 
#                                                   file has been moved back inside of it.
#                                                   
#Julien Pontbriand (2135020)    Oct. 29, 2022       Added error handling. Minor refactoring.
#Julien Pontbriand (2135020)    Oct. 30, 2022       Final refactoring before midterm release : indent control. Added more comments to the file.
#Julien Pontbriand (2135020)    Nov. 29, 2022       Added the forcehttps function.
#Julien Pontbriand (2135020)    Dec. 1, 2022        Added a function to open a shared session
#Julien Pontbriand (2135020)    Dec. 6, 2022        Merged initialization functions into 1 function. Added a login logout load function.
#Julien Pontbriand (2135020)    Dec. 7, 2022        Moved the cheatsheet to index page. Refactored the page to put func defs lower
#Julien Pontbriand (2135020)    Dec. 9, 2022        Added an ifram to load a video on front page
#Julien Pontbriand (2135020)    Dec. 12, 2022       Moved all UI functions to an index specific UI file. 
#                                                   Added another param to the gen top page. Added a comment separator.
#                                                   
#Julien Pontbriand (2135020)    Dec. 17, 2022       Added a comment separator. Minor refactoring.
##Julien Pontbriand (2135020)   Dec. 18, 2022       Minor refactoring.
#-------------------------------------------------------------------

########################################################################
# PAGE-CONFIGURATION
########################################################################

#Contains a reference to a file that all pages require
const INIT = 'php/business/init.php';

require_once INIT;
require_once FILE_UI_INDEX;

$pageTitle = "Home";

#Contains references to product images
$productImages = array( 
    FILE_MEDIA_IMAGE_ADBLOCK,
    FILE_MEDIA_IMAGE_DISK,
    FILE_MEDIA_IMAGE_ENCRYPTION,
    FILE_MEDIA_IMAGE_PROTOCOL,
    FILE_MEDIA_IMAGE_SERVER,
);

#Initializes functions that must be ran before generation of HTML content
executePageInitializationFunctions();

########################################################################
# PAGE-GENERATION
########################################################################

generatePageTop($pageTitle, FILE_CSS_INDEX, false);
generateLoginLogout();
generateIndexPage($productImages);
generatePageBottom();