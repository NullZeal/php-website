<?php
//Adding a page header to give more info in the html packets sent to the clients
header('Content-type: text/html; charset=UTF-8');

//Importing the global functions from the relative path given in $globalFunctions
$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

//Defining the title for this page
$pageTitle = "Home Page";

//Generating the page head with the title and css references 
generatePageHead($pageTitle, $cssHomePage)

?>

<body>
    <img id="logo" src="<?php echo $pictureLogo; ?>" alt="alt" />
    
</body>


<?php 
generatePageFooter();
?>