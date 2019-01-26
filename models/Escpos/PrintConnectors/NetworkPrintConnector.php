<?php

namespace Optimizer\Models\Escpos\PrintConnectors;

use Exception;

/**
 * PrintConnector for directly opening a network socket to a printer to send it commands.
 */
class NetworkPrintConnector extends FilePrintConnector
{
    /**
     * Construct a new NetworkPrintConnector
     *
     * @param string $ip IP address or hostname to use.
     * @param string $port The port number to connect on.
     * @throws Exception Where the socket cannot be opened.
     */
    public function __construct($ip, $port = "9100")
    {
        $this -> fp = @fsockopen($ip, $port, $errno, $errstr);
        if ($this -> fp === false) {
            throw new Exception("Cannot initialise NetworkPrintConnector: " . $errstr);
        }
    }
}
