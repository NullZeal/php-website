<?php
#-------------------------------------------------------------------
#Revision History
# 
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Added constants for 2 folders. Added constant for some files. Added variable for a file's path. Added a function to generate page headers in other files. Added a function to generate page footers. Added a function to generate a logo.
#
#Julien Pontbriand (2135020)    Oct. 22, 2022    Refactored the constants for the folders and files. Added functions to open and close some HTML tags. Added a function to generate the navigation panel. 
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Added functions to manage errors on pages. Minor refactoring.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Removed logo variable. Refactored error functions. Added constant for download button. Minor code refactoring.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added more code comments to the file. Indendation has been reviewed. Fixed the logo generation function to be non case-sensititve
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function. 
#-------------------------------------------------------------------

function isCurrency($number)
{
    // function taken from 
    // https://stackoverflow.com/questions/4982291/how-to-check-if-an-entered-value-is-currency
    // Here I understand that:
    #It starts with ^
    #It accepts 0 or 1 - character with -? 
    #It then accepts 1 or more of any of the chars inside the range [0-9] with : +
    ##It then creates a non capturing group with : (?:
    #Inside the group it takes a . with : \. (escape)
    #Then it takes 1 or 2 of any chars inside the range [0-9]
    #Then it lets us know this group of chars can happen 0 or 1 time with the : ?
    #I allow negative numbers so that I could create another verification
    #to be more precise about the error problem
    return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number);
}

function isAnInt($number)
{
    #This function validates if the given arg is = to 1 or or more of any chars
    # in range 0-9 (int only string)
    return preg_match("/^[0-9]+$/", $number);
}