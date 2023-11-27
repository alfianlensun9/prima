<?php

class Ws
{
    private $method = 'GET';
    private $url = '';
    private $timeout = 60;
    private $params = null;
    private $token = '';
    private $headers = [];
    private $data = [];
    private $authorization = true;
    private $session;
    private $base_url = "";
    private $showStatusCodeHeader = false;
    // private $base_url = 'http://172.31.64.112:3701';
    // private $base_url = 'http://192.168.1.45:3701';

    function __construct()
    {
        $ci_instance = &get_instance();
        $this->session = $ci_instance->session;
    }

    public function setbaseurl($type = null)
    {
        switch ($type) {
            case 'bpjs':
                $this->base_url = URI_BPJS;
                break;
            case 'antrean':
                $this->base_url = URI_ANTREAN;
                break;
            case 'auth':
                $this->base_url = URI_AUTH_PRIMA;
                break;
            case 'absen':
                $this->base_url = URI_ABSENSI_PRIMA;
            case 'aevy':
                $this->base_url = URI_AEVY;
                break;
            default:
                break;
        }

        return $this;
    }

    public function showStatusCode($status = true)
    {
        $this->showStatusCodeHeader = $status;
        return $this;
    }

    public function authorization($boolean = true)
    {
        $this->authorization = $boolean;
        return $this;
    }

    public function setToken($token = '')
    {
        $this->session->set_userdata('jwt_token', $token);
    }

    public function getToken()
    {
        return $this->session->userdata('jwt_token');
    }

    public function clearToken()
    {
        $this->session->unset_userdata('jwt_token');
    }

    public function params($params = [])
    {
        if (!is_array($params)) dd('parameter musti array');
        $allparams = array_map(function ($item, $key) {
            return $key . '=' . $item;
        }, $params, array_keys($params));
        $this->params = join('&', $allparams);
        return $this;
    }

    public function data($data = [], $uat = 0)
    {
        if ($uat == 1) {
            $this->data = $data;
        } else {
            if (!is_array($data)) dd('parameter musti array');
            if (count($data) > 0) {
                if (!isset($data['id_user_inputer'])) $data['id_user_inputer'] = isset($this->session->userdata['auth_user']) ? $this->session->userdata['auth_user']['userId'] : '';
                // if (!isset($data['logs'])) $data['logs'] = uniqid();
            }
            $this->data = $data;
        }
        return $this;
    }

