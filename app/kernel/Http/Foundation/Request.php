<?php
namespace Aelion\Http\Foundation;

class Request {
    /**
     * Datas from the Http Request
     * @var {array}
     */
    private $requestData;

    public function __construct() {
        $this->requestData = [];
        $this->_parseQueryString();
    }

    public function get(string $key, string $default = null): ?string {
        if (array_key_exists($key, $this->requestData)) {
            return $this->requestData[$key];
        }

        if ($default) {
            $this->requestData[$key] = $default;
            return $default;
        }

        return null;
    }

    public function __toString(): string {
        $output = "<ul>\n";
        foreach($this->requestData as $key => $value) {
            $output .= '<li>' . $key . ' : ' . $value . "</li>\n";
        }
        $output .= "</ul>\n";

        return $output;
    }

    private function _parseQueryString(): void {
        foreach($_GET as $key => $value) {
            $this->requestData[$key] = $value;
        }
    }
}