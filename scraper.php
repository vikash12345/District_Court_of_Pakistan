<?
require 		'scraperwiki.php';
require 		'scraperwiki/simple_html_dom.php';
$BaseLink	=	'http://202.61.43.40:8080/';
$SiteURL	=	'http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page=';
	
	//	Page pagination
	for($PageLoop = 0; $PageLoop < 1; $PageLoop++){

		$FinalURL	=	$SiteURL . $PageLoop;
		$Html		=	file_get_html($FinalURL);
		

			//	Paginate all 'View' buttons
		
		
			foreach($html->find("//*[@id='w0']/table/tbody/tr") as $element) {
			if($element){
					echo $num		=	$element->find('./td[1]', 0)->plaintext;
				echo "------------";
					$Courtname	=	$element->find('./td[2]', 0)->plaintext;
					$CaseNumbr	=	$element->find('./td[3]', 0)->plaintext;
					$CaseStats	=	$element->find('./td[4]', 0)->plaintext;
					$CaseValue	=	$element->find('./td[5]/button', 0);
					$CaseLinkR	=	$BaseLink . $CaseValue->attr['value'];
					$CaseLink	=	str_replace("amp;", "", $CaseLinkR);
					
scraperwiki::save_sqlite(array('num'), array('num' => $num ,
					     'Courtname' => $Courtname  
					     
					     ));
			}
						
					
					
				
				
				
			} 
	}	
			
?>
