<?php

namespace App\Services;

class SessionService
{
    private static $session_name = 'APP_SESSION';
    private static $session_dev_name;


    public static function init($dev_key)
    {
        self::$session_dev_name = $dev_key;
        return new static();
    }


    private static function session()
    {
        return self::$session_name . '.' . self::$session_dev_name;
    }

    /**
     * Set controller session
     *
     * @param string|null $view
     * @param string|null $val
     */
    public function set($key, $val, $flash = false)
    {
        if (isset($val) || !empty($val)) {

            $sessionKey = self::session() . '.' . $key;
            if ($flash)
                session()->flash($sessionKey, $val);
            else
                session([$sessionKey => $val]);
        }
        return new static();
    }

    /***
     * Get controller session
     *
     * @param $key
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function get($key)
    {
        $sessionKey = self::session() . '.' . $key;
        return session($sessionKey);
    }


    /***
     * Check if controller has session
     *
     * Search by the key name
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {

        $sessionKey = self::session() . '.' . $key;
        return session()->has($sessionKey);
    }


    /***
     * Clear controller session by key name
     *
     * @param $key
     * @return SessionService
     */
    public function destroy($key)
    {
        session()->forget(self::session() . '.' . $key);
        return new static();
    }

    /***
     * Clear controller session by key name
     *
     * @param $key
     * @return SessionService
     */
    public function all()
    {
        return session()->get(self::session());
    }


    /***
     * Clear all controller sessions
     * @return SessionService
     */
    public function clear()
    {
        session()->forget(self::session());
        return new static();
    }
}
