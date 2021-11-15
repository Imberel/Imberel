<?php

namespace Imberel\Imberel\Core\Extra;

use Throwable;
use Imberel\Imberel\Core\Response\Response;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class ICatch extends Response
{
    private string|object|null $package;

    private Throwable $th;

    private const MAXSTATUSCODE = 600;

    private const MINSTATUSCODE = 100;

    final public function __construct(Throwable $th, string|object|null $package = null)
    {
        $this->package = $package;
        $this->th = $th;
        $this->decide();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function ClassError(): void
    {
        \printf(
            '
            <div class="classerror">
            <div class="throwable">%s Error: %s</div>
            </div>
                <style type="text/css">
                    div.classerror{
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-height: 100vh;
                    min-width: 100vw;
                    }
                    div.throwable {
                    color: whitesmoke;
                    text-align: center;
                    cursor: pointer;
                    background: linear-gradient(145deg, red, #F7AC22);
                    animation-name: throwable;
                    animation-duration: 5s;
                    animation-iteration-count: infinite;
                    animation-direction: linear;
                    padding: 15px;
                    width: max-content;
                    margin: auto;
                    font-size: inherit;
                    border-radius: 0px 20px 0px 20px;
                    font-weight: bold;
                    font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;
                    box-shadow: 20px 20px 31px #cccccc,
                        -20px -20px 31px #f4f4f4;
                    }

                    @keyframes throwable {
    %s {
        background: linear-gradient(145deg, red, #F7AC22);
        border-radius: 20px 20px 20px 20px;
    }

    %s {
        background: linear-gradient(145deg, red, #F7AC22);
        border-radius: 0px 20px 20px 20px;
    }

    %s {
        background: linear-gradient(145deg, #F7AC22, red);
        border-radius: 20px 0px 20px 20px;
    }

    %s {
        background: linear-gradient(145deg, #F7AC22, red);
        border-radius: 20px 20px 0px 20px;
    }

    %s {
        background: linear-gradient(145deg, red, #F7AC22);
        border-radius: 20px 20px 20px 0px;
    }
}
                </style>',

            \ucwords($this->package),
            \ucwords($this->th->getMessage()),
            "0%",
            "25%",
            "50%",
            "75%",
            "100%"
        );
        return;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    private function SatusError(): void
    {
        \printf(
            '
            <title>%s</title>
            <div class="statuscode">
            <a onclick="history.back()"><div class="throwable"><h1>%s - %s</h1></div></a>
            </div>
                <style type="text/css">
                    div.statuscode{
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-height: 100vh;
                    min-width: 100vw;
                    }
                    a{
                    text-decoration: none;
                    }
                    div.throwable {
                    color: inherit;
                    cursor: pointer;
                    padding-top: 10px;
                    padding-left: 30px;
                    padding-right: 30px;
                    padding-bottom: 10px;
                    width: max-content;
                    animation-name: throwable;
                    animation-duration: 5s;
                    animation-iteration-count: infinite;
                    animation-direction: linear;
                    font-size: inherit;
                    border-radius: 0px 20px 0px 20px;
                    font-weight: bold;
                    font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;
                    box-shadow: 20px 20px 31px #cccccc,
                        -20px -20px 31px #f4f4f4;
                    }

                    @keyframes throwable {
    %s {
        border-radius: 20px 20px 20px 20px;
    }

    %s {
        color: red;
        border-radius: 0px 20px 20px 20px;
    }

    %s {
        color: darkred;
        border-radius: 20px 0px 20px 20px;
    }

    %s {
        color: brown;
        border-radius: 20px 20px 0px 20px;
    }

    %s {
        border-radius: 20px 20px 20px 0px;
    }
}
                </style>',
            $this->th->getMessage(),
            $this->th->getCode(),
            \ucwords($this->th->getMessage()),
            "0%",
            "25%",
            "50%",
            "75%",
            "100%"
        );
        return;
    }

    /**
     * Decide to How to Display Error
     *
     * @return void
     */
    private function decide(): void
    {
        $code = $this->th->getCode();

        if ($code !== 0 && is_int($this->th->getCode()) && $code < self::MAXSTATUSCODE && $code > self::MINSTATUSCODE) {
            new DecideDisplay($this->th->getMessage(), $this->package);
            $this->SatusError();
            $this->responseCode($code);
            return;
        }
        new DecideDisplay($this->th->getMessage(), $this->package);
        $this->ClassError();
        exit;
    }
}