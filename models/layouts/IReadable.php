<?php

interface IReadable {

    const EOL_WIN = "\r\n";
    const EOL_DAR = "\r";
    const EOL_UNIX = "\n";

    /**
     * @param string $input
     */
    public function read($input);
}
