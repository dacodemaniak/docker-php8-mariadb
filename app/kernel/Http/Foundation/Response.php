<?php
namespace Aelion\Http\Foundation;

class Response {
    /**
     * HTML content to return
     * @var {string}
     */
    private $content;

    public function __construct() {}

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function send(): void {
        $this->_httpHeaders();
        echo $this->content;
    }

    private function _httpHeaders(): void {
        header('Content-Type: text/html', true, 200);
    }
}