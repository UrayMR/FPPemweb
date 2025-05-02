<?php

class Router
{
  protected static $routes = [];

  public static function get($uri, $callback)
  {
    self::$routes['GET'][$uri] = $callback;
  }

  public static function post($uri, $callback)
  {
    self::$routes['POST'][$uri] = $callback;
  }

  public static function dispatch($uri)
  {
    $uri = strtok($uri, '?');
    $method = $_SERVER['REQUEST_METHOD'];

    if (isset(self::$routes[$method][$uri])) {
      call_user_func(self::$routes[$method][$uri]);
    } else {
      http_response_code(404);
      echo "404 Not Found";
    }
  }
}
