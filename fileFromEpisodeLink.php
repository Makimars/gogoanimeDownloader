<?php
error_reporting(0);

function getDownloadPageLink($episodePage){
    return getHrefFromNodeValue(file_get_contents($episodePage), 'Download');
}

function downloadAnime($downloadPageContent){
    $downloadLink =  getHrefFromNodeValue2(file_get_contents($downloadPageContent), 'auto');
    if(is_null($downloadLink)){
		$downloadLink =  getHrefFromNodeValue2(file_get_contents($downloadPageContent), '720');
	}
    if(is_null($downloadLink)){
		$downloadLink =  getHrefFromNodeValue2(file_get_contents($downloadPageContent), '360');
	}
    
    echo "<script type=\"text/javascript\">
           window.location = \"$downloadLink\"
            </script>";
}

function getHrefFromNodeValue($html,$nodeValue){
    $page = new DOMDocument();
    $page->loadHTML($html);
    
    $links = $page->getElementsByTagName('a');
        
    foreach ($links as $link){
        if($link->nodeValue == $nodeValue){
            return $link->getAttribute("href");
        }
    }  
}

function getHrefFromNodeValue2($html,$nodeValue){
    $page = new DOMDocument();
    $page->loadHTML($html);
    
    $links = $page->getElementsByTagName('a');
        
    foreach ($links as $link){
        if(strpos($link->nodeValue, $nodeValue)){
            return($link->getAttribute("href"));
        }
    }  
}
