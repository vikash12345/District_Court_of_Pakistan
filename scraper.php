<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

// require 'scraperwiki.php';
// require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table



require 		'scraperwiki.php';
require 		'scraperwiki/simple_html_dom.php';
$BaseLink	=	'http://202.61.43.40:8080/';
$SiteURL	=	'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page=';
	
	//	Page pagination
	for($PageLoop = 1; $PageLoop < 2; $PageLoop++){

		$FinalURL	=	$SiteURL . $PageLoop;
		$Html		=	file_get_html($FinalURL);
		$RowNumb	=	-1;

		if ($Html) {

			//	Paginate all 'View' buttons
			foreach ($Html->find("//div[@id='w0']/table[contains(@class,'table-striped')]/tbody/tr") as $element) {
				$RowNumb	+=	1;
				if ($RowNumb != 0) {
					$CourtName	=	$element->find('./td[2]', 0);
					$CaseNumbr	=	$element->find('./td[3]', 0);
					$CaseStats	=	$element->find('./td[4]', 0);
					$CaseValue	=	$element->find('./td[5]/button', 0);
					$CaseLinkR	=	$BaseLink . $CaseValue->attr['value'];
					$CaseLink	=	str_replace("amp;", "", $CaseLinkR);
					$DetailPg	=	file_get_html($CaseLink);
						
					if ($DetailPg) {
						//	Assign fields to varilables
						//This is for Case Details
					 	 $info['CaseNo']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 0)->plaintext;
						 $info['InstDte']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 0)->plaintext;
						 $info['nstDte1st']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 1)->plaintext;
						 $info['Status']		=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 1)->plaintext;
						 $info['CourtName2']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 2)->plaintext;
						 $info['CaseFlDte']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 2)->plaintext;
						 $info['RestrCode']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 3)->plaintext;
						 $info['USCode']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 3)->plaintext;
						 $info['AdvPSide1']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[1]", 4)->plaintext;
						 $info['AdvPSide2']			=	$DetailPg->find("//div[@class='container']/table[1]/tbody/tr/td[2]", 4)->plaintext;
					

	scraperwiki::save_sqlite(array('CaseNo','CaseNo'), 
    array('CaseNo' => $info['CaseNo'], 
	  
          'InstDte' => (trim($info['InstDte'])), 
	  
          'nstDte1st' => (trim($info['nstDte1st'])),
	  
          'Status' => (trim($info['Status'])),
          'CourtName2' => (trim($info['CourtName2'])),
          'CaseFlDte' => (trim($info['CaseFlDte'])),
          'RestrCode' => (trim($info['RestrCode'])),
          'USCode' => (trim($info['USCode'])),
          'AdvPSide1' => (trim($info['AdvPSide1'])),
          'AdvPSide2' => (trim($info['AdvPSide2']))	 
    ));					
						/* scraperwiki::save_sqlite(array('CourtName'), array('CaseNo' => $CaseNo, 
										'CourtName' => $CourtName,
										'PageLoop' =>  $PageLoop,
										'InstDte1st' =>  $InstDte1st
										
										)); */
							
						
					
					}
					
				}
				
				
			} }
				}
?>
