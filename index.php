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
    <div>
        <img id="logo" src="<?php echo $pictureLogo; ?>" alt="alt" />
        <h1>Pontbriand inc.</h1>
        <h2>Privacy at it's best. Because everybody has something to hide. And that's perfectly fine.</h2>
        <p>At Pontbriand inc., we believe in a free and secure Internet. We offer the world open source technologies to compete agains't the products offered by companies that do not respect your rights.</p>
        
        
    </div>
    
    
    
    
    
</body>


<?php 
generatePageFooter();
?>