<?php
class DomDocumentParser {

	private $doc;

	public function __construct($url) {

		$options = array(
			'http'=>array('method'=>"GET", 
			'header'=>
			"Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3\r\n".
			"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0\r\n")
			);
		$context = stream_context_create($options);

		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL,$url);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//для возврата результата в виде строки, вместо прямого вывода в браузер
		// $returned = curl_exec($ch);

		$this->doc = new DomDocument();
		@$this->doc->loadHTML(file_get_contents($url, false, $context));
		
		// curl_close ($ch);
	}

	public function getlinks() {
		return $this->doc->getElementsByTagName("a");
	}

	public function getTitleTags() {
		return $this->doc->getElementsByTagName("title");
	}

	public function getMetaTags() {
		return $this->doc->getElementsByTagName("meta");
	}

	public function getImages() {
		return $this->doc->getElementsByTagName("img");
	}

}
?>