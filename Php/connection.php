<?php

const databaseName = "database2135020";
const dbUsername = "julienDbUser-2135020";
const dbPassword = "46l1rE746EQaQu82WIBuk3K77i38nI";

# while(true){    // this is to connect to heidi sql, its a connection string
$connection = new PDO("mysql:host=localhost;dbname=" . databaseName, dbUsername, dbPassword);

#make sure all problem thow exception (....handlers)
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

#protect against some of the SQL injections
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);