    public function headers($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function timeout($timeout = 30)
    {
        $this->timeout = (int) $timeout;
        return $this;
    }

    public function get($url = '')
    {
        try {
            $session = curl_init();
            $uri = $url;


            if ($this->params !== null) {
                $uri .= $this->params;
            }

            if (explode('://', $url)[0] == 'http' || explode('://', $url)[0] == 'https') {
                $this->base_url = '';
            }


            if ($this->authorization && $this->getToken() !== null) {
                $this->headers[] = "Authorization: Bearer " . $this->getToken();
            }


            curl_setopt($session, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($session, CURLOPT_URL, $this->base_url === null ? $url : $this->base_url . $url);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($session, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($session, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($session, CURLOPT_VERBOSE, true);
            $result = curl_exec($session);


            if ($result === false) {
                throw new Exception(curl_error($session), curl_errno($session));
            }
            curl_close($session);
            $x = json_decode($result, true);
            // dd($x['msg']);
            return json_decode($result, true);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function post($url = '', $uat = 0)
    {
        try {
            // dd('ok');
            $session = curl_init();
            $uri = $url;
            if (explode('://', $url)[0] == 'http' || explode('://', $url)[0] == 'https') {
                $this->base_url = '';
            }

            $this->headers[] = "Content-Type: application/json";
            if ($this->authorization && $this->getToken() !== null) {
                $this->headers[] = "Authorization: Bearer " . $this->getToken();
            }

            curl_setopt($session, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($session, CURLOPT_NOBODY, false);
            curl_setopt($session, CURLOPT_URL, $this->base_url === null ? $url : $this->base_url . $url);


            if ($uat == 1) {
                curl_setopt($session, CURLOPT_POSTFIELDS, $this->data);
            } else {
                curl_setopt($session, CURLOPT_POSTFIELDS, json_encode($this->data));
            }

            curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($session, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($session, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($session, CURLOPT_VERBOSE, true);
            $result = curl_exec($session);
            $httpcode = curl_getinfo($session, CURLINFO_HTTP_CODE);

            if ($result === false) {
                throw new Exception(curl_error($session), curl_errno($session));
            }

            curl_close($session);

            if ($this->showStatusCodeHeader) {
                $dataArray = json_decode($result, true);
                return [
                    'statusCode' => $httpcode,
                    'data' => $dataArray
                ];
            }
            return json_decode($result, true);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function put($url = '')
    {
        try {
            $session = curl_init();

            if (explode('://', $url)[0] == 'http' || explode('://', $url)[0] == 'https') {
                $this->base_url = '';
            }
            $this->headers[] = "Content-Type: application/json";
            if ($this->authorization && $this->getToken() !== null) {
                $this->headers[] = "Authorization: Bearer " . $this->getToken();
            }

            curl_setopt($session, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($session, CURLOPT_URL, $this->base_url === null ? $url : $this->base_url . $url);
            curl_setopt($session, CURLOPT_POSTFIELDS, json_encode($this->data));
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($session, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($session, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($session, CURLOPT_VERBOSE, true);
            $result = curl_exec($session);
            if ($result === false) {
                throw new Exception(curl_error($session), curl_errno($session));
            }
            curl_close($session);

            return json_decode($result, true);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function patch($url = '', $uat = 0)
    {
        try {
            $session = curl_init();

            if (explode('://', $url)[0] == 'http' || explode('://', $url)[0] == 'https') {
                $this->base_url = '';
            }
            $this->headers[] = "Content-Type: application/json";
            if ($this->authorization && $this->getToken() !== null) {
                $this->headers[] = "Authorization: Bearer " . $this->getToken();
            }

            curl_setopt($session, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($session, CURLOPT_URL, $this->base_url === null ? $url : $this->base_url . $url);
            if ($uat == 1) {
                curl_setopt($session, CURLOPT_POSTFIELDS, $this->data);
            } else {
                curl_setopt($session, CURLOPT_POSTFIELDS, json_encode($this->data));
            }

            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($session, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($session, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($session, CURLOPT_VERBOSE, true);
            $result = curl_exec($session);
            if ($result === false) {
                throw new Exception(curl_error($session), curl_errno($session));
            }
            curl_close($session);

            return json_decode($result, true);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function delete($url = '')
    {
        try {
            $session = curl_init();
            if (explode('://', $url)[0] == 'http' || explode('://', $url)[0] == 'https') {
                $this->base_url = '';
            }
            $this->headers[] = "Content-Type: application/json";

            if ($this->authorization && $this->getToken() !== null) {
                $this->headers[] = "Authorization: Bearer " . $this->getToken();
            }

            curl_setopt($session, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($session, CURLOPT_URL, $this->base_url === null ? $url : $this->base_url . $url);
            curl_setopt($session, CURLOPT_POSTFIELDS, json_encode($this->data));
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($session, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($session, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($session, CURLOPT_VERBOSE, true);
            $result = curl_exec($session);
            if ($result === false) {
                throw new Exception(curl_error($session), curl_errno($session));
            }
            curl_close($session);

            return json_decode($result, true);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function generateAntreanToken($url = '')
    {
        try {
            $session = curl_init();
            $uri = $url;

            if ($this->params !== null) {
                $uri .= $this->params;
            }

            if (explode('://', $url)[0] == 'http' || explode('://', $url)[0] == 'https') {
                $this->base_url = '';
            }


            $this->headers[] = "x-username:2022ratatotokbpjs";
            $this->headers[] = "x-password:2022_bpjs@ntrean";

            curl_setopt($session, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($session, CURLOPT_URL, $this->base_url === null ? $url : $this->base_url . $url);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 100);
            curl_setopt($session, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($session, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($session, CURLOPT_VERBOSE, true);
            $result = curl_exec($session);

            if ($result === false) {
                throw new Exception(curl_error($session), curl_errno($session));
            }
            curl_close($session);
            $x = json_decode($result, true);
            return json_decode($result, true);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    function throwError($e)
    {
        if (ENVIRONMENT == 'development') {
            echo '<br><b>Environment: ' . strtoupper(ENVIRONMENT) . ' </b>' . '<br><br>';
            echo 'error code : ' . $e->getCode() . '<br>';
            echo 'error message : ' . $e->getMessage() . '<br>';
            die;
        }
        return [
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        ];
    }
}
