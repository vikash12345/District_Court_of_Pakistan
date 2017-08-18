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



require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
//

/** looping over list of ids of doctors **/
for($id = 20120; $id <= 69372; $id++)
	{
	 $url = ("http://202.61.43.40:8080/index.php?r=site%2Fsearchbyvalue&page=".$id);
	$link2 = file_get_html($url);
  foreach($link2->find("//*[@id='w0']/table/tbody/tr")as $element){

		if(is_object($element))
	{

	 	$info['num'] 		= $element->find("td", 0)->plaintext;
		$info['courtname']  	= $element->find("td", 1)->plaintext;
		$info['caseno']  	= $element->find("td", 2)->plaintext;
		$info['status']  	= $element->find("td", 3)->plaintext;
		$href 			= $element->find(".//td/button", 0);
			
			if(is_object($href))
	{
		 $info['urlbutton'] = $href->value;
		 
	}
		}
	  
	  
scraperwiki::save_sqlite(array('num'), array('num' => $info['num'],'courtname' => $info['courtname'],'caseno' => $info['caseno'],'status' => $info['status'],'urlbutton' => $info['urlbutton'] ));

		
  }
}
// called "data".
?>
