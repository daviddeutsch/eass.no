<?php

function unauthorizedDeploy() { header("HTTP/1.0 401 Unauthorized"); exit; }

if ( !file_exists('config.json') ) unauthorizedDeploy();

$json = json_decode( file_get_contents('config.json') );

if ( !isset( $_GET['auth'] ) || !isset( $json->auth ) ) unauthorizedDeploy();

if ( $_GET['auth'] != $json->auth ) unauthorizedDeploy();

//Untracked files my break the pull
//shell_exec('git stash --include-untracked');

//shell_exec( 'git pull origin master' );

/**
 * Do not nuke untracked files
 */

echo '<pre>';

echo "\ngit --version\n", shell_exec('git --version 2>&1');

echo "\ngit add *\n", shell_exec('git add * 2>&1');

echo "\ngit commit -a -m \"auto dev server commit\"\n", shell_exec('git commit -a -m "auto dev server commit" 2>&1');

//echo "\ngit pull origin master\n", shell_exec('git pull origin master 2>&1');

echo "\ngit fetch\n", shell_exec('git fetch 2>&1');

echo "\ngit merge -s recursive -X theirs origin/master\n", shell_exec('git merge -s recursive -X theirs origin/master 2>&1');

echo "\nOk.</pre>";
