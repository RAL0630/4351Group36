<?php declare(strict_types=1);
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;
 
/* These can be one-time operations. However, it is based on the source code and test code structure */
/*************** Start of one time operations **********************************/
$filter = new Filter;
/* Perform coverage at a directory level */
$filter->includeDirectory('\path\to\dir');
/* Perform coverage at a file level */
$filter->includeFile('fuel_quote.php');
$driver = Driver::forLineCoverage($filter);
$coverage = new CodeCoverage($driver, $filter);
/*************** End of one time operations **********************************/
 
$coverage->start('<name of test>');
/* Test implementation goes here */
$coverage->stop();
(new HtmlReport)->process($coverage, '\coveragereports');
?>