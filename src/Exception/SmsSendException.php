<?php


namespace Visualplus\LaravelAligoSms\Exception;


use Throwable;

class SmsSendException extends \Exception
{
    /** @var array */
    protected static $messages = [
        -100 => '서버에러',
        -101 => '필수입력 부적합',
        -102 => '인증 에러',
        -103 => '발신번호 인증 에러',
        -105 => '발송건수제한,발송시간 에러',
        -109 => '문자 잔여횟수 부족',
        -115 => '예약 시간 에러',
        -201 => '전송가능 건수 부족(충전잔액부족)',
        -301 => '이미지 입력오류',
        -900 => '알려지지 않은 에러',
    ];

    /**
     * SmsSendException constructor.
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($code = 0, Throwable $previous = null)
    {
        $message = static::$messages[$code];

        parent::__construct($message, $code, $previous);
    }
}