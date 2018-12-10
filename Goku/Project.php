<?php
namespace X\Service\Goku;
class Project {
    /** @var string */
    protected $host = null;
    /** @var string */
    protected $account = null;
    /** @var string */
    protected $secret = null;
    /** @var string */
    protected $id = null;
    
    /**
     * @param unknown $option
     */
    public function __construct( $option ) {
        foreach ( $option as $key => $value ) {
            $this->$key = $value;
        }
    }
    
    /**
     * 触发事件
     * @param name $name
     * @param mixed $data
     * @return void
     */
    public function trigger( $name, $data, $processor=null ) {
        $params = array();
        $params['account'] = $this->account;
        $paramsData = array(
            'project' => $this->id,
            'event' => $name,
            'data'=> json_encode($data),
            'processor' => $processor,
        );
        $params['data'] = json_encode($paramsData);
        $params['timestamp'] = time();
        $params['rand'] = uniqid();
        $params['sign'] = $this->generateSign($paramsData, $params);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->getTriggerUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    
    /**
     * 获取请求URL
     * @return string
     */
    private function getTriggerUrl() {
        return "http://{$this->host}/index.php?module=api&action=trigger";
    }
    
    /**
     * Generate sign string for calling
     * @param unknown $params
     * @return string
     */
    private function generateSign( $signData, $params ) {
        ksort($signData);
        foreach ( $signData as $key => $value ) {
            $signData[$key] = $key.'='.$value;
        }
        $signData = implode(';', $signData);
        return md5(implode('&', array($this->secret, $signData, $params['timestamp'], $params['rand'])));
    }
}